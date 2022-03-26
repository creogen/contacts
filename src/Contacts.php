<?php declare(strict_types=1);

namespace Creogen\Contacts;

use Merkushin\Wpal\Plugins;

class Contacts {
	/**
	 * @var Plugins
	 */
	private $plugins_api;

	/**
	 * @var string
	 */
	private $plugin_file;

	public function __construct( Plugins $plugins_api, string $plugin_file ) {
		$this->plugins_api = $plugins_api;
		$this->plugin_file = $plugin_file;
	}

	public function init() {
		$this->plugins_api->register_activation_hook( $this->plugin_file, [ $this, 'activate_plugin' ] );
	}

	public function activate_plugin() {

	}
}

