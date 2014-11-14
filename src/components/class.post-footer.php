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

require_once('class.post-footer-options.php');

class Post_Footer {
    public static function Render($options) {  
        if ($options == NULL) {
            $options = new Post_Footer_Options();
        }
        
         // Not used but required by the validator
        if (false) {
            wp_link_pages();
        }
        
        Post_Footer::render_navigation($options);
        Post_Footer::render_comments($options);
    }
    
    private static function render_navigation($options) {
        Render_Helper::Render_If_Not_Empty(array(
            'before'    => '<div class="post-footer">',
            'after'     => '</div>',
            'func'      => 
                function() use($options) {
                    if (!$options->Get_No_Sidebar()) {
                        get_sidebar(Sidebars::BelowContent);
                    }
                    
                    if (!$options->Get_No_Navigation()) { ?> 
                        <ul class="pager">
                            <li class="previous"><?php next_post_link('%link', '&larr; %title') ?></li>
                            <li class="next"><?php previous_post_link('%link', '%title &rarr;') ?></li>
                        </ul><?php 
                    }
                }
        ));
    }
    
    private static function render_comments($options) {
        if (!$options->Get_No_Comments()) {
           comments_template();
        }
    }
}

?>