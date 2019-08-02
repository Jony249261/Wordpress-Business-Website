<?php
namespace Elementor\Core\Debug\Classes;

class Htaccess extends Inspection_Base {

	private $message = '';

	public function __construct() {
		$this->message = __( 'Your site\'s .htaccess file appears to be missing.', 'elementor' );
	}

	public function run() {
		$permalink_structure = get_option( 'permalink_structure' );
		if ( empty( $permalink_structure ) || empty( $_SERVER['SERVER_SOFTWARE'] ) ) {
			return true;
		}

		$server = strtoupper( $_SERVER['SERVER_SOFTWARE'] );

		if ( strstr( $server, 'APACHE' ) ) {
			$htaccess_file = get_home_path() . '.htaccess';
			$this->message .= sprintf( __( ' File path: %s ', 'elementor' ), $htaccess_file );
			return file_exists( $htaccess_file );
		}
		return true;
	}

	public function get_name() {
		return 'apache-htaccess';
	}

	public function get_message() {
		return $this->message;
	}

	public function get_help_doc_url() {
		return 'https://go.elementor.com/preview-not-loaded/#htaccess';
	}
}
