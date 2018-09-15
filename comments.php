<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) return; ?>
<div class="comments">
	<?php if ( have_comments() ) :
		global $comments_by_type;
		$comments_by_type = &separate_comments( $comments );
		if ( ! empty( $comments_by_type['comment'] ) ) : ?>
			<section class="comments-list">
				<h2 class="comments-title"><?php comments_number(); ?></h2>
				<?php if ( get_comment_pages_count() > 1 ) : ?>
				<nav class="comments-navigation">
					<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
				</nav>
				<?php endif; ?> 
				<ul>
					<?php wp_list_comments( 'type=comment' ); ?>
				</ul>
				<?php if ( get_comment_pages_count() > 1 ) : ?>
					<nav class="comments-navigation">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</nav>
				<?php endif; ?>		
			</section>
			<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
				<section class="comments trackbacks-list">
					<h2 class="comments-title"><?php echo '<span class="ping-count">' . $ping_count . '</span> ' . ( $ping_count > 1 ? __( 'Trackbacks', 'rpcblank' ) : __( 'Trackback', 'rpcblank' ) ); ?></h2>
					<ul>
						<?php wp_list_comments( 'type=pings&callback=rpcblank_custom_pings' ); ?>
					</ul>
				</section>
			<?php endif;	
		endif;
	endif;
	if ( comments_open() ) comment_form(); ?> 
</div>