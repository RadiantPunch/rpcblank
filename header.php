<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'after_body_open_tag' ); ?>
	<!-- Site Header -->
	<header class="site-header">

		<a class="branding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php rpcblank_site_branding(); ?>
		</a>

		<!-- Main Nav -->
		<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
		<nav class="site-nav">
			<nav class="main-menu-wrapper">
				<button class="menu-toggle" aria-label="Main Menu" aria-expanded="false">
					<img class="open-menu" src="<?php echo get_template_directory_uri(); ?>/assets/images/open-menu.png" alt="Open the Menu" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/open-menu.svg" />
					<img class="close-menu" src="<?php echo get_template_directory_uri(); ?>/assets/images/close-menu.png" alt="Close the Menu" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/close-menu.svg" />
				</button>
				<?php rpcblank_main_menu(); ?>
			</nav>
		</nav>
		<?php endif; ?>
	<!-- End Main Nav -->

	</header>
	<!-- End Site Header -->

	<!-- Site Main -->
	<main class="site-main">