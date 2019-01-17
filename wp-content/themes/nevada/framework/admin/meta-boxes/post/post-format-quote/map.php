<?php

if ( ! function_exists( 'qode_map_post_quote_meta' ) ) {
	function qode_map_post_quote_meta() {
		$quote_post_format_meta_box = qode_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'qode' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		qode_add_meta_box_field(
			array(
				'name'        => 'quote_format',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote', 'qode' ),
				'description' => esc_html__( 'Enter Quote text', 'qode' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'qode_meta_boxes_map', 'qode_map_post_quote_meta', 25 );
}