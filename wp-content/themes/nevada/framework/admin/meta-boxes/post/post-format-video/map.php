<?php

if ( ! function_exists( 'qode_map_post_video_meta' ) ) {
	function qode_map_post_video_meta() {
		$video_post_format_meta_box = qode_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'qode' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		qode_add_meta_box_field(
			array(
				'name'          => 'video_format_choose',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'qode' ),
				'description'   => esc_html__( 'Choose video type', 'qode' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'youtube',
				'options'       => array(
					'youtube'	=> esc_html__( 'Youtube', 'qode' ),
					'vimeo'		=> esc_html__( 'Vimeo', 'qode' ),
					'self'		=> esc_html__( 'Self Hosted', 'qode' ),

				),
				'args' => array(
					'dependence' => true,
					'hide' => array(
						'youtube'	=> '#qodef_qodef_video_self_hosted_container',
						'vimeo'		=> '#qodef_qodef_video_self_hosted_container',
						'self'		=> '#qodef_qodef_video_embedded_container'
					),
					'show' => array(
						'youtube'	=> '#qodef_qodef_video_embedded_container',
						'vimeo'		=> '#qodef_qodef_video_embedded_container',
						'self'		=> '#qodef_qodef_video_self_hosted_container'
					)
				)
			)
		);


		$qodef_video_embedded_container = qode_add_admin_container(
			array(
				'parent'			=> $video_post_format_meta_box,
				'name'				=> 'qodef_video_embedded_container',
				'hidden_property'	=> 'qodef_video_type_meta',
				'hidden_value'		=> 'self'
			)
		);

		$qodef_video_self_hosted_container = qode_add_admin_container(
			array(
				'parent'			=> $video_post_format_meta_box,
				'name'				=> 'qodef_video_self_hosted_container',
				'hidden_property'	=> 'qodef_video_type_meta',
				'hidden_values'		=> array('youtube', 'vimeo')
			)
		);

		qode_add_meta_box_field(
			array(
				'name'        => 'video_format_link',
				'type'        => 'text',
				'label'       => esc_html__('Video ID', 'qode'),
				'description' => esc_html__('Enter Video ID', 'qode'),
				'parent'      => $qodef_video_embedded_container,
			)
		);

		qode_add_meta_box_field(
			array(
				'name'        => 'video_format_image',
				'type'        => 'image',
				'label'       => esc_html__('Video Image', 'qode'),
				'description' => esc_html__('Upload video image', 'qode'),
				'parent'      => $qodef_video_self_hosted_container,

			)
		);

		qode_add_meta_box_field(
			array(
				'name'        => 'video_format_webm',
				'type'        => 'text',
				'label'       => esc_html__('Video WEBM', 'qode'),
				'description' => esc_html__('Enter video URL for WEBM format', 'qode'),
				'parent'      => $qodef_video_self_hosted_container,

			)
		);

		qode_add_meta_box_field(
			array(
				'name'        => 'video_format_mp4',
				'type'        => 'text',
				'label'       => esc_html__('Video MP4', 'qode'),
				'description' => esc_html__('Enter video URL for MP4 format', 'qode'),
				'parent'      => $qodef_video_self_hosted_container,

			)
		);

		qode_add_meta_box_field(
			array(
				'name'        => 'video_format_ogv',
				'type'        => 'text',
				'label'       => esc_html__('Video OGV', 'qode'),
				'description' => esc_html__('Enter video URL for OGV format', 'qode'),
				'parent'      => $qodef_video_self_hosted_container,

			)
		);
	}
	
	add_action( 'qode_meta_boxes_map', 'qode_map_post_video_meta', 22 );
}