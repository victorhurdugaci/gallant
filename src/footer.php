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
        <footer class="container-fluid">
            <div class="container" style="color:white">
                <?php get_sidebar(Sidebars::Footer); 
                
                $footerText = get_theme_mod(Theme_Options::FOOTER_TEXT);
                if (!is_null_or_empty($footerText)) { ?>
                    <div id="footer_text">
                        <?= $footerText ?>
                    </div><?php 
                }
                
                $showSupport = get_theme_mod(Theme_Options::FOOTER_SHOW_SUPPORT);
                
                if ($showSupport) { ?>
                    <div id="footer_support">
                        <p>Theme  <a href="<?= wp_get_theme()->get('ThemeURI') ?>" target="_blank">Gallant</a> by <a href="<?= wp_get_theme()->get('AuthorURI') ?>" target="_blank"><?= wp_get_theme()->get('Author') ?></a></p>
                    </div><?php
                }?>
            </div>
        </footer>
        
        <?php wp_footer(); ?>
        
        <script type="text/javascript" src="<?= esc_url(get_template_directory_uri()) ?>/js/gallant.js"></script>
        <script>
            jQuery(document).ready(function() { 
                apply_theme_styles(<?= get_theme_mod(Theme_Options::AUTO_TABLE_STYLE); ?>);
            });
        </script>
	</body>
</html>