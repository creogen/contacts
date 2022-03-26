<?php declare(strict_types=1);

use Creogen\Contacts\Contacts;
use Merkushin\Wpal\Plugins;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\Contacts
 */
final class ContactsTest extends TestCase {
	public function testInit_WhenCalled_RegistersActivationHook() {
		$pluginsApi = $this->createMock( Plugins::class );
		$contacts = new Contacts( $pluginsApi, 'a' );

		$pluginsApi
			->expects( self::once() )
			->method( 'register_activation_hook' )
			->with( 'a', [ $contacts, 'activate_plugin' ] );
		$contacts->init();
	}
}
		
