<?php
/**
 * Boilerplate Lite Customizer Options logic
 *
 * @package Boilerplate
 * @since 1.1.0
 */

/**
 * Assets that will be loaded for the customizer sidebar
 */
function boilerplate_lite_customizer_assets() {
	wp_enqueue_style( 'boilerplate_lite_customizer_style', get_template_directory_uri() . '/inc/lite/admin/css/customizer.css', null, '1.0.0', false );
}
add_action( 'customize_controls_enqueue_scripts', 'boilerplate_lite_customizer_assets' );

/**
 * Add PRO Tab in Customizer
 *
 * @param WP_Customize_Manager $wp_customize
 */
function boilerplate_lite_customize_register( $wp_customize ) {
	// View Pro
	$wp_customize->add_section(
		'pro__section', array(
			'title'       => esc_html__( 'View PRO Version', '__theme_txtd' ),
			'priority'    => 2,
			'description' => sprintf(
			/* translators: %s: The upsell link. */
				__(
					'<div class="upsell-container">
				<h2>Need More? Go PRO</h2>
				<p>Take it to the next level and stand out. See the hotspots of Boilerplate PRO:</p>
				<ul class="upsell-features">
                        <li>
                            <h4>Personalize to Match Your Style</h4>
                            <div class="description">Having different tastes and preferences might be tricky for users, but not with Boilerplate PRO onboard. It has Style Manager, an intuitive and catchy interface that allows you to change color palettes and fonts with a few clicks.</div>
                        </li>

                        <li>
                            <h4>More Widget Areas for Extra Flexibility</h4>
                            <div class="description">The PRO version comes with three widget-friendly sections: on your Home Page, Below Posts, and in the Footer. Use these areas to get new email subscribers, social media followers or anything else that gets you closer to your goals.</div>
                        </li>

                        <li>
                            <h4>Advanced Features for a Unique Look</h4>
                            <div class="description">Boilerplate PRO takes everything to the next level, unlocking features like more menu locations, a search option, and an Author Info Box along with social media sharing buttons. You also get access to 600+ fonts & other styling options for buttons, text intro and article titles.</div>
                        </li>

                        <li>
                            <h4>Premium Customer Support</h4>
                            <div class="description">You will benefit from priority support from a caring and devoted team, eager to help and to spread happiness. We work hard to provide a flawless experience for those who vote us with trust and choose to be our special clients.</div>
                        </li>
                        
                </ul> %s </div>', '__theme_txtd'
				),
				sprintf( '<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>', esc_url( boilerplate_lite_get_pro_link() ), esc_html__( 'Get Boilerplate PRO', '__theme_txtd' ) )
			),
		)
	);

	// This is just an empty control so that the section will show up.
	$wp_customize->add_setting(
		'boilerplate_lite_style_view_pro_desc', array(
			'default'           => '',
			'sanitize_callback' => '__return_true',
		)
	);
	$wp_customize->add_control(
		'boilerplate_lite_style_view_pro_desc', array(
			'section' => 'pro__section',
			'type'    => 'hidden',
		)
	);
}
add_action( 'customize_register', 'boilerplate_lite_customize_register' );
