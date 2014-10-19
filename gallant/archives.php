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
/*
Template Name: Archives
*/

get_header();

ob_start();

$allposts = get_posts('numberposts=-1&order=DESC&orderby=date');
$currentMonth=''; 
foreach($allposts as $post) {
    $selectedPostDate = mysql2date('F Y', $post->post_date);
    if ($currentMonth != $selectedPostDate) {
        if ($currentMonth != '') {
            ?></ul><?php
        }        
        $currentMonth = $selectedPostDate; ?>
        <h3><?php echo $currentMonth ?></h3>
        <ul><?php
    }
    ?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
}

$page_content = ob_get_clean();

// We are done with the loop so rewind it
wp_reset_postdata();

$renderer->Render_Post(array(
    Content_Renderer::NO_META        => true,
    Content_Renderer::STATIC_CONTENT => $page_content
));
						
get_footer(); 

?>