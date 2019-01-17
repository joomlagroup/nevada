<?php

if ( ! function_exists( 'qode_map_post_gallery_meta' ) ) {
	
	function qode_map_post_gallery_meta() {
		$gallery_post_format_meta_box = qode_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'qode' ),
				'name'  => 'post_format_gallery_meta'
			)
		);

		qode_add_meta_box_field(
			array(
				'name'          => 'gallery_type',
				'type'          => 'select',
				'label'         => esc_html__('Gallery Type', 'qode'),
				'description'   => esc_html__('Choose gallery type for Blog Compound list', 'qode'),
				'parent'        => $gallery_post_format_meta_box,
				'options'       => array(
					'slider'	=> esc_html__('Slider', 'qode'),
					'masonry'	=> esc_html__('Masonry', 'qode'),
				)
			)
		);
	}
	
	add_action( 'qode_meta_boxes_map', 'qode_map_post_gallery_meta', 21 );
}
