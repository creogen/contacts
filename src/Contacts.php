<?php declare(strict_types=1);

namespace Creogen\Contacts;

use Merkushin\Wpal\Service\Plugins;
use Merkushin\Wpal\ServiceFactory;

class Contacts {
	/**
	 * @var Plugins
	 */
	private $plugins_api;

	/**
	 * @var string
	 */
	private $plugin_file;

	public function __construct( string $plugin_file ) {
		$this->plugin_file = $plugin_file;
		$this->plugins_api = ServiceFactory::create_plugins();
	}

	public function init() {
		$this->plugins_api->register_activation_hook( $this->plugin_file, [ $this, 'activate_plugin' ] );
	}

	public function activate_plugin() {

	}
}

