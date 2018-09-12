<?php get_header(); ?>
<!-- Main Page Content -->
<section class="main-content">

	<!-- Page Header -->
	<header class="main-header">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="banner-image">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<h1 class="main-title"><?php the_title(); ?></h1>
	<?php endwhile; endif; ?>	
	</header>
	<!-- End Page Header -->

	<!-- Page Content -->
	<div class="content">
	<?php rewind_posts(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	<?php endwhile; endif; ?>	
	</div>
	<!-- End Page Content -->

</section>
<!-- End Main Page Content -->
<?php get_template_part( 'cta' ); ?>
<?php get_footer(); ?>