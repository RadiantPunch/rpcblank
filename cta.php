<?php 

function rpcblank_cta() {
	if ( get_field( 'cta_enable' ) === 'enable' ) {
		$prefix = '';
		$class = sanitize_html_class( get_field( $prefix . 'background' ) );
		$heading = get_field( $prefix . 'heading' );

		if ( $heading ) {
			$heading = '<h2 class="cta-heading">' . rpcblank_sanitize_acf_text_field( $heading ) . '</h2>';
		}

		$content = wp_kses_post( get_field( $prefix . 'content' ) );
		$button = rpcblank_acf_button( $prefix, '', 'button' );
		$button_2 = '';

		if ( get_field( $prefix . 'button_2_enable' ) === 'enable' ) {
			$sep_input = get_field( $prefix . 'button_sep');
			$sep = '';
			if ( $sep_input ) {
				$sep = '<span class="button-separator">' . sanitize_text_field( $sep_input ) . '</span>';
			}

			$button_2 = $sep . rpcblank_acf_button( $prefix . '2_' , '', 'button' );
		}

		$cta = '<aside class="cta ' . $class . '">' . $heading . '<div class="cta-content content">' . $content . '</div><div class="cta-button-wrap">' . $button . $button_2 . '</div></aside>';
		echo wp_kses_post( $cta );
	}
}

rpcblank_cta();