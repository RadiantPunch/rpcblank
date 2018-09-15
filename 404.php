<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header(); ?>
<!-- Main Page Content -->
<section class="main-content">

	<!-- Page Header -->
	<div class="main-header">
		<h1 class="main-title"><?php _e( 'Not Found', 'rpcblank' ); ?></h1>
	</div>
	<!-- End Page Header -->

	<!-- Page Content -->
	<div class="content">
		<p><?php _e( 'Nothing found for the requested page. Select a page from the list below or try a search.', 'rpcblank' ); ?></p>
		<ul class="page-list"><?php wp_list_pages( array( 'title_li' => '' ) ) ?></ul>
		<?php get_search_form(); ?>
	</div>
	<!-- End Page Content -->

</section>
<!-- End Main Page Content -->
<?php get_footer(); ?>