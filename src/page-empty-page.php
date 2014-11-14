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

/*
Template Name: Empty Page
*/

require('components/class.post.php');
require('includes/head.php'); ?>
<div class="container gallant-container">            
    <div class="row">
        <div class="col-sm-12 gallant-content"><?php
            the_post();       
            
            $options = new Post_Options(); 
            $options->Disable_Header();
            $options->Disable_Footer();
            
            Post::Render($options);
                
            ?>
        </div>
    </div>
</div> 
<?php wp_footer(); ?>
</body>
</html>