<?php declare(strict_types=1);

namespace Creogen\Contacts\PostType;

use Merkushin\Wpal\Hooks;
use Merkushin\Wpal\Localization;
use Merkushin\Wpal\PostTypes;

class ContactPostType implements PostTypeInterface {
	/**
	 * @var Hooks
	 */
	private $hooks_api;

	/**
	 * @var PostTypes
	 */
	private $post_types_api;

	/**
	 * @var Localization
	 */
	private $l10n;

	public function __construct( Hooks $hooks_api, PostTypes $post_types_api, Localization $l10n_api ) {
		$this->hooks_api = $hooks_api;
		$this->post_types_api = $post_types_api;
		$this->l10n = $l10n_api;
	}

	public function register() {
		$this->hooks_api->add_action( 'init', [ $this, 'register_post_type' ] );
	}

	public function register_post_type() {
		$args = [
			'labels' => [
				'name' => $this->l10n->__( 'Contacts Directory', 'creogen-contacts' ),
				'singular_name' => $this->l10n->__( 'Contact', 'creogen-contacts' ),
				'add_new' => $this->l10n->__( 'Add Contact', 'creogen-contacts' ),
				'add_new_item' => $this->l10n->__( 'Add Contact', 'creogen-contacts' ),
				'edit' => $this->l10n->__( 'Edit', 'creogen-contacts' ),
				'edit_item' => $this->l10n->__( 'Edit Contact', 'creogen-contacts' ),
				'view_item' => $this->l10n->__( 'View Contact', 'creogen-contacts' ),
				'search_items' => $this->l10n->__( 'Search Contacts', 'creogen-contacts' ),
				'not_found' => $this->l10n->__( 'Contact Not Found', 'creogen-contacts' ),
				'not_found_in_trash' => $this->l10n->__( 'Contact Not Found in Trash', 'creogen-contacts' ),
			],
			'description' => $this->l10n->__( 'Contacts directory on the website', 'creogen-contacts' ),
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

