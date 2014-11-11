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
            if (is_singular()) {
                wp_enqueue_script('comment-reply');
            }
            
            wp_enqueue_style ( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, false);
            wp_enqueue_style ( 'gallant', get_stylesheet_uri() );
            
            wp_enqueue_script( 'jquery-2', get_template_directory_uri() . '/js/jquery-2.1.1.min.js', array(), false, true);
            wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery-2'), false, true);
            
            wp_head(); 
        ?>
    </head>
    <body body_class()>
        <?php require('includes/navbar.php'); ?>

        <div class="container">            
            <div class="row">
                <div class="col-sm-9">
