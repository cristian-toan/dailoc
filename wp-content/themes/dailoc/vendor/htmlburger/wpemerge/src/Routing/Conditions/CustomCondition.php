<?php

namespace WPEmerge\Routing\Conditions;

use WPEmerge\Requests\Request;

/**
 * Check against a custom callable
 */
class CustomCondition implements ConditionInterface {
	/**
	 * Callable to use
	 *
	 * @var callable
	 */
	protected $callable = null;

	/**
	 * Arguments to pass to the callable and controller
	 *
	 * @var array
	 */
	protected $arguments = [];

	/**
	 * Constructor
	 *
	 * @param callable $callable
	 * @param mixed    $arguments,...
	 */
	public function __construct( $callable ) {
		$this->callable = $callable;
		$this->arguments = array_values( array_slice( func_get_args(), 1 ) );
	}

	/**
	 * {@inheritDoc}
	 */
	public function isSatisfied( Request $request ) {
		return call_user_func_array( $this->callable, $this->arguments );
	}

	/**
	 * {@inheritDoc}
	 */
	public function getArguments( Request $request ) {
		return $this->arguments;
	}

	/**
	 * Get the assigned callable
	 *
	 * @return callable
	 */
	public function getCallable() {
		return $this->callable;
	}
}
