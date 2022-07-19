<?php declare(strict_types=1);

namespace Creogen\Contacts;

use Creogen\Contacts\PostType\PostTypeFactory;
use Creogen\Contacts\PostType\PostTypeInterface;
use Merkushin\Wpal\ServiceFactory;

class Contacts {

	/**
	 * @var PostTypeInterface
	 */
	private $contact_post_type;

	/**
	 * @var Hooks
	 */
	private $hooks_api;

	/**
	 * @var string
	 */
	private $plugin_file;

	public function __construct( string $plugin_file ) {
		$this->plugin_file = $plugin_file;
		$this->contact_post_type = PostTypeFactory::get_contact_post_type();
		$this->hooks_api = ServiceFactory::create_hooks();
	}

	public function init() {
		$this->hooks_api->add_action( 'init', [ $this, 'register_post_types' ] );
	}

	public function register_post_types(): void {
		$this->contact_post_type->register();
	}
}

