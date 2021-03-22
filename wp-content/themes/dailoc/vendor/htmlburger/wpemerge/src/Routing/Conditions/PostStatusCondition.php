<?php

namespace WPEmerge\Routing\Conditions;

use WPEmerge\Requests\Request;

/**
 * Check against the current post's status.
 *
 * @codeCoverageIgnore
 */
class PostStatusCondition implements ConditionInterface {
	/**
	 * Post status to check against.
	 *
	 * @var string
	 */
	protected $post_status = '';

	/**
	 * Constructor
	 *
	 * @param string $post_status
	 */
	public function __construct( $post_status ) {
		$this->post_status = $post_status;
	}

	/**
	 * {@inheritDoc}
	 */
	public function isSatisfied( Request $request ) {
		$post = get_post();
		return ( is_singular() && $post && $this->post_status === $post->post_status );
	}

	/**
	 * {@inheritDoc}
	 */
	public function getArguments( Request $request ) {
		return [$this->post_status];
	}
}
