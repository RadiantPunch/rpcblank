<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="entry-meta">
	<span class="author vcard"><?php the_author_posts_link(); ?></span>
	<span class="meta-sep"> &bull; </span>
	<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
</div>