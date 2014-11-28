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
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainmenu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" 
                href="<?php echo home_url(); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </div>

        <div class="collapse navbar-collapse navbar-right" id="mainmenu">
            <?php wp_nav_menu(array(
                'menu' => 'mainmenu',
                'menu_class' => 'nav navbar-nav',
                'container' => false,
                'walker' => new Bootstrap_Menu_Walker() )); ?>  
            <form class="navbar-form navbar-left" role="search" method="get" action="<?php echo esc_url(home_url()); ?>/">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Looking for something?" name="s" value="<?php the_search_query() ?>" />
                </div>
            </form>
        </div>
    </div>
</nav>