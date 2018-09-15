<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="content blog-content">
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'template-parts/post/post', 'listing' ); ?>
<?php comments_template(); ?>
<?php endwhile; ?>
<?php get_template_part( 'listing', 'nav' ); ?>
</div>