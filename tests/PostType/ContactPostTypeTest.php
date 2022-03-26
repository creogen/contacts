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
}

