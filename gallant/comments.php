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

if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
    die (__('Please do not load this page directly. Thanks!', 'gallant'));
}

if (post_password_required() ||
    (!comments_open() &&
     !have_comments())) {
    return;
}

require("includes/class.bootstrap-comment-walker.php");
add_filter('comment_class','comment_add_microid');

?><div class="post-comments"><?php
    render_comments_list();
    render_reply_form($post, $user_ID, $user_identity, $id);
?></div><?php

function render_comments_list() {
    global $post;

    if (!have_comments()) {
        ?><h4><a name="comments"></a><?php _e('No comments','gallant') ?></h4><?php
        return;
    }
    
    ?><h4 id="comments"><?php comments_number(
        __('No comments', 'gallant'),
        __('One comment', 'gallant'),
        __('% comments', 'gallant'));?></h4><?php

    ?><div class="comments-list" id="singlecomments"><?php
        wp_list_comments(array(
            'avatar_size'=>24,
            'reply_text'=>__('Reply to this comment', 'gallant'),
            'short_ping'=>true,
            'walker'=>new Bootstrap_Comment_Walker()));
    ?></div>

    <ul class="pager">
        <li class="previous"><?php previous_comments_link('&larr; ' . __('Older', 'gallant')) ?></li>
        <li class="next"><?php next_comments_link(__('Newer', 'gallant') . ' &rarr;') ?></li>
    </ul><?php
}

function render_reply_form($post, $user_ID, $user_identity, $id) {
    if (!comments_open()) {
        return;
    }
    ?><div id="respond">
        <h4><?php comment_form_title(); ?></h4><?php
        
        if (get_option('comment_registration') && !$user_ID) {
            ?><p><?php echo sprintf(
                __('You must be %slogged in%s to post a comment.', 'gallant'),
                '<a href="' . site_url() . '/wp-login.php?redirect_to=' . urlencode(get_permalink()) . '">',
                '</a>') ?></p>
            </div><?php /* closes the respond div */
            return;
        }?>
        
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" role="form">
            <div><?php comment_id_fields(); ?>
            <input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" /></div>
        
            <?php render_reply_commenter_info($user_ID, $user_identity); ?>
            
            <div class="form-group">
                <textarea id="comment" name="comment" rows="10" class="form-control" placeholder="<?php _e('Please write the comment in English. Some HTML allowed.', 'gallant'); ?>"></textarea>
            </div>
            
            <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
            
            <div id="submit" >
                <?php if (get_option("comment_moderation") == "1") { ?>
                    <p class="alert alert-info"><?php _e('Comment moderation is enabled and it might take a while until your comment shows up. There is no need to resubmit your comment.', 'gallant'); ?></p>
                <?php } ?>
            
                <button type="submit" class="btn btn-primary">Submit</button>
                <?php cancel_comment_reply_link(__('Cancel', 'gallant')); ?>
            </div>
            
            <?php 
                do_action('comment_form', $post->ID);
                
                // Not used but required by the validator
                if (false) {
                    wp_comment_form();
                }
            ?>
        </form>
    </div><?php
}

function render_reply_commenter_info($user_ID, $user_identity) {
    if ($user_ID) { ?>
        <p>
            <?php echo sprintf(
                __('Commenting as %s', 'gallant'),
                '<a href="' . get_option('siteurl') . '/wp-admin/profile.php' . '">' . $user_identity . '</a>')?>
            (<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Logout"><?php _e('Not you?', 'gallant') ?></a>) 
        </p><?php
        return;
    }
?>
    <div class="form-group">
        <input id="author" name="author" type="text" value="<?php echo $comment_author; ?>" class="form-control" placeholder="<?php _e('Name', 'gallant'); ?>" required="required" />
    </div>
    <div class="form-group">
        <input id="email" name="email" type="email" value="<?php echo $comment_author_email; ?>" class="form-control" placeholder="<?php _e('E-mail', 'gallant'); ?>" />
    </div>
    <div class="form-group">
        <input id="url" name="url" type="url" value="<?php echo $comment_author_url; ?>" class="form-control" placeholder="<?php _e('Website', 'gallant'); ?>" />
    </div>
<?php
}

// add a microid to all the comments
function comment_add_microid($classes) {
    $c_email=get_comment_author_email();
    $c_url=get_comment_author_url();
    if (!empty($c_email) && !empty($c_url)) {
        $microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$c_email).sha1($c_url));
        $classes[] = $microid;
    }
    return $classes;	
}

?>