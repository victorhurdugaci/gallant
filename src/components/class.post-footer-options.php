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

class Post_Footer_Options {
	private $no_navigation = false;
    private $no_comments = false;
    
    private $no_sidebar = false;
    
    function __construct() {
        if (get_theme_mod(Theme_Options::DISABLE_COMMENTS)) {
            $this->no_comments = true;
        }
    }
    
     public function Get_No_Navigation() {
        return $this->no_navigation;
    }
    
    public function Get_No_Comments() {
        return $this->no_comments;
    }
    
    public function Get_No_Sidebar() {
        return $this->no_sidebar;
    }
    
    public function Disable_Navigation() {
        $this->no_navigation = true;
    }
    
    public function Disable_Comments() {
        $this->no_comments = true;
    }
    
    public function Disable_Sidebar() {
        $this->no_sidebar = true;
    }
}

?>