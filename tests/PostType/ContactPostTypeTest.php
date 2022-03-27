<?php declare(strict_types=1);

use Creogen\Contacts\PostType\ContactPostType;
use Merkushin\Wpal\Hooks;
use Merkushin\Wpal\PostTypes;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\PostType\ContactPostType
 */
class ContactPostTypeTest extends TestCase {
	public function testRegister_WhenCalled_AddsActionOnInitHook() {
		$hooks_api = $this->createMock( Hooks::class );
		$post_types_api = $this->createMock( PostTypes::class );
		$contact_post_type = new ContactPostType( $hooks_api, $post_types_api );

		$hooks_api
			->expects( self::once() )
			->method( 'add_action' )
			->with( 'init', [ $contact_post_type, 'register_post_type' ] );
		$contact_post_type->register();
	}

	public function testRegisterPostType_WhenCalled_CallsWpRegisterPostType() {
		$hooks_api = $this->createMock( Hooks::class );
		$post_types_api = $this->createMock( PostTypes::class );
		$contact_post_type = new ContactPostType( $hooks_api, $post_types_api );

		$expected_args = [
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

		$post_types_api
			->expects( self::once() )
			->method( 'register_post_type' )
			->with( 'creogen_contact', $expected_args );
		$contact_post_type->register_post_type();
	}
}

