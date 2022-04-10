<?php declare(strict_types=1);

namespace Creogen\Contacts\Taxonomy;

use Merkushin\Wpal\Service\Hooks;
use Merkushin\Wpal\ServiceFactory;

class DepartmentTaxonomy implements TaxonomyInterface {
	/**
	 * @var Hooks
	 */
	private $hooks_api;

	public function __construct() {
		$this->hooks_api = ServiceFactory::create_hooks();
	}

	public function register() {
		$this->hooks_api->add_action( 'init', [ $this, 'register_taxonomy' ] );
	}

	public function register_taxonomy() {

	}
}

