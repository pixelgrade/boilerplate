<?php
/**
 * Handle the Components integration.
 *
 * @package Boilerplate
 */

/**
 * @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!! MAYBE EVEN DELETE IT!!!
 * Change blog component config.
 *
 * @param array $config
 *
 * @return array
 */
function boilerplate_alter_blog_component_config( $config ) {

	$config = Pixelgrade_Config::merge( $config, array(
		'sidebars' => array(
			'sidebar-1' => array(
				'sidebar_args' => array(
					'name'          => esc_html__( 'Posts Grid Widgets', '__theme_txtd' ),
					'description'   => esc_html__( 'Insert your favorite widgets here, and we will place them throughout the Frontpage posts grid.', '__theme_txtd' ),
					'before_widget' => '<div class="c-boilerplate__item c-boilerplate__item--widget %2$s"><section id="%1$s" class="widget">',
					'after_widget'  => '</section></div>',
					'before_title'  => '<h2 class="widget__title h6"><span>',
					'after_title'   => '</span></h2>',
				),
			),
			'sidebar-2' => array(
				'sidebar_args' => array(
					'before_title' => '<h2 class="widget__title h4"><span>',
					'after_title'  => '</span></h2>',
				),
			)
		)
	) );

	return $config;
}
add_filter( 'pixelgrade_blog_config', 'boilerplate_alter_blog_component_config', 10 );

/**
 * @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!! MAYBE EVEN DELETE IT!!!
 * Modify the Footer widget area settings.
 *
 * @param array $config
 *
 * @return array
 */
function boilerplate_alter_footer_component_config( $config ) {
	$config = Pixelgrade_Config::merge( $config, array(
		'sidebars' => array(
			'sidebar-footer' => array(
				'sidebar_args' => array(
					'before_title' => '<h2 class="widget__title h4"><span>',
					'after_title'  => '</span></h2>',
				),
			)
		)
	) );

	return $config;
}
add_filter( 'pixelgrade_footer_config', 'boilerplate_alter_footer_component_config', 10 );
