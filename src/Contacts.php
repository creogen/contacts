<?php declare(strict_types=1);

namespace Creogen\Contacts;

use Creogen\Contacts\PostType\PostTypeFactory;
use Creogen\Contacts\PostType\PostTypeInterface;
use Creogen\Contacts\Taxonomy\TaxonomyFactory;
use Creogen\Contacts\Taxonomy\TaxonomyInterface;
use Merkushin\Wpal\ServiceFactory;

class Contacts {

	/**
	 * @var TaxonomyInterface
	 */
	private $department_taxonomy;

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
		$this->department_taxonomy = TaxonomyFactory::create_department_taxonomy();
		$this->contact_post_type = PostTypeFactory::create_contact_post_type();
		$this->hooks_api = ServiceFactory::create_hooks();
	}

	public function init() {
		$this->hooks_api->add_action( 'init', [ $this, 'register_taxonomies' ] );
		$this->hooks_api->add_action( 'init', [ $this, 'register_post_types' ] );
	}

	public function register_post_types(): void {
		$this->contact_post_type->register();
	}

	public function register_taxonomies(): void {
		$this->department_taxonomy->register();
	}
}

