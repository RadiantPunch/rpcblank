<?php get_header(); ?>
<!-- Main Post Content -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'main-content' ); ?>>

	<!-- Post Header -->
	<header class="main-header">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="banner-image">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<h1 class="main-title entry-title"><?php the_title(); ?></h1>
		<?php get_template_part( 'template-parts/post/post', 'meta' ); ?>
	<?php endwhile; endif; ?>	
	</header>
	<!-- End Post Header -->

	<!-- Post Content -->
	<div class="entry-content">
	<?php rewind_posts(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
		<?php get_template_part( 'template-parts/post/post', 'footer' ); ?>
	<?php endwhile; endif; ?>	
	</div>
	<!-- End Post Content -->

	<!-- Post Comments -->
	<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
	<!-- End Post Comments -->

	<?php get_template_part( 'single', 'nav' ); ?>

</article>
<!-- End Main Post Content -->
<?php get_sidebar(); ?>
<?php get_template_part( 'cta' ); ?>
<?php get_footer(); ?>