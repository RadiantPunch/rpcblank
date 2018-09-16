<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<article class="search-result">
	<h2><?php rpcblank_highlight_search_term( 'title' ); ?></h2>
	<div class="excerpt"><?php rpcblank_search_keyphrase_highlight( 'excerpt' ); ?></div>
	<?php wp_link_pages(); ?>
</article>
