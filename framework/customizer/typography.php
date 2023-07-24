<?php
/**
 *	Googe Fonts for the Theme
 */

function itre_custom_fonts_customize_register( $wp_customize ) {

	$wp_customize->add_section(
		'itre_typography', array(
			'title'		=>	__('Typography', 'it-residence'),
			'priority'	=>	80
		)
	);

	$wp_customize->add_setting(
		'itre_gfonts_subsets', array(
			'capability' => 'edit_theme_options',
			'default'	 => ['latin'],
			'transport'	 =>	'postMessage'
		)
	);

	$wp_customize->add_control(
		new ITRE_Multi_Checkbox_Control (
			$wp_customize, 'itre_gfonts_subsets', array(
				'label'	=>	__('Font Subsets', 'it-residence'),
				'type'	=>	'checkbox-multiple',
				'section'	=>	'itre_typography',
				'settings'	=>	'itre_gfonts_subsets',
				'choices'	=>	array(
					'latin'			=>	'Latin',
					'latin-ext'		=>	'Latin Extended',
					'greek'			=>	'Greek',
					'greek-ext'		=>	'Greek Extended',
					'cyrillic'		=>	'Cyrillic',
					'cyrillic-ext'	=>	'Cyrillic Extended',
					'khmer'			=>	'Khmer',
					'vietnamese'	=>	'Vietnamese',
					'devanagari'	=>	'Devanagari',
					'arabic'		=>	'Arabic',
					'hebrew'		=>	'Hebrew',
					'bengali'		=>	'Bengali',
					'gujarati'		=>	'Gujarati',
					'gurmukhi'		=>	'Gurmukhi',
					'malayalam'		=>	'Malayalam',
					'oriya'			=>	'Oriya',
					'sinhala'		=>	'Sinhala',
					'telugu'		=>	'Telugu',
					'thai'			=>	'Thai',
					'tibetan'		=>	'Tibetan'
				)
			)
		)
	);

	$wp_customize->add_setting(
	    'itre_gfonts_heading', array(
		    'default'	=>	'League Spartan',
		    'transport'	=>	'postMessage'
	    )
    );

    $wp_customize->add_setting(
	    'itre_gweights_heading', array(
		    'default'	=>	'700',
		    'transport'	=>	'postMessage'
	    )
    );

	$wp_customize->add_setting(
	    'itre_gcat_heading', array(
		    'default'	=>	'sans-serif',
		    'transport'	=>	'postMessage'
	    )
    );

    $wp_customize->add_control(
	    new itre_Google_Font_Dropdown_Custom_Control (
		    $wp_customize,
		    'itre_heading',
		    array(
			    'label'		=>	esc_html__('Heading Font', 'it-residence'),
			    'description'	=>	__('Font for headings, metadata, pagination and other areas', 'it-residence'),
			    'section'	=>	'itre_typography',
			    'settings'	=>	[
					'font'		=>	'itre_gfonts_heading',
					'weight'	=>	'itre_gweights_heading',
					'category'	=>	'itre_gcat_heading',
				],
			    'priority'	=>	10,
			    'input_attrs'	=>	array(
				    'font_id'		=>	'customize-control-itre_gfonts_heading',
				   	'weight_id'		=>	'customize-control-itre_gweights_heading',
					'cat_id'		=>	'customize-control-itre_gcat_heading',
			    )
		    )
	    )
    );

    $wp_customize->add_setting(
	    'itre_gfonts_body', array(
		    'default'	=>	'League Spartan',
		    'transport'	=>	'postMessage'
	    )
    );

    $wp_customize->add_setting(
	    'itre_gweights_body', array(
		    'default'			=>	'400',
		    'transport'	=>	'postMessage'
	    )
    );

	$wp_customize->add_setting(
	    'itre_gcat_body', array(
		    'default'	=>	'sans-serif',
		    'transport'	=>	'postMessage'
	    )
    );

    $wp_customize->add_control (
	    new itre_Google_Font_Dropdown_Custom_Control (
		    $wp_customize,
		    'itre_body_font',
		    array(
			    'label'		=>	esc_html__('Body Font', 'it-residence'),
			    'description'	=>	__('Text primarily for text content and widget content', 'it-residence'),
			    'section'	=>	'itre_typography',
			    'settings'	=>	[
					'font'		=>	'itre_gfonts_body',
					'weight'	=>	'itre_gweights_body',
					'category'	=>	'itre_gcat_body'
				],
			    'priority'	=>	15,
			    'input_attrs'	=> array(
			    	'font_id'		=>	'customize-control-itre_gfonts_body',
				   'weight_id'		=>	'customize-control-itre_gweights_body',
				   'cat_id'			=>	'customize-control-itre_gcat_body'
				)
		    )
	    )
    );

}
add_action( 'customize_register', 'itre_custom_fonts_customize_register' );
