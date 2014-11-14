<?php if (is_active_sidebar(Sidebars::BelowContent)) { ?>
    <div id="sidebar-belowcontent" class="sidebar">
    	<?php 
            if (!dynamic_sidebar(Sidebars::BelowContent)) {
            }
    	?>
    </div>
<?php } ?>