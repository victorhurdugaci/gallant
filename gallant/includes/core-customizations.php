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
/**
 * This file contains various customizations to the core functionality of WordPress
 */

add_action('after_setup_theme', 'after_theme_setup');
add_filter('the_password_form', 'bootstrap_password_form');

function after_theme_setup(){
    // i18n stuff 
    load_theme_textdomain('gallant', get_template_directory() . '/languages');
}

// Change the password form that shows up when a post is password protected
function bootstrap_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    ob_start(); ?>
    <form action="<?php echo esc_url(site_url('wp-login.php?action=postpass', 'login_post' )) ?>" method="post">
        <p><?php _e('To view the contents, enter the post password.', 'gallant') ?></p>
        <div class="form-group">
            <input id="<?php echo $label ?>" name="post_password" type="password" class="form-control" size="20" maxlength="20" placeholder="<?php _e('Password', 'gallant') ?>" />
        </div>
        
         <button type="submit" class="btn btn-primary"><?php esc_attr_e('Submit', 'gallant') ?></button>
    </form>
    
    <?php
    return ob_get_clean();
}

?>