<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-listing' ); ?>>
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
	<h2 class="listing-title entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php get_template_part( 'template-parts/post/post', 'meta' ); ?>
	<div class="post-summary">
		<?php if ( rpcblank_full_content_post_format() ) {
			the_content();
		} else {
			the_excerpt();
		} ?>
	</div>
	<?php get_template_part( 'template-parts/post/post', 'footer' ); ?>
</article>