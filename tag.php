<?php get_header(); ?>
<!-- Main Blog Content -->
<section class="main-content">

	<!-- Blog Header -->
	<header class="main-header">
		<h1 class="main-title">
			<span class="title-intro"><?php _e( 'Articles Tagged as ', 'rpcblank' ); ?></span>
			<?php single_tag_title(); ?>
		</h1>
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