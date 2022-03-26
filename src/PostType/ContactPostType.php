<?php declare(strict_types=1);

namespace Creogen\Contacts\PostType;

use Merkushin\Wpal\PostTypes;
use Merkushin\Wpal\Hooks;

class ContactPostType implements PostTypeInterface {
	/**
	 * @var Hooks
	 */
	private $hooks_api;

	/**
	 * @var PostTypes
	 */
	private $post_types_api;

	public function __construct( Hooks $hooks_api, PostTypes $post_types_api ) {
		$this->hooks_api = $hooks_api;
		$this->post_types_api;
	}

	public function register() {
		$this->hooks_api->add_action( 'init', [ $this, 'register_post_type' ] );
	}

	public function register_post_type() {
		$args = [];
		$this->post_types_api->register_post_type( 'creogen_contacts', $args );
	}
}

