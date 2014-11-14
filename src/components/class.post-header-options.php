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

class Post_Header_Options {
	private $static_title = null;
    
    private $no_meta = false;
    
    private $no_date = false;
    private $no_tags = false;
    private $no_categories = false;
    private $no_author = false;
    
    private $use_large_feature_image = false;
    private $use_sticky_market = false;
    
    private $no_sidebar = false;
    
    function __construct() {
        if (get_theme_mod(Theme_Options::DISABLE_TAGS)) {
            $this->no_tags = true;
        }
        
        if (get_theme_mod(Theme_Options::DISABLE_CATEGORIES)) {
            $this->no_categories = true;
        }
        
        if (get_theme_mod(Theme_Options::DISABLE_AUTHOR)) {
            $this->no_author = true;
        }
    }
    
    public function Get_Is_Static() {
        return !is_null_or_empty($this->static_title);
    }
    
    public function Get_Static_Title() {
        return $this->static_title;
    }
    
    public function Set_Static_Title($value) {
        $this->static_title = $value;
    }
    
    public function Get_No_Meta() {
        global $post;

        return $this->no_meta ||
               $this->Get_Is_Static() ||
               (isset($post) && $post->post_type != 'post');
    }
    
    public function Get_No_Date() {
        return $this->no_date || $this->Get_No_Meta();
    }
        
    public function Get_No_Tags() {
        return $this->no_tags || $this->Get_No_Meta();
    }
    
    public function Get_No_Categories() {
        return $this->no_categories || $this->Get_No_Meta();
    }
    
    public function Get_No_Author() {
        return $this->no_author || $this->Get_No_Meta();
    }
    
    public function Get_Use_Large_Feature_Image() {
        return $this->use_large_feature_image;
    }
    
    public function Get_Use_Sticky_Marker() {
        return $this->use_sticky_marker;
    }
    
    public function Get_No_Sidebar() {
        return $this->no_sidebar;
    }
    
    public function Disable_Meta() {
        $this->no_meta = true;
    }
    
    public function Disable_Date() {
        $this->no_date = true;
    }
    
    public function Disable_Tags() {
        $this->no_tags = true;
    }
    
    public function Disable_Categories() {
        $this->no_categories = true;
    }
    
    public function Disable_Author() {
        $this->no_author = true;
    }
    
    public function Disable_Sidebar() {
        $this->no_sidebar = true;
    }
    
    public function Enable_Sidebar() {
        $this->no_sidebar = false;
    }
    
    public function Use_Large_Feature_Image() {
         $this->use_large_feature_image = true;
    }
    
    public function Use_Sticky_Market() {
        $this->use_sticky_marker = true;
    }
}

?>