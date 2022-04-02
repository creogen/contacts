<?php declare(strict_types=1);

use Creogen\Contacts\Contacts;
use Merkushin\Wpal\Service\Plugins;
use Merkushin\Wpal\ServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\Contacts
 */
final class ContactsTest extends TestCase {
	public function testInit_WhenCalled_RegistersActivationHook() {
		$plugins_api = $this->createMock( Plugins::class );
		ServiceFactory::set_custom_plugins( $plugins_api );
		$contacts = new Contacts( 'a' );

		$plugins_api
			->expects( self::once() )
			->method( 'register_activation_hook' )
			->with( 'a', [ $contacts, 'activate_plugin' ] );
		$contacts->init();
	}
}
		
