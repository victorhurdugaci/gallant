<form role="search" method="get" class="form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="form-group"
        <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
        <input class="form-control" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
    </div>
    <button  type="submit" class="btn btn-default"><?php echo esc_attr_x( 'Search', 'submit button' ); ?></button>
</form>