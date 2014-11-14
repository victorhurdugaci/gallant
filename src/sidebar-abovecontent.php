<?php if (is_active_sidebar(Sidebars::AboveContent)) { ?>
    <div id="sidebar-abovecontent" class="sidebar">
    	<?php 
            if (!dynamic_sidebar(Sidebars::AboveContent)) {
            }
    	?>
    </div>
<?php } ?>