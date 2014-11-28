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

add_action('widgets_init', 'register_theme_sidebars');

function register_theme_sidebars() {
    register_sidebar(array(
        'id'              => Sidebars::Right,
        'name'            => __('Right Side', 'gallant'),
        'description'     => __('The main sidebar situated on the right side, next to the content.', 'gallant'),
        'before_widget'   => '<div class="widget">',
        'after_widget'    => '</div>',
        'before_title'    => '<h4 class="widget-title">',
        'after_title'     => '</h4>'
    ));
    
    register_footer_sidebar();
}

function register_footer_sidebar() {
    $columns = intval(get_theme_mod(Theme_Options::FOOTER_COLUMNS));
    if ($columns < 1 || 4 < $columns) {
        $columns = Theme_Options::FOOTER_COLUMNS_DEFAULT;
    }
    
    //Bootstrap allows up to 12 columns
    $boostrap_col = 12 / $columns;
    
    register_sidebar(array(
        'id'            => Sidebars::Footer,
        'name'          => __('Footer', 'gallant'),
        'description'   => __('Located at the bottom of every page.', 'gallant'),
        'before_widget' => '<div class="col-sm-' . $boostrap_col .'">',
        'after_widget'  => '</div>',
    ));
}

abstract class Sidebars {
    const Right = 'right';
    const Footer = 'footer';
    /* TODO: consider for later
    const Index = 'index';
    const BeforePost = 'before-post';
    const AfterPost = 'after-post';*/
}
?>