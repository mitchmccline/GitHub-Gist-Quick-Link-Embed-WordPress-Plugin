<?php
/***************************************************************

	Regrister GitHub Gist Embed Handler

***************************************************************/

class  GitHub_Gist_Quick_Link_Embed {
	/**
	 * Instance of this class.
	 *
	 * @since    1.0.1
	 *
	 * @var      object
	 */
 	private static $instance = false;

 	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.1
	 *
	 * @return    object - A single instance of this class.
	 */
 	public static function get_instance() {
 	  if ( ! self::$instance ) {
 	    self::$instance = new self();
 	  }
 	  return self::$instance;
 	}

 	/**
	 * Register emebed handler
	 *
	 * @since 1.0.1
	 */
 	private function __construct() {
 		wp_embed_register_handler( 'gist', '/https?:\/\/gist\.github\.com\/([a-z0-9]+)\/([a-z0-9]+)/i', array( $this, 'wp_embed_handler_gist'));
 	}

 	/**
	 * Embed handler method
	 *
	 * @since 1.0.1
	 */
  	public function wp_embed_handler_gist( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
				'<script src="https://gist.github.com/%1$s/%2$s.js"></script>',
				esc_attr($matches[1]),
				esc_attr($matches[2])
				);

		return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );
	}
}

?>