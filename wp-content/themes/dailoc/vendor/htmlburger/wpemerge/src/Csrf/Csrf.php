<?php

namespace WPEmerge\Csrf;

use WPEmerge\Requests\Request;

/**
 * Provide CSRF protection utilities through WordPress nonces.
 */
class Csrf {
	/**
	 * Convenience header to check for the token.
	 *
	 * @var string
	 */
	protected $header = 'X-CSRF-TOKEN';

	/**
	 * GET/POST parameter key to check for the token.
	 *
	 * @var string
	 */
	protected $key = '';

	/**
	 * Maximum token lifetime.
	 *
	 * @see https://codex.wordpress.org/Function_Reference/wp_verify_nonce
	 * @var integer
	 */
	protected $maximum_lifetime = 2;

	/**
	 * Last generated token.
	 *
	 * @var string
	 */
	protected $token = '';

	/**
	 * Constructor.
	 *
	 * @codeCoverageIgnore
	 * @param string  $key
	 * @param integer $maximum_lifetime
	 */
	public function __construct( $key = '__wpemergeCsrfToken', $maximum_lifetime = 2 ) {
		$this->key = $key;
		$this->maximum_lifetime = $maximum_lifetime;
	}

	/**
	 * Get the last generated token.
	 *
	 * @return string
	 */
	public function getToken() {
		if ( ! $this->token ) {
			$this->generateToken();
		}
		return $this->token;
	}

	/**
	 * Get the csrf token from a request.
	 *
	 * @param  Request $request
	 * @return string
	 */
	public function getTokenFromRequest( Request $request ) {
		if ( $request->get( $this->key ) ) {
			return $request->get( $this->key );
		}

		if ( $request->post( $this->key ) ) {
			return $request->post( $this->key );
		}

		if ( $request->headers( $this->header ) ) {
			return $request->headers( $this->header );
		}

		return '';
	}

	/**
	 * Generate a new token.
	 *
	 * @param  int|string $action
	 * @return string
	 */
	public function generateToken( $action = -1 ) {
		$action = $action === -1 ? session_id() : $action;
		$this->token = wp_create_nonce( $action );
		return $this->getToken();
	}

	/**
	 * Check if a token is valid.
	 *
	 * @param  string     $token
	 * @param  int|string $action
	 * @return boolean
	 */
	public function isValidToken( $token, $action = -1 ) {
		$action = $action === -1 ? session_id() : $action;
		$lifetime = intval( wp_verify_nonce( $token, $action ) );
		return ( $lifetime > 0 && $lifetime <= $this->maximum_lifetime );
	}

	/**
	 * Add the token to a URL.
	 *
	 * @param  string $url
	 * @return string
	 */
	public function url( $url ) {
		return add_query_arg( $this->key, $this->getToken(), $url );
	}

	/**
	 * Return the markup for a hidden input which holds the current token.
	 *
	 * @return void
	 */
	public function field() {
		echo '<input type="hidden" name="' . esc_attr( $this->key ) . '" value="' . esc_attr( $this->getToken() ) . '" />';
	}
}
