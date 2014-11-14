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

require('components/class.post.php');

get_header(); ?>
<div class="container gallant-container">            
    <div class="row">
        <div class="col-sm-9 gallant-content"> <?php
            if (have_posts()) {    
                the_post();       
             
                $options = new Post_Options(); 
                $options->Get_Footer_Options()->Disable_Navigation();
             
                Post::Render($options);
            }
            else {
                Post::Render_Content_Not_Found();
            }
                
            ?>
        </div>
        <div class="col-sm-3">
            <?php get_sidebar(Sidebars::Right); ?>
        </div>
    </div>
</div> 
<?php get_footer(); ?>