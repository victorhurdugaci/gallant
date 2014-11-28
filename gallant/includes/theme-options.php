<?php
/*
    Copyright 2014 Victor Hurdugaci (http://victorhurdugaci.com)

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
*/
?>
<?php

add_action('customize_register', 'register_theme_options');
add_action('customize_preview_init', 'options_live_preview' );

function options_live_preview()
{
	wp_enqueue_script( 
        'theme-options-livepreview',
		get_template_directory_uri().'/js/theme-options-livepreview.js',
		array('jquery', 'customize-preview' ),
		'',
		true
	);
}

function register_theme_options($wp_customize) {
    register_settings($wp_customize);
    register_settings_ui($wp_customize);
}

function register_settings_ui($wp_customize) {
    $appearance_section = 'appearance';
    $footer_section = 'footer';

    /* Appearance */
    $wp_customize->add_section($appearance_section , array(
        'title'       => __('Appearance', 'gallant'),
        'priority'    => 100,
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, Theme_Options::DISABLE_AUTHOR, array(
        'section'     => $appearance_section,
        'settings'    => Theme_Options::DISABLE_AUTHOR,
        'label'       => __('Disable author', 'gallant'),
        'description' => __('Hides author on posts. Useful if there is a single author.', 'gallant'),
        'type'        => 'checkbox'
    )));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, Theme_Options::DISABLE_CATEGORIES, array(
        'section'     => $appearance_section,
        'settings'    => Theme_Options::DISABLE_CATEGORIES,
        'label'       => __('Disable categories', 'gallant'),
        'description' => __('Hides categories on posts.', 'gallant'),
        'type'        => 'checkbox'
    )));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, Theme_Options::DISABLE_COMMENTS, array(
        'section'     => $appearance_section,
        'settings'    => Theme_Options::DISABLE_COMMENTS,
        'label'       => __('Disable comments', 'gallant'),
        'description' => __('Removes the comments form from all posts and pages. If there are already comments, it hides them.', 'gallant' ),
        'type'        => 'checkbox'
    )));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, Theme_Options::AUTO_TABLE_STYLE, array(
        'section'     => $appearance_section,
        'settings'    => Theme_Options::AUTO_TABLE_STYLE,
        'label'       => __('Style tables automatically', 'gallant'),
        'description' => sprintf(__('If enabled, all tables inside posts will get the \'%s\' class. Disable for a particular table by adding the \'%s\' (does not affect plugins).', 'gallant'), '.table', 'data-noautostyle="true"'),
        'type'        => 'checkbox'
    )));
    
    /* Footer section */
    $wp_customize->add_section($footer_section , array(
        'title'       => __('Footer', 'gallant'),
        'priority'    => 101,
    ));
        
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, Theme_Options::FOOTER_COLUMNS, array(
        'section'     => $footer_section,
        'settings'    => Theme_Options::FOOTER_COLUMNS,
        'label'       => __('Number of Columns', 'gallant'),
        'description' => __('The number of columns in the footer. Does not affect Footer Text.', 'gallant'),
        'type'        => 'select',
        'choices'     => 
            array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4'
            )
    )));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, Theme_Options::FOOTER_TEXT, array(
        'section'     => $footer_section,
        'settings'    => Theme_Options::FOOTER_TEXT,
        'label'       => __('Footer Text', 'gallant'),
        'description' => __('The text that shows up in the footer, under the footer sidebar. (HTML and PHP allowed)', 'gallant')
    )));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, Theme_Options::FOOTER_SHOW_SUPPORT, array(
        'section'     => $footer_section,
        'settings'    => Theme_Options::FOOTER_SHOW_SUPPORT,
        'label'       => __('Support Theme Author', 'gallant'),
        'description' => __('A link showing that your blog uses this theme will be displayed at the bottom of the page. Remember, this theme is free :)', 'gallant'),
        'type'        => 'checkbox'
    )));
}

function register_settings($wp_customize) {    
    /* Appearance */
    $wp_customize->add_setting(Theme_Options::DISABLE_CATEGORIES , array(
        'default'           => false,
        'sanitize_callback' => 'sanitize_boolean'
    ));  
    
    $wp_customize->add_setting(Theme_Options::DISABLE_AUTHOR , array(
        'default'           => false,
        'sanitize_callback' => 'sanitize_boolean'
    )); 
    
    $wp_customize->add_setting(Theme_Options::DISABLE_COMMENTS , array(
        'default'           => false,
        'sanitize_callback' => 'sanitize_boolean'
    ));  

    $wp_customize->add_setting(Theme_Options::AUTO_TABLE_STYLE , array(
        'default'           => true,
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_boolean'
    ));  
    
    /* Footer settings */
    $wp_customize->add_setting(Theme_Options::FOOTER_COLUMNS , array(
        'default'     => Theme_Options::FOOTER_COLUMNS_DEFAULT,
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_columns'
    ));  
    $wp_customize->add_setting(Theme_Options::FOOTER_TEXT , array(
        'default'     => '',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_none'
    ));
    $wp_customize->add_setting(Theme_Options::FOOTER_SHOW_SUPPORT , array(
        'default'     => true,
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_boolean'
    ));
    
    /* Theme global */
    $wp_customize->add_setting(Theme_Options::DISABLE_COMMENTS , array(
        'default'           => false,
        'sanitize_callback' => 'sanitize_boolean'
    ));  
}

function sanitize_boolean($val) {
    if (!isset($val) || ($val != 0 && $val != 1)) {
        return 1;
    }
    
    return $val;
}

function sanitize_columns($val) {
    if (!isset($val) || $val < 1 || $val > 4) {
        return Theme_Options::FOOTER_COLUMNS_DEFAULT;
    }
    
    return $val;
}

function sanitize_none($val) {
    return $val;
}

abstract class Theme_Options {
    const DISABLE_CATEGORIES = 'disable_categories';
    const DISABLE_AUTHOR = 'disable_author';
    const DISABLE_COMMENTS = 'disable_comments';
    
    const FOOTER_COLUMNS = 'footer_columns';
    const FOOTER_COLUMNS_DEFAULT = 3;
    
    const FOOTER_TEXT = 'footer_text';
    
    const FOOTER_SHOW_SUPPORT = 'footer_show_support';
    
    const AUTO_TABLE_STYLE = 'auto_table_style';
}

?>