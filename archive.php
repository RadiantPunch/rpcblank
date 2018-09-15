<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header(); ?>
<!-- Main Blog Content -->
<section class="main-content">

	<!-- Blog Header -->
	<header class="main-header">
		<h1 class="main-title">
			<?php if ( is_day() ) { printf( __( 'Articles Published on %s', 'rpcblank' ), get_the_time( get_option( 'date_format' ) ) ); }
			elseif ( is_month() ) { printf( __( 'Articles Published in %s', 'rpcblank' ), get_the_time( 'F Y' ) ); }
			elseif ( is_year() ) { printf( __( 'Articles Published in %s', 'rpcblank' ), get_the_time( 'Y' ) ); }
			else { _e( 'Archives', 'rpcblank' ); } ?>
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