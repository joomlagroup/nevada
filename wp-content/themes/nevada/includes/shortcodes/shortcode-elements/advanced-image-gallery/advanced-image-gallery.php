<?php
namespace Bridge\Shortcodes\AdvancedImageGallery;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class AdvancedImageGallery implements ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qode_advanced_image_gallery';
		
		add_action( 'qode_vc_map', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Advanced Image Gallery', 'qode' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by QODE', 'qode' ),
					'icon'                      => 'icon-wpb-advanced-image-gallery extended-custom-icon-qode',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'qode' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'qode' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Gallery Type', 'qode' ),
							'value'       => array(
								esc_html__( 'Image Grid', 'qode' ) => 'grid',
								esc_html__( 'Masonry', 'qode' )    => 'masonry',
								esc_html__( 'Slider', 'qode' )     => 'slider',
								esc_html__( 'Carousel', 'qode' )   => 'carousel'
							),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_fixed_proportions',
							'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'qode' ),
							'value'       => array_flip( qode_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Set predefined image proportions for your masonry list. This option will apply image proportions you set in Image -> Image Size field.', 'qode' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry' ) )
						),
						array(
							'type'        => 'attach_images',
							'param_name'  => 'images',
							'heading'     => esc_html__( 'Images', 'qode' ),
							'description' => esc_html__( 'Select images from media library', 'qode' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'qode' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'qode' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'qode' ),
							'value'       => array_flip( qode_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_behavior',
							'heading'    => esc_html__( 'Image Behavior', 'qode' ),
							'value'      => array(
								esc_html__( 'None', 'qode' )             => '',
								esc_html__( 'Open Lightbox', 'qode' )    => 'lightbox',
								esc_html__( 'Open Custom Link', 'qode' ) => 'custom-link',
								esc_html__( 'Zoom', 'qode' )             => 'zoom',
								esc_html__( 'Grayscale', 'qode' )        => 'grayscale'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_icon',
							'heading'    => esc_html__( 'Enable Icon on Hover', 'qode' ),
							'value'      => array(
								'No'	=> 'no',
								'Yes'	=> 'yes'
							),
							'dependency' => array('element' => 'image_behavior', 'value' => array('lightbox'))
						),
						array(
							'type'        => 'textarea',
							'param_name'  => 'custom_links',
							'heading'     => esc_html__( 'Custom Links', 'qode' ),
							'description' => esc_html__( 'Delimit links by comma', 'qode' ),
							'dependency'  => array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'qode' ),
							'value'      => array_flip( qode_get_link_target_array() ),
							'dependency' => array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'qode' ),
							'value'       => array(
								esc_html__( 'Two', 'qode' )   => 'two',
								esc_html__( 'Three', 'qode' ) => 'three',
								esc_html__( 'Four', 'qode' )  => 'four',
								esc_html__( 'Five', 'qode' )  => 'five',
								esc_html__( 'Six', 'qode' )   => 'six'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'grid', 'masonry' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'qode' ),
							'value'       => array_flip( qode_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_visible_items',
							'heading'     => esc_html__( 'Number Of Visible Items', 'qode' ),
							'value'       => array(
								esc_html__( 'One', 'qode' )   => '1',
								esc_html__( 'Two', 'qode' )   => '2',
								esc_html__( 'Three', 'qode' ) => '3',
								esc_html__( 'Four', 'qode' )  => '4',
								esc_html__( 'Five', 'qode' )  => '5',
								esc_html__( 'Six', 'qode' )   => '6'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'qode' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'qode' ),
							'value'       => array_flip( qode_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'qode' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'qode' ),
							'value'       => array_flip( qode_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'qode' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'qode' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'qode' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'qode' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'qode' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'qode' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'qode' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_padding',
							'heading'     => esc_html__( 'Enable Slider Padding', 'qode' ),
							'description' => esc_html__( 'Padding left and right on stage (can see neighbours).', 'qode' ),
							'value'       => array_flip( qode_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider' ) ),
							'group'       => esc_html__( 'Slider Settings', 'qode' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'qode' ),
							'value'       => array_flip( qode_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'qode' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'qode' ),
							'value'       => array_flip( qode_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'qode' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'type'                    => 'grid',
			'enable_fixed_proportions'=> 'no',
			'images'                  => '',
			'image_size'              => 'thumbnail',
			'enable_image_shadow'     => 'no',
			'image_behavior'          => '',
			'enable_icon'			  => 'no',
			'custom_links'            => '',
			'custom_link_target'      => '_self',
			'number_of_columns'       => 'three',
			'space_between_items'     => 'normal',
			'number_of_visible_items' => '1',
			'slider_loop'             => 'yes',
			'slider_autoplay'         => 'yes',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'slider_padding'          => 'no',
			'slider_navigation'       => 'yes',
			'slider_pagination'       => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['inner_classes']  = $this->getInnerClasses( $params, $args );
		$params['slider_data']    = $this->getSliderData( $params );
		
		$params['type']               = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
		$params['images']             = $this->getGalleryImages( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
		$params['custom_links']       = $this->getCustomLinks( $params );
		$params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];


		$html = qode_get_shortcode_template_part( 'templates/' . $params['type'], 'advanced-image-gallery', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'qode-aig-' . $params['type'] . '-type' : 'qode-aig-' . $args['type'] . '-type';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'qode-' . $params['space_between_items'] . '-space' : 'qode-' . $args['space_between_items'] . '-space';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'qode-has-shadow' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'qode-image-behavior-' . $params['image_behavior'] : '';
		$holderClasses[] = $params['enable_fixed_proportions'] === 'yes' ? 'qode-aig-images-fixed' : '';

		return implode( ' ', $holderClasses );
	}

	private function getInnerClasses( $params, $args ) {
		$holderClasses = array();

		$holderClasses[] = $params['type'] === 'masonry' ? 'qode-aig-masonry' : 'qode-aig-grid';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'qode-aig-' . $params['number_of_columns'] . '-columns' : 'qode-aig-' . $args['number_of_columns'] . '-columns';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = $params['number_of_visible_items'] !== '' && $params['type'] === 'carousel' ? $params['number_of_visible_items'] : '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-slider-padding']         = ! empty( $params['slider_padding'] ) ? $params['slider_padding'] : '';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
		
		return $slider_data;
	}
	
	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;
		
		if ( $params['images'] !== '' ) {
			$image_ids = explode( ',', $params['images'] );
		}
		
		foreach ( $image_ids as $id ) {
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['title']    = get_the_title( $id );
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
			
			$images[ $i ] = $image;
			$i ++;
		}
		
		return $images;
	}
	
	private function getImageSize( $image_size ) {
		$image_size = trim( $image_size );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
	
	private function getCustomLinks( $params ) {
		$custom_links = array();
		
		if ( ! empty( $params['custom_links'] ) ) {
			$custom_links = array_map( 'trim', explode( ',', $params['custom_links'] ) );
		}
		
		return $custom_links;
	}
}