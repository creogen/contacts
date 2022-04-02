<?php declare(strict_types=1);

use Creogen\Contacts\PostType\ContactPostType;
use Merkushin\Wpal\Service\Hooks;
use Merkushin\Wpal\Service\Localization;
use Merkushin\Wpal\Service\PostTypes;
use Merkushin\Wpal\ServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\PostType\ContactPostType
 */
class ContactPostTypeTest extends TestCase {
	public function testRegister_WhenCalled_AddsActionOnInitHook() {
		$hooks_api = $this->createMock( Hooks::class );
		$post_types_api = $this->createMock( PostTypes::class );
		$l10n_api = $this->createMock( Localization::class );
		ServiceFactory::set_custom_hooks( $hooks_api );
		ServiceFactory::set_custom_post_types( $post_types_api );
		ServiceFactory::set_custom_localization( $l10n_api );
		$contact_post_type = new ContactPostType();

		$hooks_api
			->expects( self::once() )
			->method( 'add_action' )
			->with( 'init', [ $contact_post_type, 'register_post_type' ] );
		$contact_post_type->register();
	}

	public function testRegisterPostType_WhenCalled_CallsWpRegisterPostType() {
		$hooks_api = $this->createMock( Hooks::class );
		$post_types_api = $this->createMock( PostTypes::class );
		$l10n_api = $this->createMock( Localization::class );
		$l10n_api
			->method('__')
			->willReturnMap(
				[
					[ 'Contacts Directory', 'creogen-contacts', 'Contacts Directory' ],
					[ 'Contact', 'creogen-contacts', 'Contact' ],
					[ 'Add Contact', 'creogen-contacts', 'Add Contact' ],
					[ 'Edit', 'creogen-contacts', 'Edit' ],
					[ 'Edit Contact', 'creogen-contacts', 'Edit Contact' ],
					[ 'View Contact', 'creogen-contacts', 'View Contact' ],
					[ 'Search Contacts', 'creogen-contacts', 'Search Contacts' ],
					[ 'Contact Not Found', 'creogen-contacts', 'Contact Not Found' ],
					[ 'Contact Not Found in Trash', 'creogen-contacts', 'Contact Not Found in Trash' ],
					[ 'Contacts directory on the website', 'creogen-contacts', 'Contacts directory on the website' ],
				]
			);

		ServiceFactory::set_custom_hooks( $hooks_api );
		ServiceFactory::set_custom_post_types( $post_types_api );
		ServiceFactory::set_custom_localization( $l10n_api );
		$contact_post_type = new ContactPostType();

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

