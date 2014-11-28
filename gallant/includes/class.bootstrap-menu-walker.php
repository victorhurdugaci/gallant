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

class Bootstrap_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='dropdown-menu' role='menu'>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent</ul>\n";
    }
    
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        if ($this->has_children) {
            $output .=  "\n$indent<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>" . $item->title . "<span class='caret'></span></a>";
        }
        else {
            $output .= sprintf("\n$indent<li><a href='%s'%s>%s</a>",
                esc_url($item->url),
                ( $item->object_id === get_the_ID() ) ? ' class="active"' : '',
                $item->title);
        }
    }
    
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>";
    }
}

?>