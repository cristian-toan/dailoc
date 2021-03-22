<?php

namespace WPEmerge\Facades;

use WPEmerge\Support\Facade;

/**
 * Provide access to the CSRF service.
 *
 * @codeCoverageIgnore
 */
class Csrf extends Facade {
	protected static function getFacadeAccessor() {
		return WPEMERGE_CSRF_KEY;
	}
}
