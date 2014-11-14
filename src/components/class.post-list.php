<?php

require_once('class.post.php');
require_once('class.pager.php');

class Post_List_Options {
	public $no_pager = false;
    public $no_above_content_sidebar = false;
}

class Post_List {
	public static function Render($options = NULL) {
		if ($options == NULL) {
			$options = new Post_List_Options();
		}

		if (!have_posts()) {
			Post::Render_Content_Not_Found();
		}

        $postRenderOptions = new Post_Options();
        $postRenderOptions->Use_Excerpt();
        $postRenderOptions->Get_Header_Options()->Disable_Sidebar();

        ?><div class="post-list"><?php
        
        $sidebar_shown = false;
        
	    while (have_posts()) {
            the_post();
            Post::Render($postRenderOptions);
            
            if (!$sidebar_shown) {
                 $sidebar_shown = true;
                 $postRenderOptions->Get_Header_Options()->Enable_Sidebar();
            }
            else {
                $postRenderOptions->Get_Header_Options()->Disable_Sidebar();
            }
    	}
        ?></div><?php
        
        if (!$options->no_pager) {
            Pager::Render();
        }
	}
}

?>