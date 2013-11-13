<?php

define('child_template_directory', get_stylesheet_directory_uri() );

wp_enqueue_script('has', child_template_directory . '/js/need-custom.js', array('jquery'), '1.0', true);

include("widgets/taxonomy-dropdown.php");

function has_custom_taxonomy_dropdown( $taxonomy, $taxonomy_singular_name, $class = 'taxonomy-dropdown', $orderby = 'name', $order = 'ASC', $limit = '-1') {
	$args = array(
		'orderby' => $orderby,
		'order' => $order,
		'number' => $limit,
	);
	$terms = get_terms( $taxonomy, $args );
	$name = ( $name ) ? $name : $taxonomy;
	if ( $terms ) {
		printf( '<select name="%s" class="postform %s taxonomy-%s">', esc_attr( $name ), $class, $taxonomy );
    
		printf( '<option value="0">%s</option>', 'Select ' . $taxonomy_singular_name );

		foreach ( $terms as $term ) {
			printf( '<option value="%s">%s</option>', esc_attr( get_term_link( $term ) ), esc_html( $term->name ) );
		}
		print( '</select>' );
	}
}

add_shortcode('taxonomy_list', 'taxonomy_list_func');

function taxonomy_list_func($atts, $content = null) {
  extract( shortcode_atts( array(
    'class' => '',
		'taxonomy' => ''), $atts ) );
    
  $taxonomy_list = '<div class="taxonomy-list ' . $class . '">';
  
  $taxonomy     = $taxonomy;
  $orderby      = 'name'; 
  $order        = 'ASC';
  $show_count   = 1;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no
  $title        = '';
  $echo         = 0;

  $args = array(
    'taxonomy'     => $taxonomy,
    'orderby'      => $orderby,
    'order'      => $order,
    'show_count'   => $show_count,
    'pad_counts'   => $pad_counts,
    'hierarchical' => $hierarchical,
    'title_li'     => $title,
    'echo'     => $echo
  );

  $taxonomy_list .= '<ul>';
  $taxonomy_list .= wp_list_categories( $args );
  $taxonomy_list .= '</ul>';
  
  $taxonomy_list .= '</div>';

	return $taxonomy_list; 
}