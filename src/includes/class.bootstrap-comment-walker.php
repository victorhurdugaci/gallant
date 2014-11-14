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

class Bootstrap_Comment_Walker extends Walker_Comment {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $GLOBALS['comment_depth'] = $depth + 1;
        
        $output .= "\n<div class='comments-list'>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $GLOBALS['comment_depth'] = $depth + 1;
        
        $output .= "\n</div>\n";
    }
    
    function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {  
        $depth++; 
        $GLOBALS['comment_depth'] = $depth; 
        $GLOBALS['comment'] = $comment; 
        
        ob_start();
        $this->render_comment($comment, $depth, $args);
        $output .= ob_get_clean();
    }
    
    function end_el(&$output, $comment, $depth = 0, $args = array()) {
        // Not used
    }
    
    private function render_comment($comment, $depth, $args) {
        $is_ping = ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') && 
                    $args['short_ping'];
        
        $comment_panel_style = 'default';
        if ($comment->user_id > 0) { 
            if($post = get_post()) {
                if ($comment->user_id === $post->post_author) {
                    $comment_panel_style = 'info'; 
                }
            }
        }?>
        
        <div id="comment-<?php comment_ID(); ?>" <?php comment_class("panel panel-" . $comment_panel_style) ?>>
            <div class="comment-meta panel-heading">
                <?php $this->render_comment_header($comment, $is_ping, $args); ?>
            </div>
            <div class="comment-body panel-body">
                <div id="comment-body-<?php comment_ID(); ?>">
                    <?php $this->render_comment_body($is_ping, $depth, $args); ?>
                </div>
            </div>
        </div><?php
    }
    
    private function render_comment_header($comment, $is_ping, $args) {
        // Avatar and author
        $avatar = '';
        if ($is_ping) {
            $avatar = __('Pingback from ', 'gallant');
        }
        else {
            if ($args['avatar_size'] != 0) {
                $avatar = get_avatar($comment, $args['avatar_size']);
            }
            if ($avatar == '') {
                $avatar = '<span class="glyphicon glyphicon-user"></span>';
            }
        }
        
        echo sprintf('%s&nbsp;%s&nbsp;',
            $avatar,
            get_comment_author_link()); 
            
        // Date ?>
        <span class='glyphicon glyphicon-time'></span>&nbsp;<?php comment_date('M jS, Y @ h:i a T');
        
        // Permanent link
        if (!$is_ping) { ?>
             <a href='<?php echo get_comment_link( $comment, $args ) ?>'><span class='glyphicon glyphicon-link'></span></a><?php
        }
        
        // Edit link
        edit_comment_link("<span class='post-date glyphicon glyphicon-pencil'>&nbsp;", '', '' );
        
        // Moderation notification
        if ($comment->comment_approved == '0') { ?>
            <span class="label label-warning"><?php _e('Waiting for moderation', 'gallant') ?></span><?php
        }
    }
    
    private function render_comment_body($is_ping, $depth, $args) {
        comment_text(get_comment_id());
        
        // Reply link
        if (!$is_ping) {
            echo '<p>';
            comment_reply_link(array_merge($args, array( 
                'add_below' => 'comment-body', 
                'depth'     => $depth, 
                'max_depth' => $args['max_depth'], 
                'before'    => '<span>', 
                'after'     => '</span>',
                'reply_text'=> '<span class="glyphicon glyphicon-share-alt"></span> '. __('Reply', 'gallant')
            )));
            echo '</p>';
        }
    }
}

?>