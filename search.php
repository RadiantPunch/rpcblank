<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header(); ?>
<!-- Main Page Content -->
<section class="main-content">

	<!-- Page Header -->
	<div class="main-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="main-title"><?php printf( __( 'Search Results for <q>%s</q>', 'rpcblank' ), get_search_query() ); ?></h1>
		<?php else : ?>
			<h1 class="main-title"><?php printf( __( 'Nothing Found for: <q>%s</q>', 'rpcblank' ), get_search_query() ); ?></h1>
		<?php endif; ?>
	</div>
	<!-- End Page Header -->

	<!-- Page Content -->
	<div class="content">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'search', 'result' ); ?>
			<?php endwhile; ?>
			<?php get_template_part( 'nav', 'below' ); ?>
		<?php else : ?>
			<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'rpcblank' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
	<!-- End Page Content -->

</section>
<!-- End Main Page Content -->
<?php get_footer(); ?>