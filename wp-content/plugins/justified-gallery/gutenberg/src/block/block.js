/**
 * BLOCK: block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';

const {RawHTML} = wp.element;
const {__} = wp.i18n; // Import __() from wp.i18n
const {registerBlockType, createBlock} = wp.blocks; // Import registerBlockType() from wp.blocks


/**
 * Internal dependencies
 */
import {default as edit, defaultColumnsNumber} from './edit';

const blockAttributes = {
    images: {
        type: 'array',
        default: [],
    },
    linkTo: {
        type: 'string',
        default: '',
    },
    // lightbox: {
    //     type: 'string',
    //     default: '',
    // },
    // hover: {
    //     type: 'string',
    //     default: '',
    // },
    // lastRow: {
    //     type: 'string',
    //     default: '',
    // },
    // cssClass: {
    //     type: 'string',
    //     default: '',
    // },
    // margin: {
    //     type: 'number',
    //     default: '',
    // },
    // rowHeight: {
    //     type: 'number',
    //     default: '',
    // },
    // maxRowHeight: {
    //     type: 'number',
    //     default: '',
    // },
    // showDesc: {
    //     type: 'boolean',
    //     default: '',
    // }
};

// Import the element creator function (React abstraction layer)
const el = wp.element.createElement;
/**
 * Example of a custom SVG path taken from fontastic
 */
const icon = el('svg', {
        role: 'img',
        focusable: false,
        vievBox: '0 0 24 24',
        xmlns: 'http://www.w3.org/2000/svg'
    },
    el(
        'path',
        {d: "M0 0h24v24H0V0z",fill: 'none'}
    ),
    el(
        'g',
        {},
        el(
            'path',
            {d: "M20 4v12H8V4h12m0-2H8L6 4v12l2 2h12l2-2V4l-2-2z"}
        ),
        el(
            'path',
            {d: "M2 6v14l2 2h14v-2H4V6H2z"}
        )
    ),
    el(
        'g',
        {},
        el(
            'path',
            {d: "m 12.501865,6.3028231 c -0.0438,1.0876831 -0.0657,2.4308535 -0.0657,4.0295149 -4e-6,1.215426 -0.250023,2.078632 -0.750059,2.589621 -0.423394,0.43799 -1.082204,0.656986 -1.9764333,0.656986 -0.3211939,0 -0.6405618,-0.03832 -0.9581048,-0.114973 l 0.098548,-1.1771 c 0.2445444,0.109499 0.489089,0.164247 0.7336345,0.164246 0.4781386,1e-6 0.8248806,-0.104021 1.0402276,-0.312068 0.310242,-0.299292 0.465363,-0.86503 0.465366,-1.697214 -3e-6,-1.6680103 -0.02738,-3.0476799 -0.08212,-4.1390129 z"}
        ),
        el(
            'path',
            {d: "m 19.234513,13.244977 c -0.868688,0.222645 -1.595022,0.333968 -2.179004,0.333968 -1.255577,0 -2.207293,-0.344005 -2.855153,-1.032016 -0.647862,-0.688009 -0.971792,-1.522928 -0.971792,-2.50476 0,-1.0329235 0.35313,-1.9308037 1.059391,-2.6936429 0.706257,-0.7628271 1.685348,-1.1442437 2.937275,-1.1442509 0.587633,7.2e-6 1.105921,0.052931 1.554867,0.1587717 L 18.599426,7.6551196 C 18.026383,7.5054787 17.511744,7.4306553 17.055509,7.4306493 c -0.770138,6e-6 -1.345,0.2363383 -1.724589,0.7089976 -0.379594,0.4726698 -0.56939,1.0502696 -0.569388,1.7328009 -2e-6,0.6971382 0.212606,1.3048502 0.637824,1.8231362 0.425213,0.518291 1.011938,0.777435 1.760175,0.777434 0.208042,1e-6 0.448936,-0.0219 0.722685,-0.0657 -0.05475,-0.40514 -0.08213,-0.802981 -0.08212,-1.193524 -5e-6,-0.39419 -0.03833,-0.837655 -0.114973,-1.3303974 l 1.549393,0 c -0.02921,0.5620914 -0.04381,1.1278284 -0.0438,1.6972144 -7e-6,0.412443 0.01459,0.96723 0.0438,1.664365 z"}
        )
    )
);

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType('dgwt/justified-gallery', {
    // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
    title: __('Justified Gallery'), // Block title.
    description: __('Display multiple images in a responsive justified image grid and a pretty lightbox'),
    icon: icon,
    category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
    attributes: blockAttributes,
    keywords: [
        __('Justified Gallery'),
        __('gallery'),
        __('images')
    ],
    edit,
    /**
     * The save function defines the way in which the different attributes should be combined
     * into the final markup, which is then serialized by Gutenberg into post_content.
     *
     * The "save" property must be specified and must be a valid function.
     *
     * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
     */
    save: function ({attributes}) {
        const {images} = attributes;

        let htmlAtts = 'ids="' + images.join() + '"';
        // htmlAtts += ' lightbox="' + lightbox +'"';
        // htmlAtts += ' hover="' + hover +'"';
        // htmlAtts += ' lastrow="' + lastRow +'"';
        // htmlAtts += ' margin="' + margin +'"';
        // htmlAtts += ' rowheight="' + rowHeight +'"';
        // htmlAtts += ' maxrowheight="' + maxRowHeight +'"';
        // htmlAtts += ' link="' + linkTo +'"';
        // htmlAtts += ' class="' + cssClass +'"';

        return <RawHTML>{'[gallery ' + htmlAtts + ']'}</RawHTML>;

    },
});
