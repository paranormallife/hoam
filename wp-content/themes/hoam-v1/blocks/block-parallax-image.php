<?php
    $imageID = block_value( 'image' );
    $image =  wp_get_attachment_image_url( $imageID, 'full' );
    $title = block_value( 'title' );
?>

<section class="parallax " id="id-<?php echo $imageID ?>">
    <?php if( $title != '' ) { echo '<h2>' . $title . '</h2>'; } ?>
</section>

<style>
    #id-<?php echo $imageID; ?>.parallax::after {
        background-image: url('<?php echo $image; ?>');
    }
</style>