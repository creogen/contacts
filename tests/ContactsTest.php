<?php declare(strict_types=1);

use Creogen\Contacts\PostType\PostTypeFactory;
use Creogen\Contacts\PostType\PostTypeInterface;
use Creogen\Contacts\Contacts;
use Merkushin\Wpal\Service\Hooks;
use Merkushin\Wpal\ServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\Contacts
 */
final class ContactsTest extends TestCase {
	public function testRegisterPostTypes_WhenCalled_RegistersContactPostType(): void {
		$contact_post_type = $this->createMock( PostTypeInterface::class );
		PostTypeFactory::set_custom_contact_post_type( $contact_post_type );

		$contacts = new Contacts( 'a' );

		$contact_post_type
			->expects( $this->once() )
			->method( 'register' );
		$contacts->register_post_types();
	}

	public function testInit_WhenCalled_AddsAction(): void {
		$hooks_api = $this->createMock( Hooks::class );
		ServiceFactory::set_custom_hooks( $hooks_api );

		$contacts = new Contacts( 'a' );

		$hooks_api
			->expects( $this->once() )
			->method( 'add_action' )
			->with( 'init', [ $contacts, 'register_post_types' ] );
		$contacts->init();
	}
}

