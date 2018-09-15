<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<aside class="blog-sidebar">
	<?php if ( is_active_sidebar( 'blog-sidebar-widgets' ) ) : ?>
	<?php dynamic_sidebar( 'blog-sidebar-widgets' ); ?>
	<?php endif; ?>
</aside>