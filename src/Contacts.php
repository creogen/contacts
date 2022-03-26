<?php declare(strict_types=1);

namespace Creogen\Contacts;

use Merkushin\Wpal\Plugins;

class Contacts {
	/**
	 * @var Plugins
	 */
	private $pluginsApi;

	/**
	 * @var string
	 */
	private $pluginFile;

	public function __construct( Plugins $pluginsApi, string $pluginFile ) {
		$this->pluginsApi = $pluginsApi;
		$this->pluginFile = $pluginFile;
	}

	public function init() {
		$this->pluginsApi->register_activation_hook( $this->pluginFile, [ $this, 'activate_plugin' ] );
	}

	public function activate_plugin() {

	}
}

