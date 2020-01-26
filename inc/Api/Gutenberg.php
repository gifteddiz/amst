<?php
/**
 * Build Gutenberg Blocks
 *
 * @package amst
 */

namespace amst\Api;

/**
 * Customizer class
 */
class Gutenberg
{
	/**
	 * Register default hooks and actions for WordPress
	 *
	 * @return WordPress add_action()
	 */
	public function register() 
	{
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		add_action( 'init', array( $this, 'gutenberg_init' ) );

		add_action( 'init', array( $this, 'gutenberg_enqueue' ) );

		add_action( 'enqueue_block_assets', array( $this, 'gutenberg_assets' ) );
	}

	/**
	 * Custom Gutenberg settings
	 * @return
	 */
	public function gutenberg_init()
	{
		add_theme_support( 'gutenberg', array(
			// Theme supports responsive video embeds
			'responsive-embeds' => true,
            // Theme supports wide images, galleries and videos.
            'wide-images' => true,
		) );
		
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'White', 'amst' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Black', 'amst' ),
				'slug'  => 'black',
				'color' => '#333333',
			),
			array(
				'name'  => __( 'Gold', 'amst' ),
				'slug'  => 'gold',
				'color' => '#FCBB6D',
			),
			array(
				'name'  => __( 'Pink', 'amst' ),
				'slug'  => 'pink',
				'color' => '#FF4444',
			),
			array(
				'name'  => __( 'Grey', 'amst' ),
				'slug'  => 'grey',
				'color' => '#b8c2cc',
			),
		) );
	}

	/**
	 * Enqueue scripts and styles of your Gutenberg blocks
	 * @return
	 */
	public function gutenberg_enqueue()
	{
		wp_register_script( 'gutenberg-amst', get_template_directory_uri() . '/assets/dist/js/gutenberg.js', array( 'wp-blocks', 'wp-element', 'wp-editor' ) );

		register_block_type( 'gutenberg-amst/amst-cta', array(
			'editor_script' => 'gutenberg-amst', // Load script in the editor
		) );
	}

	/**
	 * Enqueue scripts and styles of your Gutenberg blocks in the editor
	 * @return
	 */
	public function gutenberg_assets()
	{
		wp_enqueue_style( 'gutenberg-amst-cta', get_template_directory_uri() . '/assets/dist/css/gutenberg.css', null );
	}
}