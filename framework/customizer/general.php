<?php
/**
 *	Customizer Controls for General Settings for the theme
 */

function itre_general_customize_register( $wp_customize ) {

	$wp_customize->add_section(
		"itre_general_options", array(
			"title"			=>	esc_html__("General", 'it-residence'),
			"description"	=>	esc_html__("General Settings for the Theme", 'it-residence'),
			"priority"		=>	5
		)
	);

	$wp_customize->add_setting(
        'itre_sidebar_width', array(
            'default'    =>  25,
            'sanitize_callback'  =>  'absint'
        )
    );

    $wp_customize->add_control(
        new itre_Range_Value_Control(
            $wp_customize, 'itre_sidebar_width', array(
	            'label'         =>	esc_html__( 'Sidebar Width', 'it-residence' ),
            	'type'          => 'itre-range-value',
            	'section'       => 'itre_general_options',
            	'settings'      => 'itre_sidebar_width',
                'priority'		=>  5,
            	'input_attrs'   => array(
            		'min'            => 25,
            		'max'            => 40,
            		'step'           => 1,
            		'suffix'         => '%', //optional suffix
				),
            )
        )
    );

	$wp_customize->add_setting(
	    'itre_area_units', array(
		    'default'			=>	'ft',
		    'sanitize_callback'	=>	'itre_sanitize_radio'
	    )
    );

	$wp_customize->add_control(
	    'itre_area_units', array(
		    'label'		=>	__('Area Unit  for Properties', 'it-residence'),
		    'type'		=>	'radio',
		    'section'	=>	'itre_general_options',
		    'priority'	=>	13,
		    'choices'	=>	array(
			    'ft'	=>	__('Sq Ft', 'it-residence'),
			    'm'	=>	__('Sq Meter', 'it-residence'),
				'yd'=>	__('Sq Yard', 'it-residence')
		    )
	    )
	);

	$wp_customize->add_setting(
	    'itre_currency', array(
		    'default'			=>	'dollar',
		    'sanitize_callback'	=>	'itre_sanitize_radio'
	    )
    );


	$wp_customize->add_control(
	    'itre_currency', array(
		    'label'		=>	__('Currency', 'it-residence'),
		    'type'		=>	'radio',
		    'section'	=>	'itre_general_options',
		    'priority'	=>	14,
		    'choices'	=>	array(
			    'dollar'	=>	__('US Dollar', 'it-residence'),
				'pound'		=>	__('British Pound', 'it-residence'),
				'ruble'		=>	__('Russian Ruble', 'it-residence'),
				'yen'		=>	__('Chinese Yen', 'it-residence'),
				'euro'		=>	__('Euro', 'it-residence'),
				'custom'	=> __('Custom', 'it-residence')
		    )
	    )
	);

	$wp_customize->add_setting(
		'itre_custom_currency_locale', array(
			'default'		=>	'',
			'sanitize_callback'	=>	'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'itre_custom_currency_locale', array(
			'label'		=>	__('Currency Locale', 'it-residence'),
			'description'	=>	__('You can find it <a href="https://simplelocalize.io/data/locales/">here</a> ("Country Locale" column)', 'it-residence'),
			'section'		=>	'itre_general_options',
			'priority'		=> 15
		)
	);

	$wp_customize->add_setting(
		'itre_custom_currency_code', array(
			'default'		=>	'',
			'sanitize_callback'	=>	'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'itre_custom_currency_code', array(
			'label'		=>	__('Currency Code', 'it-residence'),
			'description'	=>	__('You can find it <a href="https://simplelocalize.io/data/locales/">here</a> ("Country Code" column)', 'it-residence'),
			'section'		=>	'itre_general_options',
			'priority'		=> 15
		)
	);

	$wp_customize->add_setting(
	    'itre_back_to_top', array(
		    'default'	=>	1,
		    'sanitize_callback'	=>	'itre_sanitize_checkbox'
	    )
    );

	$currency_controls = [$wp_customize->get_control('itre_custom_currency_locale'), $wp_customize->get_control('itre_custom_currency_code')];

	foreach($currency_controls as $currency_control) {
		$currency_control->active_callback = function( $control ) {
			$setting = $control->manager->get_setting('itre_currency');
			return $setting->value() === 'custom' ? true : false;
		};
	}

    $wp_customize->add_control(
	    'itre_back_to_top', array(
		    'label'		=>	__('Enable Back to Top Button', 'it-residence'),
		    'type'		=>	'checkbox',
		    'priority'	=>	15,
		    'section'	=>	'itre_general_options'
	    )
    );
}
add_action("customize_register", "itre_general_customize_register");
