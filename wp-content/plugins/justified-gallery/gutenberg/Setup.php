<?php

// https://github.com/WordPress/gutenberg/tree/f9e82d00668ec88a2cc355fb33e441f85393728e/packages/block-library/src/gallery
// https://deliciousbrains.com/custom-gutenberg-block/

// https://github.com/ahmadawais/create-guten-block

// Wyświetlić podgląd jako iframe - https://github.com/Automattic/wp-calypso/tree/master/client/components/resizable-iframe

// Exit if accessed directly.
if ( ! defined('ABSPATH')) {
    die('Silence is golden.');
}

class DGWT_JG_Gutenberg_Setup
{

    const PREVIEW_KEY = 'dgwt-jg-gutenberg-preview';
    const NONCE_NAME = 'dgwt-jg-wpnonce';
    const NONCE_ACTION = 'dgwt-jg-see-gut-preview';

    public function __construct()
    {

        add_action('enqueue_block_editor_assets', array($this, 'editor_assets'));

        $this->gallery_preview();
    }

    /**
     * Render gallery preview
     *
     * @return void
     */
    private function gallery_preview()
    {
        if ( ! empty($_GET[self::PREVIEW_KEY]) && $_GET[self::PREVIEW_KEY] === 'active') {

            $this->disableQueryMonitor();

            if ( ! current_user_can('edit_posts')) {
                exit('This block could not be generated: permission denied');
            }

            if ( ! check_admin_referer(self::NONCE_ACTION, self::NONCE_NAME)) {
                exit('This block could not be generated: invalid nonces');
            }

            define('DGWT_JG_GUTENBERG_PREVIEW', true);

            add_filter('show_admin_bar', '__return_false');

            add_action('template_redirect', function () {

                if (empty($_GET['id']) || ! is_array($_GET['id'])) {
                    exit('This block could not be generated: no images!');
                }

                $ids = array();
                foreach ($_GET['id'] as $id) {
                    if (is_numeric($id) && $id > 0) {
                        $ids[] = absint($id);
                    }
                }

                if (empty($ids)) {
                    exit('This block could not be generated: no images!');
                }

                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <?php wp_head(); ?>
                </head>
                <body>

                <?php
                echo do_shortcode('[gallery lightbox="none" link="none" ids="' . implode(',', $ids) . '"]');
                wp_footer()
                ?>

                <!-- page content -->
                </body>
                </html>
                <?php
                exit();
            });
        }

        return false;
    }

    /**
     * Disable query monitor by caps
     */
    private function disableQueryMonitor()
    {
        add_filter('user_has_cap', function ($user_caps) {

            if (isset($user_caps['view_query_monitor'])) {
                $user_caps['view_query_monitor'] = false;
            }

            return $user_caps;
        }, 10, 1);
    }

    /**
     * Enqueue Gutenberg block assets for backend editor.
     *
     * `wp-blocks`: includes block type registration and related functions.
     * `wp-element`: includes the WordPress Element abstraction for describing the structure of your blocks.
     * `wp-i18n`: To internationalize the block's text.
     *
     * @since 1.4.0
     */

    public function editor_assets()
    {

        // Styles.
        wp_enqueue_style(
            'dgwt-jg-gallery-block-editor-css',
            DGWT_JG_URL . 'gutenberg/dist/blocks.editor.build.css',
            array('wp-edit-blocks'),
            DGWT_JG_VERSION
        );

        // Scripts.
        wp_register_script(
            'dgwt-jg-gallery-block-editor-js',
            DGWT_JG_URL . 'gutenberg/dist/blocks.build.js',
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor'),
            DGWT_JG_VERSION
        );

        $block_data = array(
            'editorBlockIcon' => '', // @TODO Przygotować SVG 24x24
            'previewURL'      => add_query_arg(array(self::PREVIEW_KEY => 'active'), home_url())
        );


        $block_data['previewURL'] = wp_nonce_url(
            $block_data['previewURL'],
            self::NONCE_ACTION,
            self::NONCE_NAME
        );

        wp_localize_script('dgwt-jg-gallery-block-editor-js', 'dgwtJgGutenBlock', $block_data);

        wp_enqueue_script('dgwt-jg-gallery-block-editor-js');

    }


}