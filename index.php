<?php get_header(); ?>
<!-- Main Blog Content -->
<section class="main-content">

	<!-- Blog Header -->
	<?php if ( is_home() && !is_front_page() ) : ?>
		<header class="main-header">
			<h1 class="main-title"><?php single_post_title(); ?></h1>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="banner-image">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>
		</header>
	<?php endif; ?>
	<!-- End Blog Header -->

	<!-- Blog Content -->
	<?php get_template_part( 'loop' ); ?>
	<!-- End Blog Content -->

</section>
<!-- End Main Blog Content -->
<?php get_sidebar(); ?>
<?php get_template_part( 'cta' ); ?>
<?php get_footer(); ?>