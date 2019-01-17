<?php

if ( ! function_exists( 'qode_map_post_link_meta' ) ) {
	function qode_map_post_link_meta() {
		$link_post_format_meta_box = qode_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'qode' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		qode_add_meta_box_field(
			array(
				'name'        => 'title_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'qode' ),
				'description' => esc_html__( 'Enter link', 'qode' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'qode_meta_boxes_map', 'qode_map_post_link_meta', 24 );
}