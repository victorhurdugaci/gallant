<?php 
/*
    Copyright Victor Hurdugaci (http://victorhurdugaci.com)

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

define('ROOT_PATH', dirname(__DIR__) . '/');
require_once(ROOT_PATH . 'includes/class.render-helper.php');
require_once('class.post-header-options.php');

class Post_Header {
	public static function Render($options = NULL) {
		if ($options == NULL) {
			$options = new Post_Header_Options();
		}
        
        // Figure out the post title
        $title = $options->Get_Static_Title();
        
        if (!$options->Get_Is_Static()) {
            $title = get_the_title();
            if (is_null_or_empty($title)) {
                // Edge case: post has no title
                $title = get_the_date();
            }
        }
		
		?><div class="post-header page-header"><?php
        
        if (!$options->Get_No_Sidebar()) {
            get_sidebar(Sidebars::AboveContent);
        }
        
        $smallFeatureImage = !$options->Get_Use_Large_Feature_Image();
        Post_Header::render_feature_image(
            $smallFeatureImage,
            $smallFeatureImage?'post-preview-thumbnail':''
        );
        
        ?><h1><?php
            if (!$options->Get_Is_Static()) {
                ?><a href="<?php the_permalink() ?>" title="<?= $title ?>" class="wrap"><?= $title ?></a><?php
            }
            else {
                echo $title;
            }
        ?></h1><?php
        
        $no_meta = $options->Get_No_Meta() ||
                   post_password_required();
                   
        // Meta (date, tags, author, etc)
        if (!$no_meta) {
            Render_Helper::Render_If_Not_Empty(array(
                'before'    => '<p>',
                'after'     => '</p>',
                'func'      => function() use($options) {
                    if (!$options->Get_No_Date()) {
                        ?><span class="glyphicon glyphicon-time"></span>&nbsp;<?php the_time('M jS, Y') ?>&nbsp;<?php
                    }
                }
            ));
            
            if (!$options->Get_No_Author()) {
                ?><p class="post-author"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php the_author(); ?></p><?php
            }
            
            if (!$options->Get_No_Tags()) {
                Render_Helper::Render_If_Not_Empty(array(
                    'func'   => function() { the_tags(""); },
                    'before' => '<p class="post-tags"><span class="glyphicon glyphicon-tag"></span>&nbsp;',
                    'after'  => '</p>'
                ));
            }
                
            if (!$options->Get_No_Categories()) {
                Render_Helper::Render_If_Not_Empty(array(
                    'func'   => function() { the_category(", "); },
                    'before' => '<p class="post-categories"><span class="glyphicon glyphicon-list"></span>&nbsp;',
                    'after'  => '</p>'
                ));
            }
        }    
        ?></div><?php
	}
    
    private static function render_feature_image($small = false, $classes='')
    {
        if (has_post_thumbnail()) {
            $postId = get_the_ID();
            
            $imageUrl = wp_get_attachment_image_src(
                get_post_thumbnail_id($postId), 
                $small? 'medium': 'full' 
                )[0];
                
            ?><img src="<?= $imageUrl ?>" class="<?= $classes ?>" /><?php
        }
    }

}

?>