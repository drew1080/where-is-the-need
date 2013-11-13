<?php
/**
 * Plugin Name: A simple Widget
 * Description: A widget that displays authors name.
 * Version: 0.1
 * Author: Bilal Shaheen
 * Author URI: http://gearaffiti.com/about
 */


add_action( 'widgets_init', 'taxonomy_dropdown_widget_init' );


function taxonomy_dropdown_widget_init() {
	register_widget( 'taxonomy_dropdown_widget' );
}

class Taxonomy_Dropdown_Widget extends WP_Widget {

	function Taxonomy_Dropdown_Widget() {
		$widget_ops = array( 'classname' => 'taxonomy-dropdown', 'description' => __('A widget that displays a Taxonomy Dropdown', 'taxonomy-dropdown') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'taxonomy-dropdown-widget' );
		
		$this->WP_Widget( 'taxonomy-dropdown-widget', __('Taxonomy Dropdown Widget', 'example'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$taxonomy_items_count = $instance['taxonomy_items_count'];
    $taxonomy_slug = $instance['taxonomy_slug'];
    $taxonomy_singular_name = $instance['taxonomy_singular_name'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
			
		has_custom_taxonomy_dropdown( $taxonomy_slug, $taxonomy_singular_name, 'taxonomy-dropdown-box', 'name', 'ASC', $taxonomy_items_count);
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['taxonomy_items_count'] = strip_tags( $new_instance['taxonomy_items_count'] );
		$instance['taxonomy_slug'] = strip_tags( $new_instance['taxonomy_slug'] );
		$instance['taxonomy_singular_name'] = strip_tags( $new_instance['taxonomy_singular_name'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('', 'taxonomy-dropdown-widget'), 'taxonomy_items_count' => __('', 'taxonomy-dropdown-widget') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomy_items_count' ); ?>"><?php _e('Taxonomy items to show:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'taxonomy_items_count' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy_items_count' ); ?>" value="<?php echo $instance['taxonomy_items_count']; ?>" style="width:100%;" />
		</p>
    
		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomy_slug' ); ?>"><?php _e('Taxonomy slug:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'taxonomy_slug' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy_slug' ); ?>" value="<?php echo $instance['taxonomy_slug']; ?>" style="width:100%;" />
		</p>
    
		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomy_singular_name' ); ?>"><?php _e('Taxonomy singular name:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'taxonomy_singular_name' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy_singular_name' ); ?>" value="<?php echo $instance['taxonomy_singular_name']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

?>