<?php

if ( ! function_exists( 'qode_map_post_audio_meta' ) ) {
	function qode_map_post_audio_meta() {
		$audio_post_format_meta_box = qode_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'qode' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		qode_add_meta_box_field(
			array(
				'name'        => 'audio_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'qode' ),
				'description' => esc_html__( 'Enter audio link', 'qode' ),
				'parent'      => $audio_post_format_meta_box
			)
		);
	}
	
	add_action( 'qode_meta_boxes_map', 'qode_map_post_audio_meta', 23 );
}