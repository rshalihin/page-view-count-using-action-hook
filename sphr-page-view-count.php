<?php
/**
 * Plugin Name:       Sapphire Page View Count
 * Description:       Sapphire Page View Count will help you to count and show your page or post view number.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Sapphire IT
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sapphire-page-view-count
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


add_action(
	'wp_footer',
	function () {
		$page_id = get_queried_object_id();
		if ( $page_id ) {
			$page_view = get_post_meta( $page_id, 'sphr_page_view', true );
			$page_view = ! empty( $page_view ) ? (int) $page_view + 1 : 1;
			update_post_meta( $page_id, 'sphr_page_view', $page_view );
			if ( $page_view ) {
				ob_start();
				?>
				<div style="position: fixed; bottom: 10px; right: 10px">No of views: <?php echo esc_html( $page_view ); ?></div>
				<?php
				echo wp_kses_post( ob_get_clean() );
			}
		}
	},
	99
);
