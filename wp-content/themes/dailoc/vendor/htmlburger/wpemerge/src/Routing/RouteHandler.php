<?php

namespace WPEmerge\Routing;

use WPEmerge\Facades\Response;
use WPEmerge\Helpers\Handler;
use WPEmerge\Responses\ConvertibleToResponseInterface;

/**
 * Represent a Closure or a controller method to be executed in response to a request
 */
class RouteHandler {
	/**
	 * Actual handler
	 *
	 * @var Handler
	 */
	protected $handler = null;

	/**
	 * Constructor
	 *
	 * @param string|\Closure $handler
	 */
	public function __construct( $handler ) {
		$this->handler = new Handler( $handler );
	}

	/**
	 * Get the handler
	 *
	 * @return Handler
	 */
	public function get() {
		return $this->handler;
	}

	/**
	 * Execute the handler
	 *
	 * @param  mixed $arguments,...
	 * @return mixed
	 */
	public function execute() {
		$arguments = func_get_args();
		$response = call_user_func_array( [$this->handler, 'execute'], $arguments );

		if ( is_string( $response ) ) {
			return Response::output( $response );
		}

		if ( is_array( $response ) ) {
			return Response::json( $response );
		}

		if ( $response instanceof ConvertibleToResponseInterface ) {
			return $response->toResponse();
		}

		return $response;
	}
}
