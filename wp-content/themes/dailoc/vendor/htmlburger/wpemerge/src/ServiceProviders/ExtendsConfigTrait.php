<?php

namespace WPEmerge\ServiceProviders;

/**
 * Allows objects to extend the config.
 */
trait ExtendsConfigTrait {
	/**
	 * Extends the WP Emerge config in the container with a new key.
	 *
	 * @param  \Pimple\Container $container
	 * @param  string            $key
	 * @param  mixed             $default
	 * @return void
	 */
	protected function extendConfig( $container, $key, $default ) {
		$config = isset( $container[ WPEMERGE_CONFIG_KEY ][ $key ] ) ? $container[ WPEMERGE_CONFIG_KEY ][ $key ] : $default;

		if ( is_array( $default ) && is_array( $config ) ) {
			$config = array_replace_recursive( $default, $config );
		}

		$container[ WPEMERGE_CONFIG_KEY ] = array_merge(
			$container[ WPEMERGE_CONFIG_KEY ],
			[ $key => $config ]
		);
	}
}
