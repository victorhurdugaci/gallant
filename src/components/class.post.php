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

require_once('class.post-header.php');
require_once('class.post-footer.php');
require_once('class.post-options.php');

class Post {
    public static function Render_Content_Not_Found() {
        $options = new Post_Options();
        
        $options->Set_Static_Content( 
            '<p>' . __('Sorry, but you are looking for something that\'s not here.', 'gallant') .'</p>' .
            '<p><a class="btn btn-primary" href="' . home_url() . '">' . __('Go to the main page', 'gallant') .'</a></p>');
        
        $options->Get_Header_Options()->Set_Static_Title(__('Content not found', 'gallant'));
        $options->Get_Header_Options()->Disable_Meta();
        $options->Disable_Footer();
        
        Post::Render($options);
    }
    
    public static function Render($options = NULL) {
        if ($options == NULL) {
            $options = new Post_Options();
        }
      
        $post_classes = $options->Get_Is_Static() ?
                array('post') :
                get_post_class('post'); ?>
          
        <div class="<?= Render_Helper::Create_Class_String($post_classes); ?>"><?php
            if (!$options->Get_No_Header()) {
                Post_Header::Render($options->Get_Header_Options());
            }
            
            Post::render_body($options);
            
            if (!$options->Get_No_footer()) {
                Post_Footer::Render($options->Get_Footer_Options());
            } ?>
        </div><?php
    }
    
    public static function Render_Preview() {
        $options = new Post_Options();
        
        $options->Disable_Meta();
        
        Post::Render();
    }
    
    private static function render_body($options) { ?>    
        <div class="post-body"><?php     
            if (!$options->Get_Is_Static()) {
                 if ($options->Get_Use_Excerpt()) {
                    the_excerpt(); ?>
                    <a class="read-more btn btn-default" href="<?php the_permalink(get_the_ID())?>"><?= __('Continue reading &raquo;', 'muiw')?></a><?php         
                 }
                 else {
                    edit_post_link('<span class="glyphicon glyphicon-pencil"></span> Edit'); 
                    the_content(__('Read the rest of this post', 'gallant') . ' &raquo;');
                    Post::render_multipage_navigation();
                 }
            }
            else {
                 echo $options->Get_Static_Content();
            } ?>
        </div><?php
    }
    
    private static function render_multipage_navigation() {
        global $page, $numpages, $multipage, $more;
        
        // Either we are in a single page post
        // or on the home page ($more = null)
        if (!$multipage || $more == null) {
            return;
        } ?>
        
        <ul class="pagination"><?php
            // Previous
            Post::render_multipage_link($page-1, '&laquo;');
            
            for ($i = 1; $i <= $numpages; $i++) {
                Post::render_multipage_link($i);
            }
            
            // Next
            Post::render_multipage_link($page+1, '&raquo;'); ?>
        </ul><?php
    }

    /**
     * Creates a single navigation link to a page of a multipage post
     * If the page doesn't exist, it will generate a disabled link sending to #
     *
     * @param int $page_index The index of the page to which the link will send
     * @param string| $text An optional text that will be displayed instead of the page number
     */
    private static function render_multipage_link($page_index, $text = null) {
        global $page, $numpages;
        
        if ($text == null || $text == '') {
            $text = $page_index;
        }
        
        $item_class = '';
        $link = '';
        
        $is_existing_page = (1 <= $page_index && $page_index <= $numpages);
      
        if ($is_existing_page) {
            $link = _wp_link_page($page_index);
        
            if ($page_index == $page) {
                $item_class = 'active';
            }
        }
        else {
            // This is similar to what _wp_link_page does
            $link = '<a href="#">';
            
            $item_class = 'disabled';
        }
        
        // ... and complete the link
        $link .= $text . '</a>';?>
        
        <li class="<?= $item_class ?>"><?= $link ?></li><?php
    }
}

?>