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

require_once('class.post-header-options.php');
require_once('class.post-footer-options.php');

class Post_Options {
    private $static_content = NULL;
    private $use_excerpt = false;
    
    private $no_header = false;
    private $no_footer = false;
    
    private $header_options;
    private $footer_options;
    
    function __construct() {
        $this->header_options = new Post_Header_Options();
        $this->footer_options = new Post_Footer_Options();
    }
    
    public function Get_Header_Options() {
        return $this->header_options;
    }
    
    public function Get_Footer_Options() {
        return $this->footer_options;
    }
    
    public function Get_Is_Static() {
        return !is_null_or_empty($this->static_content) ||
               $this->header_options->Get_Is_Static();
    }
    
    public function Get_Static_Content() {
        return $this->static_content;
    }
    
    public function Set_Static_Content($value) {
        $this->static_content = $value;
    }
    
    public function Get_No_Header() {
        return $this->no_header;
    }
    
    public function Get_No_Footer() {
        return $this->no_footer ||
               $this->use_excerpt;
    }
    
    public function Get_Use_Excerpt() {
        return $this->use_excerpt;
    }
   
    public function Disable_Header() {
        $this->no_header = true;
    }
    
    public function Disable_Footer() {
        $this->no_footer = true;
    }
    
    public function Use_Excerpt() {
        $this->use_excerpt = true;
    }
}

?>