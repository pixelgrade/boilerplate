<?php
/**
 * Template part for displaying related posts.
 *
 * This template part can be overridden by copying it to a child theme or in the same theme
 * by putting it in the root `/template-parts/content-relatedposts.php` or in `/template-parts/blog/content-relatedposts.php`.
 *
 * @see pixelgrade_locate_component_template_part()
 *
 * HOWEVER, on occasion Pixelgrade will need to update template files and you
 * will need to copy the new files to your child theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://pixelgrade.com
 * @author     Pixelgrade
 * @package    Components/Blog
 * @version    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// @todo Make sure that things go smoothly in the Customizer (Jetpack uses some dummy content in its logic)
// we first need to know the bigger picture - the location this template part was loaded from
$location = pixelgrade_set_location( 'related-posts', true );

// Get the related posts IDs from Jetpack
$related_posts_ids = pixelgrade_get_jetpack_related_posts_ids();

$args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => false, // a little efficiency
);

// Now query for these post IDs
if ( ! empty( $related_posts_ids ) ) {
	// Do a custom query for the related posts
	$args['post__in'] = $related_posts_ids;
	$args['orderby']  = 'post__in';
} else {
	// Show Recent Posts instead on failure to connect to Jetpack's server or failure to find related posts (maybe it's still thinking and indexing)
	// Get the Jetpack Related Options
	$related_posts_options = pixelgrade_get_jetpack_related_posts_options();

	$args['post__not_in']   = array( get_the_ID() );
	$args['posts_per_page'] = ! empty( $related_posts_options['size'] ) ? (int) $related_posts_options['size'] : 3;
	$args['paged']          = 1;
	$args['orderby']        = 'date';
	$args['order']          = 'desc';
}

// Do a custom query for the related posts
$query = new WP_Query( $args );

if ( $query->have_posts() ) {

	// We remove the Jetpack Sharing filters because we don't want share buttons on related posts
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	?>

	<div class="u-container-sides-spacing">
		<div class="o-wrapper u-container-width">
			<div id="related-posts-container" class="related-posts-container">
				<?php pixelgrade_the_jetpack_related_posts_headline( esc_html__( 'Related Posts', '__components_txtd' ) ); ?>
				<div <?php pixelgrade_blog_grid_class(); ?>>
					<?php
					/* Start the Loop */
					while ( $query->have_posts() ) :
						$query->the_post();
						pixelgrade_the_card( 'blog', $location );
					endwhile;

					wp_reset_postdata();
					?>
				</div><!-- .c-gallery -->
			</div><!-- .o-wrapper.u-blog-grid-width -->
		</div>
	</div><!-- #related-posts-container -->

<?php
}
