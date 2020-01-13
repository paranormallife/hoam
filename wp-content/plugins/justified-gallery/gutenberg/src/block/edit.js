/**
 * External Dependencies
 */
import filter from 'lodash/filter';
import ResizableIframe from '../components/resizable-iframe';



/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;
const { __ } = wp.i18n;
const {
	IconButton,
	DropZone,
	FormFileUpload,
	PanelBody,
	RangeControl,
	SelectControl,
	ToggleControl,
	Toolbar,
	withNotices,
} = wp.components;
const {
	BlockControls,
	MediaUpload,
	MediaPlaceholder,
	InspectorControls,
	mediaUpload,
} = wp.editor;

const linkOptions = [
	{ value: 'attachment', label: __( 'Attachment Page' ) },
	{ value: 'media', label: __( 'Media File' ) },
	{ value: 'none', label: __( 'None' ) },
];

class DGWT_JG_GalleryEdit extends Component {
	constructor() {
		super( ...arguments );

		this.onSelectImage = this.onSelectImage.bind( this );
		this.onSelectImages = this.onSelectImages.bind( this );
		this.setLinkTo = this.setLinkTo.bind( this );
		this.onRemoveImage = this.onRemoveImage.bind( this );
		this.addFiles = this.addFiles.bind( this );
		this.uploadFromFiles = this.uploadFromFiles.bind( this );

		this.state = {
			selectedImage: null,
		};
	}


	onSelectImage( index ) {
		return () => {
			if ( this.state.selectedImage !== index ) {
				this.setState( {
					selectedImage: index,
				} );
			}
		};
	}

	onRemoveImage( index ) {
		return () => {
			const images = filter( this.props.attributes.images, ( img, i ) => index !== i );
			this.setState( { selectedImage: null } );
			this.props.setAttributes( {
				images
			} );
		};
	}

	onSelectImages( images ) {

        const imagesIDs = [];

		if(images.length > 0){
            images.forEach(function(el){
                imagesIDs.push(el.id);
            });
		}

        this.props.setAttributes( {
			images: imagesIDs
        } );
	}

	setLinkTo( value ) {
		this.props.setAttributes( { linkTo: value } );
	}

	uploadFromFiles( event ) {
		this.addFiles( event.target.files );
	}

	addFiles( files ) {
		const currentImages = this.props.attributes.images || [];
		const { noticeOperations, setAttributes } = this.props;
		mediaUpload( {
			allowedType: 'image',
			filesList: files,
			onFileChange: ( images ) => {
				setAttributes( {
					images: currentImages.concat( images ),
				} );
			},
			onError: noticeOperations.createErrorNotice,
		} );
	}

	componentDidUpdate( prevProps ) {
		// Deselect images when deselecting the block
		if ( ! this.props.isSelected && prevProps.isSelected ) {
			this.setState( {
				selectedImage: null,
				captionSelected: false,
			} );
		}
	}

	createPreviewURL(images){
		let URL = window.dgwtJgGutenBlock.previewURL;

		if(images.length > 0){
            images.forEach(function(image, i){
                URL += '&id[]=' + image;
            });
        }

        return URL;
	}

	render() {
		const { attributes, isSelected, className, noticeOperations, noticeUI } = this.props;
		const { images, linkTo } = attributes;

		const dropZone = (
			<DropZone
				onFilesDrop={ this.addFiles }
			/>
		);

		const controls = (
			<BlockControls>
				{ !! images.length && (
					<Toolbar>
						<MediaUpload
							onSelect={ this.onSelectImages }
							type="image"
							multiple
							gallery
							value={ images.map( ( img ) => img ) }
							render={ ( { open } ) => (
								<IconButton
									className="components-toolbar__control"
									label={ __( 'Edit Gallery' ) }
									icon="edit"
									onClick={ open }
								/>
							) }
						/>
					</Toolbar>
				) }
			</BlockControls>
		);

		if ( images.length === 0 ) {
			return (
				<Fragment>
					{ controls }
					<MediaPlaceholder
						icon="format-gallery"
						className={ className }
						labels={ {
							title: __( 'Gallery' ),
							name: __( 'images' ),
						} }
						onSelect={ this.onSelectImages }
						accept="image/*"
						type="image"
						multiple
						notices={ noticeUI }
						onError={ noticeOperations.createErrorNotice }
					/>
				</Fragment>
			);
		}

		return (
			<Fragment>
				{ controls }
				<InspectorControls>
					<PanelBody title={ __( 'Gallery Settings' ) }>
						<SelectControl
							label={ __( 'Link To' ) }
							value={ linkTo }
							onChange={ this.setLinkTo }
							options={ linkOptions }
						/>
					</PanelBody>
				</InspectorControls>
				{ noticeUI }
				<ResizableIframe
					src={ this.createPreviewURL(images) }
					frameBorder="0"
				/>
				<div className={ `${ className }` }>
					{ dropZone }
					{ isSelected &&
						<div className="blocks-gallery-item has-add-item-button">
							<FormFileUpload
								multiple
								isLarge
								className="block-library-gallery-add-item-button"
								onChange={ this.uploadFromFiles }
								accept="image/*"
								icon="insert"
							>
								{ __( 'Upload an image' ) }
							</FormFileUpload>
						</div>
					}
				</div>
			</Fragment>
		);
	}
}

export default withNotices( DGWT_JG_GalleryEdit );
