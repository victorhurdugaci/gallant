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

if (!isset( $content_width )) {
	$content_width = 900;
}

add_action('init', 'register_menus');
add_action('after_setup_theme', 'register_features');

function register_features() {
	add_theme_support('menus');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('automatic-feed-links');
}

function register_menus() {
    register_nav_menu( 'mainmenu', __('The menu at the top of the website', 'gallant'));
}

?>