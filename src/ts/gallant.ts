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

/// <reference path="../../ext/definitelytyped/jquery/jquery.d.ts" />

function apply_theme_styles(auto_table_style: boolean) {
    function apply_bootstrap_to_tables() {
        jQuery(".post-body > table").each(function(index, element) {
            var table = jQuery(element);
            if (!table.is('[data-noautostyle]')) {
                table.addClass("table");
            }
        });
    }   
    
    if (auto_table_style) {
        apply_bootstrap_to_tables();
    }
}