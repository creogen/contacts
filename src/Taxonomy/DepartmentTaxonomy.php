<?php declare(strict_types=1);

namespace Creogen\Contacts\Taxonomy;

use Creogen\Contacts\PostType\ContactPostType;
use Merkushin\Wpal\Service\Hooks;
use Merkushin\Wpal\Service\Taxonomies;
use Merkushin\Wpal\ServiceFactory;

class DepartmentTaxonomy implements TaxonomyInterface {
	/**
	 * @var Hooks
	 */
	private $hooks_api;

	/**
	 * @var Taxonomies
	 */
	private $taxonomies;

	public function __construct() {
		$this->hooks_api = ServiceFactory::create_hooks();
		$this->taxonomies = ServiceFactory::create_taxonomies();
	}

	public function register() {
		$this->hooks_api->add_action( 'init', [ $this, 'register_taxonomy' ] );
	}

	public function register_taxonomy() {
		$this->taxonomies->register_taxonomy(
			'taxonomy_department',
			ContactPostType::get_post_type_name(),
			[
				'labels' => [
					'name' => 'Departments',
					'singular_name' => 'Department',
					'search_items' => 'Search Departments',
					'all_items' => 'All Departments',
					'edit_item' => 'Edit Department',
					'update_item' => 'Update Department',
					'add_new_item' => 'Add New Department',
					'new_item_name' => 'New Department Name',
					'menu_name' => 'Departments',
				],
				'public' => true,
				'hierarchical' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => false,
				'show_tagcloud' => true,
				'show_in_quick_edit' => true,
				'meta_box_cb' => null,
				'show_admin_column' => true,
				'update_count_cb' => null,
				'query_var' => 'taxonomy_department',
				'rewrite' => [
					'slug' => 'taxonomy_department',
					'with_front' => true,
					'hierarchical' => true,
					'ep_mask' => 'EP_MASK',
				],
				'capabilities' => [
					'manage_terms' => 'manage_categories',
					'edit_terms' => 'manage_categories',
					'delete_terms' => 'manage_categories',
					'assign_terms' => 'edit_posts',
				],
				'sort' => true,
			]
		);
	}
}

