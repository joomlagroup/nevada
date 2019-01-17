<?php
if(!function_exists('qode_search_map')) {
    /**
     *
     */
    function qode_search_map() {

        qode_add_admin_page(
            array(
                'slug' => '_page_search',
                'title' => esc_html__('Search Page','qode'),
                'icon' => 'fa fa-search'
            )
        );

        $panel_search = qode_add_admin_panel(array(
            'title' => esc_html__('Search Results Page','qode'),
            'name'  => 'panel_page_search',
            'page'  => '_page_search'
        ));

        qode_add_admin_field(array(
            'parent'        => $panel_search,
            'type'          => 'select',
            'name'          => 'search_results_columns',
            'default_value' => 'one-column',
            'label'         => esc_html__('Number of Columns','qode'),
            'description'   => esc_html__('Select number of columns for Search Results page','qode'),
            'options'         => array(
                'one'     => esc_html__("One Column", 'qode'),
                'two'     => esc_html__("Two Columns", 'qode'),
                'three'   => esc_html__("Three Columns", 'qode'),
                'four'    => esc_html__("Four Columns", 'qode'),
                'five'    => esc_html__("Five Columns", 'qode'),
                'six'     => esc_html__("Six Columns", 'qode'),
            ),
            'args' => array(
                'dependence' => true,
                'hide'       => array(
                    'one'       => '#qodef_qode_spacing_container',

                ),
                'show'       => array(
                    'two'        => '#qodef_qode_spacing_container',
                    'three'      => '#qodef_qode_spacing_container',
                    'four'       => '#qodef_qode_spacing_container',
                    'five'       => '#qodef_qode_spacing_container',
                    'six'        => '#qodef_qode_spacing_container',
                )
            )
        ));

        $spacing_container = qode_add_admin_container(
            array(
                'name' => 'qode_spacing_container',
                'hidden_property' => 'search_results_columns',
                'hidden_value' => 'one',
                'parent' => $panel_search,
            )
        );

        qode_add_admin_field(array(
            'parent'        => $spacing_container,
            'type'          => 'select',
            'name'          => 'search_results_spacing',
            'default_value' => 'no',
            'label'         => esc_html__('Space Between Items','qode'),
            'description'   => esc_html__('Select spacing between items in Search Results page','qode'),
            'options'       => qode_get_space_between_items_array()
        ));

        /***************** Additional Page Layout - end *****************/

    }
    add_action('qode_options_map', 'qode_search_map', 100);
}