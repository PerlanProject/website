<?php

namespace Pods\Admin;

use Pods\Admin\Config\Pod;
use Pods\Admin\Config\Group;
use Pods\Admin\Config\Field;
use tad_DI52_ServiceProvider;

/**
 * Class Service_Provider
 *
 * Add Blocks integration.
 *
 * @since 2.8
 */
class Service_Provider extends tad_DI52_ServiceProvider {

	/**
	 * Registers the classes and functionality needed for Admin configs.
	 *
	 * @since 2.8
	 */
	public function register() {
		$this->container->singleton( 'pods.admin.config.pod', Pod::class );
		$this->container->singleton( 'pods.admin.config.group', Group::class );
		$this->container->singleton( 'pods.admin.config.field', Field::class );

		$this->hooks();
	}

	/**
	 * Hooks all the methods and actions the class needs.
	 *
	 * @since 2.8
	 */
	protected function hooks() {
		// Nothing here for now.
	}
}
