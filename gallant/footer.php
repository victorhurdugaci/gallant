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
                </div> <!-- div class="col-sm-8"> -->
                <div class="col-sm-3">
                    <?php get_sidebar(Sidebars::Right); ?>
                </div>
            </div> <!--  <div class="row"> -->
        </div>	<!-- <div class="container"> -->
        
        <footer class="container-fluid">
            <div class="container" style="color:white">
                <?php get_sidebar(Sidebars::Footer); ?>
                
                <div id="footer_text">
                    <?php echo get_theme_mod(Theme_Options::FOOTER_TEXT); ?>
                </div>
                
                <div id="footer_support" class="<?php echo get_theme_mod(Theme_Options::FOOTER_SHOW_SUPPORT)?'':'no-support' ?>">
                    <p>Theme  <a href="<?php echo wp_get_theme()->get('ThemeURI') ?>" target="_blank">Gallant</a> by <?php echo wp_get_theme()->get('Author') ?></p>
                </div>
            </div>
        </footer>
        
        <?php wp_footer(); ?>
        
        <script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()) ?>/js/theme.js"></script>
        <script>
            $(document).ready(function() { 
                apply_theme_styles(<?php echo get_theme_mod(Theme_Options::AUTO_TABLE_STYLE); ?>);
            });
        </script>
	</body>
</html>