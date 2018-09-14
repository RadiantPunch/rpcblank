<footer class="entry-footer">
	<span class="cat-links"><?php _e( 'Categories: ', 'rpcblank' ); ?><?php the_category( ', ' ); ?></span>
	<?php if ( has_tag() ) : ?><span class="tag-links"><?php _e( 'Tags: ', 'rpcblank' ); ?><?php the_tags(); ?></span><?php endif; ?>
	<?php if ( comments_open() ) { ?>
		<span class="meta-sep">&bull;</span> <span class="comments-link"><a href="<?php comments_link(); ?>"><?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?></a></span><?php
	} ?>
</footer> 