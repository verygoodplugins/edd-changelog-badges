<?php
/**
 * Plugin Name: EDD Changelog
 * Plugin URI: https://wpfusion.com/
 * Description: Beautiful changelog display for Easy Digital Downloads products
 * Version: 1.2.3
 * Author: Very Good Plugins
 * Author URI: https://verygoodplugins.com/
 * Text Domain: edd-changelog
 *
 * @package EDD_Changelog
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register shortcode
 *
 * @param array $atts The shortcode attributes.
 * @return string The changelog HTML.
 */
function edd_changelog_shortcode( $atts ) {

	$defaults = array(
		'id' => get_the_id(),
	);

	$atts = shortcode_atts( $defaults, $atts );

	$changelog = get_post_meta( $atts['id'], '_edd_sl_changelog', true );

	if ( empty( $changelog ) ) {
		return '';
	}

	// Sanitize the HTML from the change log field.
	$changelog = balanceTags( wp_kses_post( $changelog ), true );
	$changelog = stripslashes( $changelog );

	// Make sure we're using h4s.
	$changelog = str_replace( 'h3', 'h4', $changelog );

	// Define default badge configurations
	$badge_configs = apply_filters(
		'edd_changelog_badge_configs',
		array(
			'added'     => array(
				'prefix'     => 'Added',
				'badge_text' => 'New',
				'emoji'      => '✨',
				'class'      => 'new',
				'ltrim'      => 'Added',
			),
			'improved'  => array(
				'prefix'     => 'Improved',
				'badge_text' => 'Improved',
				'emoji'      => '⚡️',
				'class'      => 'improved',
				'ltrim'      => 'Improved',
			),
			'fix'       => array(
				'prefix'     => 'Fix',
				'badge_text' => 'Fixed',
				'emoji'      => '🔧',
				'class'      => 'fixed',
				'ltrim'      => 'Fix',
			),
			'developer' => array(
				'prefix'     => 'Developer',
				'badge_text' => 'Dev',
				'emoji'      => '🛠️',
				'class'      => 'dev',
				'ltrim'      => 'Developer',
			),
		)
	);

	// Add badges to list items
	$changelog = preg_replace_callback(
		'/<li>(.*?)<\/li>/s',
		function ( $matches ) use ( $badge_configs ) {
			$content = $matches[1];
			$badge   = '';

			foreach ( $badge_configs as $config ) {
				if ( preg_match( '/^' . $config['prefix'] . '/i', $content ) ) {
					if ( $config['ltrim'] ) {
						$content = str_replace( $config['ltrim'], '', $content );
					}
					$badge = sprintf(
						'<span class="changelog-badge %s">%s %s</span> ',
						$config['class'],
						$config['emoji'],
						$config['badge_text']
					);
					break;
				}
			}

			return "<li>{$badge}{$content}</li>";
		},
		$changelog
	);

	$changelog = edd_changelog_add_ids_to_headings( $changelog );

	$html = '<style type="text/css">

		.edd_changelog-content ul {
			margin-left: 0;
		}

		.edd_changelog-content ul li {
			list-style-type: none;
			position: relative;
			padding-left: 86px;
		}

		.changelog-badge {
			display: inline-block;
			padding: 1px 6px;
			border-radius: 8px;
			font-size: 12px;
			font-weight: 600;
			margin-right: 8px;
			line-height: 2;
			width: 86px;
			text-align: center;
			position: absolute;
			left: -10px;
			top: 5px;
			word-spacing: 2px;
		}

		.changelog-badge.new {
			background-color: #22aa45;
			color: white;
		}

		.changelog-badge.improved {
			background-color: #2271b1;
			color: white;
		}

		.changelog-badge.fixed {
			background-color: #E55B10;
			color: white;
		}

		.changelog-badge.dev {
			background-color: #3c434a;
			color: white;
		}
	</style>';

	$html .= sprintf(
		'<div id="edd_changelog_content-%1$d" class="edd_changelog-content">%2$s</div>',
		$atts['id'],
		$changelog
	);

	return $html;
}

add_shortcode( 'edd_changelog', 'edd_changelog_shortcode' );

/**
 * Add IDs to headings for anchor links.
 *
 * @param string $content The content to add IDs to.
 * @return string The content with IDs added to headings.
 */
function edd_changelog_add_ids_to_headings( $content ) {

	$depth = 4;

	$pattern  = '/<h[2-' . $depth . ']*[^>]*>.*?<\/h[2-' . $depth . ']>/';
	$whocares = preg_match_all( $pattern, $content, $winners );

	foreach ( $winners[0] as $i => $winner ) {

		// If it's a changelog we'll take the date off the slug.

		$slug = preg_replace( '/\s-\s\d+\/\d+\/\d+/', '', $winner );

		$slug = sanitize_title( $slug );

		if ( false !== strpos( $winner, 'class="' ) ) {

			// Has a class.
			$winners[0][ $i ] = str_replace( '">', ' anchoring" id="' . $slug . '"><a class="anchor" href="#' . $slug . '">#</a>', $winners[0][ $i ] );
		} else {

			// Straight up <h3> or <h4> tag.

			$winners[0][ $i ] = str_replace( '<h3>', '<h3 class="anchoring" id="' . $slug . '"><a class="anchor" href="#' . $slug . '">#</a>', $winners[0][ $i ] );
			$winners[0][ $i ] = str_replace( '<h4>', '<h4 class="anchoring" id="' . $slug . '"><a class="anchor" href="#' . $slug . '">#</a>', $winners[0][ $i ] );
		}

		$content = str_replace( $winner, $winners[0][ $i ], $content );
	}

	return $content;
}
