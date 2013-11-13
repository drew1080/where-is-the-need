<?php
/*
Template Name: Needs Page
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php query_posts('post_type="need"&posts_per_page=10&orderby=date&order=DESC');
    if (have_posts()) : 
    	while (have_posts()) : the_post(); 
        up_down_post_votes($post->ID);
    		the_title('<h3>', '</h3>');	
    		echo '<h4>' . get_the_date('m-d-Y') . '</h4>';
        echo "<h3>Interest</h3>";
        echo do_shortcode('[taxonomy_list taxonomy="interest"]');
        echo "<h3>Resources Needed</h3>";
        echo do_shortcode('[taxonomy_list taxonomy="resources"]');
    		the_content();
    	endwhile;
    endif; 
    wp_reset_query();
    ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>