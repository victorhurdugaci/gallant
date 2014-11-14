<?php

class Render_Helper {
    public static function Render_If_Not_Empty($args) {
        $defaults = array(
            'before' => '',
            'after'  => '',
            'func'   => function() {}
        );
        
        $args = wp_parse_args($args, $defaults);

        ob_start();
        $args['func']();
        $buffer_content = ob_get_clean();
        
        if (!is_null_or_empty($buffer_content)) {
            echo $args['before'] . $buffer_content . $args['after'];
        }
    }
    
    public static function Create_Class_String($classes_array) {
        return join(' ', $classes_array);
    }
}
?>