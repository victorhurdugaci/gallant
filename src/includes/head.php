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

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php wp_title(); ?></title>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php
            wp_enqueue_style ('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, false);
            wp_enqueue_style ('gallant', get_template_directory_uri() . '/css/gallant.css', array('theme', 'bootstrap'), false, false);
            wp_enqueue_style ('theme', get_stylesheet_uri());
            
            wp_enqueue_style ('open_sans', 'https://fonts.googleapis.com/css?family=Open+Sans', array('gallant'), false, false); 

            wp_enqueue_script('gallant', get_template_directory_uri() . '/js/gallant.js', array('jquery', 'bootstrap'), false, true);
            wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true);

            wp_head(); 
        ?>
    </head>
    <body <?php body_class() ?>>