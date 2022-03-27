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
		$this->post_types_api = $post_types_api;
	}

	public function register() {
		$this->hooks_api->add_action( 'init', [ $this, 'register_post_type' ] );
	}

	public function register_post_type() {
		$args = [
			'labels' => [
				'name' => 'Contacts Directory',
				'singular_name' => 'Contact',
				'add_new' => 'Add Contact',
				'add_new_item' => 'Add Contact',
				'edit' => 'Edit', 
				'edit_item' => 'Edit Contact',
				'view_item' => 'View Contact',
				'search_items' => 'Search Contacts',
				'not_found' => 'Contact Not Found',
				'not_found_in_trash' => 'Contact Not Found in Trash',
			],
			'description' => 'Contacts directory on the website',
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 20,
			'menu_icon' => 'dashicons-clipboard',
			'can_export' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'supports' => [
				'title', 
				'thumbnail', 
				'excerpt',
			],
			'taxonomies' => [],
			'has_archive' => true,
			'permalink_epmask' => 'EP_PERMALINK',
			'rewrite' => [
				'slug' => 'contacts',
				'with_front' => true,
				'feeds' => true,
				'pages' => true,
				'ep_mask' => 'EP_PERMALINK'
			],
			'query_var' => true,
			'can_export' => true,
			'show_in_rest' => true,
		];
		$this->post_types_api->register_post_type( 'creogen_contact', $args );
	}
}

