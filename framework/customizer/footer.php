<?php
/**
 *  Customizer Section for Footer
 */

 function itre_customize_register_footer( $wp_customize ) {

    $wp_customize->add_section(
        'itre_footer_section', array(
            'title'    => esc_html__('Footer', 'it-residence'),
            'priority' => 80,
        )
    );

	$wp_customize->add_setting(
		'itre_enable_contact_form', array(
			'default'			=>	'',
			'sanitize_callback'	=>	'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'itre_enable_contact_form', array(
			'label'		=>	__('Enable Contact Form', 'it-residence'),
			'type'		=>	'checkbox',
			'priority'	=>	4,
			'section'	=>	'itre_footer_section'
		)
	);

	$wp_customize->add_setting(
		'itre_contact_form_title', array(
			'default'			=>	'',
			'sanitize_callback'	=>	'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'itre_contact_form_title', array(
			'label'		=>	__('Contact Form Title', 'it-residence'),
			'priority'	=>	4,
			'section'	=>	'itre_footer_section'
		)
	);

	$wp_customize->add_setting(
		'itre_contact_form_desc', array(
			'default'			=>	'',
			'sanitize_callback'	=>	'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'itre_contact_form_desc', array(
			'label'		=>	__('Contact Form Description', 'it-residence'),
			'priority'	=>	4,
			'section'	=>	'itre_footer_section'
		)
	);

	$wp_customize->add_setting(
		'itre_contact_form', array(
			'default'			=>	'',
			'sanitize_callback'	=>	'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'itre_contact_form', array(
			'label'		=>	__('Contact Form Shortcode', 'it-residence'),
			'priority'	=>	4,
			'section'	=>	'itre_footer_section'
		)
	);

	$cf_controls = array($wp_customize->get_control('itre_contact_form'), $wp_customize->get_control('itre_contact_form_title'), $wp_customize->get_control('itre_contact_form_desc'));

	foreach($cf_controls as $cf_control) {
		$cf_control->active_callback = function( $control ) {
			$setting = $control->manager->get_setting('itre_enable_contact_form');
			return (!empty($setting->value())) ? true : false;
		};
	}

    $wp_customize->add_setting(
        'itre_footer_cols', array(
            'default'  => 4,
            'sanitize_callback'    => 'absint'
        )
    );

    $wp_customize->add_control(
	    new itre_Image_Radio_Control(
		    $wp_customize, 'itre_footer_cols', array(
			    'label'    =>  esc_html__('Select the Footer Layout', 'it-residence'),
	            'section'  =>  'itre_footer_section',
	            'priority' => 5,
	            'type'	   => 'image-radio',
	            'choices'	=>	array(
		            '1'	=>	array(
			            'name'	=>	esc_html__('1 Column', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/1-column.png'),
		            ),
		            '2'	=>	array(
			            'name'	=>	esc_html__('2 Columns', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/2-columns.png'),
		            ),
		            '3'	=>	array(
			            'name'	=>	esc_html__('3 Columns', 'it-residence'),
			            'image'	=>  esc_url(get_template_directory_uri() . '/assets/images/3-columns.png'),
		            ),
		            '4'	=>	array(
			            'name'	=>	esc_html__('4 Columns', 'it-residence'),
			            'image'	=> esc_url(get_template_directory_uri() . '/assets/images/4-columns.png'),
		            ),
	            )
	        )
	    )
    );

    $wp_customize->add_setting(
	    'itre_disable_footer_credits', array(
		    'default'	=>	'',
		    'sanitize_callback'	=>	'itre_sanitize_checkbox'
	    )
    );

    $wp_customize->add_control(
	    'itre_disable_footer_credits', array(
		    'label'		=>	__('Disable Footer Credits', 'it-residence'),
		    'type'		=>	'checkbox',
		    'priority'	=>	8,
		    'section'	=>	'itre_footer_section'
	    )
    );

     $wp_customize->add_setting(
         'itre_footer_text', array(
             'default'  => '',
             'sanitize_callback'    =>  'sanitize_text_field'
         )
     );

     $wp_customize->add_control(
         'itre_footer_text', array(
             'label'    =>  esc_html__('Custom Footer Text', 'it-residence'),
             'description'  =>  esc_html__('Will show Default Text if empty', 'it-residence'),
             'priority' =>  10,
             'type'     =>  'text',
             'section'  => 'itre_footer_section'
         )
     );
 }
 add_action('customize_register', 'itre_customize_register_footer');
