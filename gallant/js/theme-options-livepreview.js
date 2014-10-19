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

(function($){
    /* Style */
    wp.customize('auto_table_style', function(value) {
        value.bind(function(newval) {
            $(".post-body > table").each(function(index, element) {
                var table = $(element);
                if (!table.is('[data-noautostyle]')) {
                    if (newval) {
                        table.addClass('table');
                    }
                    else {
                        table.removeClass('table');
                    }
                }
            });
        });
    });

    /* Footer */
    wp.customize('footer_columns', function(value) {
		value.bind(function(newval) {
            $('#sidebar-footer>div')
                .removeClass()
                .addClass('col-sm-' + (12/newval));
		});
	});
    
	wp.customize('footer_text', function(value) {
		value.bind(function(newval) {
			$('#footer_text').html(newval);
		});
	});
    
    wp.customize('footer_show_support', function(value) {
		value.bind(function(newval) {
			$('#footer_support').toggle(newval);
		});
	});
})(jQuery);