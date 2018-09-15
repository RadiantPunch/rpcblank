<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
<nav class="listing-nav">
	<div class="nav-previous"><?php next_posts_link(sprintf( __( '%s older', 'rpcblank' ), '<span class="meta-nav">&larr;</span>' ) ) ?></div>
	<div class="nav-next"><?php previous_posts_link(sprintf( __( 'newer %s', 'rpcblank' ), '<span class="meta-nav">&rarr;</span>' ) ) ?></div>
</nav>
<?php } ?>