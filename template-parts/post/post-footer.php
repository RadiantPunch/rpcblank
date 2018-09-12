<footer class="entry-footer">
	<span class="cat-links"><?php _e( 'Categories: ', 'rpcblank' ); ?><?php the_category( ', ' ); ?></span>
	<?php if ( has_tag() ) : ?><span class="tag-links"><?php _e( 'Tags: ', 'rpcblank' ); ?><?php the_tags(); ?></span><?php endif; ?>
	<?php if ( comments_open() ) { 
		echo '<span class="meta-sep">&bull;</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf( __( 'Comments', 'rpcblank' ) ) . '</a></span>';
	} ?>
</footer> 