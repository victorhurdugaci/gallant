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

$renderer = new Content_Renderer();

class Content_Renderer {
    const SHOW_EXCERPT = 'show_excerpt';
    const NO_COMMENTS = 'no_comments';
    const NO_NAVIGATION = 'no_navigation';
    const NO_META = 'no_meta';
    const NO_TAGS = 'no_tags';
    const NO_DATE = 'no_date';
    const STATIC_TITLE = 'static_title';
    const STATIC_CONTENT = 'static_content';
    const HIGHLIGHT_STICKY = 'highlight_sticky';

    private $defaults = array(
        Content_Renderer::SHOW_EXCERPT      => false,
        
        Content_Renderer::NO_COMMENTS       => false,
        Content_Renderer::NO_NAVIGATION     => false,

        Content_Renderer::NO_META           => false,
        Content_Renderer::NO_TAGS           => false,
        Content_Renderer::NO_DATE           => false,
        
        Content_Renderer::STATIC_TITLE      => null,
        Content_Renderer::STATIC_CONTENT    => null,
        
        Content_Renderer::HIGHLIGHT_STICKY  => false,
    );

    public function Render_Content_Not_Found() {
        $static_content = 
            '<p>' . __('Sorry, but you are looking for something that is not here.', 'gallant') .'</p>' .
            '<p><a class="btn btn-info" href="' . home_url() . '">' . __('Go to the main page', 'gallant') .'</a></p>';
        
        $this->Render_Post(array(
            Content_Renderer::STATIC_TITLE   => __('Content not found', 'gallant'),
            Content_Renderer::NO_META        => true,
            Content_Renderer::STATIC_CONTENT => $static_content
        ));
    }
    
    public function Render_Post($args = array()) {     
        $args = wp_parse_args($args, $this->defaults);
        $this->adjust_args($args);
        
        $static_content = $args[Content_Renderer::STATIC_CONTENT];
        $has_static_content = $static_content != null && $static_content != '';
        
        $post_classes = $has_static_content?
                array('post'):
                get_post_class('post');
        
        ?><div class="<?php echo $this->create_class_string($post_classes); ?>"><?php
            $this->render_post_header($args);
            $this->render_post_body($args);
            
            if (!$has_static_content) {
                $this->render_post_footer($args);
            }
            
            $no_comments = $args[Content_Renderer::NO_COMMENTS];
            if (!$no_comments) {
                comments_template();
            }
        ?></div><?php
    }
    
    private function adjust_args(&$args) {
        global $post;
              
        if ($args[Content_Renderer::SHOW_EXCERPT]) {
            $args[Content_Renderer::NO_NAVIGATION] = true;
        }
        
        if (!isset($post) || $post->post_type != 'post') {
            $args[Content_Renderer::NO_NAVIGATION] = true;
            $args[Content_Renderer::NO_TAGS] = true;
            $args[Content_Renderer::NO_DATE] = true;
        }
        
        if (get_theme_mod(Theme_Options::DISABLE_COMMENTS)) {
            $args[Content_Renderer::NO_COMMENTS] = true;
        }
    }

    private function render_post_header($args) {
        global $post;
        
        ?><div class="post-header page-header"><?php

        ?><h1><?php
            $static_title = $args[Content_Renderer::STATIC_TITLE];
            
            if (is_null_or_empty($static_title)) {
                $title = get_the_title();
                if (is_null_or_empty($title)) {
                    // Edge case: post has no title
                    $title = get_the_date();
                }
                ?><a href="<?php the_permalink() ?>" title="Permanent link" class="wrap"><?php echo $title ?></a><?php
            }
            else {
                echo $static_title;
            }
        ?></h1><?php
        
        $no_meta = $args[Content_Renderer::NO_META] || 
                   $static_title ||
                   post_password_required();
                   
        // Meta (date, tags, author, etc)
        if (!$no_meta) {
            $no_date = $args[Content_Renderer::NO_DATE];
            $this->render_if_not_empty(array(
                'before'    => '<p>',
                'after'     => '</p>',
                'func'      => function() use($args) {
                    if (!$args[Content_Renderer::NO_DATE]) {
                        ?><span class="glyphicon glyphicon-time"></span>&nbsp;<?php the_time('M jS, Y') ?>&nbsp;<?php
                    }
                    
                    if (!$args[Content_Renderer::NO_COMMENTS] && (
                        comments_open() || have_comments())) {
                        ?><span class="glyphicon glyphicon-comment"></span>&nbsp;<a href="<?php comments_link(); ?>"><?php 
                            comments_number(
                                __('No comments', 'gallant'),
                                __('One comment', 'gallant'), 
                                __('% comments', 'gallant')); 
                        ?></a><?php
                    }
                }
            ));
            
            if (!$args[Content_Renderer::NO_TAGS]) {
                $this->render_if_not_empty(array(
                    'func'   => function() { the_tags(""); },
                    'before' => '<p><span class="glyphicon glyphicon-tag"></span>&nbsp;',
                    'after'  => '</p>'
                ));
            } 
        }    
        ?></div><?php
    }
        
    private function render_post_body($args = array()) {        
        ?><div class="post-body"><?php
            $static_content = $args[Content_Renderer::STATIC_CONTENT];
            $is_static_content = ($static_content != null && $static_content != '');
            if ($is_static_content) {
                echo $static_content;
            }
            else {
                if ($args[Content_Renderer::SHOW_EXCERPT]) {
                    the_excerpt();
                }
                else {
                    the_content(__('Read the rest of this post', 'gallant') . ' &raquo;');
                    $this->render_multipage_navigation();
                }
            }
        ?></div><?php
    }

    private function render_post_footer($args) {  
         // Not used but required by the validator
        if (false) {
            wp_link_pages();
        }
    
        $this->render_if_not_empty(array(
            'before'    => '<div class="post-footer">',
            'after'     => '</div>',
            'func'      => 
                function() use($args) {
                    if (!$args[Content_Renderer::NO_NAVIGATION]) {
                        ?><ul class="pager">
                            <li class="previous"><?php next_post_link('%link', '&larr; %title') ?></li>
                            <li class="next"><?php previous_post_link('%link', '%title &rarr;') ?></li>
                        </ul><?php 
                    }
                }
        ));
    }

    private function render_if_not_empty($args) {
        $defaults = array(
            'before' => '',
            'after'  => '',
            'func'   => function() {}
        );
        
        $args = wp_parse_args($args, $defaults);

        ob_start();
        $args['func']();
        $buffer_content = ob_get_clean();
        
        if (!is_null_or_empty($buffer_content)) {
            echo $args['before'] . $buffer_content . $args['after'];
        }
    }
    
    private function render_multipage_navigation() {
        global $page, $numpages, $multipage, $more;
        
        // Either we are in a single page post
        // or on the home page ($more = null)
        if (!$multipage || $more == null) {
            return;
        }
        
        ?><ul class="pagination"><?php
        
        // Previous
        $this->render_multipage_link($page-1, '&laquo;');
        
        for ($i = 1; $i <= $numpages; $i++) {
            $this->render_multipage_link($i);
        }
        
        // Next
        $this->render_multipage_link($page+1, '&raquo;');
        
        ?></ul><?php
    }

    /**
     * Creates a single navigation link to a page of a multipage post
     * If the page doesn't exist, it will generate a disabled link sending to #
     *
     * @param int $page_index The index of the page to which the link will send
     * @param string| $text An optional text that will be displayed instead of the page number
     */
    private function render_multipage_link($page_index, $text = null) {
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
            // This is similar to what _wp_link_page
            $link = '<a href="#">';
            
            $item_class = 'disabled';
        }
        
        // ... and complete the link
        $link .= $text . '</a>';
        
        ?><li class="<?php echo $item_class ?>"><?php echo $link ?></li><?php
    }
    
    private function create_class_string($classes_array) {
        return join(' ', $classes_array);
    }
}
?>