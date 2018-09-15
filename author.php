<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header(); ?>
<!-- Main Blog Content -->
<section class="main-content">

	<!-- Blog Header -->
	<header class="main-header">
		<?php the_post(); ?>
		<h1 class="main-title author">
			<span class="title-intro"><?php _e( 'Articles Written by ', 'rpcblank' ); ?></span>
			<?php the_author_link(); ?>
		</h1>
		<?php rewind_posts(); ?>
		<?php if ( '' != get_the_author_meta( 'user_description' ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . get_the_author_meta( 'user_description' ) . '</div>' ); ?>
	</header>
	<!-- End Blog Header -->

	<!-- Blog Content -->
	<?php get_template_part( 'loop' ); ?>
	<!-- End Blog Content -->

</section>
<!-- End Main Blog Content -->
<?php get_sidebar(); ?>
<?php get_template_part( 'cta' ); ?>
<?php get_footer(); ?>