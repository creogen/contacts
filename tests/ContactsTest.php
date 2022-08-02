<?php declare(strict_types=1);

use Creogen\Contacts\PostType\PostTypeFactory;
use Creogen\Contacts\PostType\PostTypeInterface;
use Creogen\Contacts\Contacts;
use Creogen\Contacts\Taxonomy\TaxonomyInterface;
use Creogen\Contacts\Taxonomy\TaxonomyFactory;
use Merkushin\Wpal\Service\Hooks;
use Merkushin\Wpal\ServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\Contacts
 */
final class ContactsTest extends TestCase {
	public function testRegisterTaxonomies_WhenCalled_RegistersDepartmentTaxonomy(): void {
		$department_taxonomy = $this->createMock( TaxonomyInterface::class );
		TaxonomyFactory::set_custom_department_taxonomy( $department_taxonomy );

		$contacts = new Contacts( 'a' );

		$department_taxonomy
			->expects( $this->once() )
			->method( 'register' );
		$contacts->register_taxonomies();
	}	

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
			->expects( $this->exactly( 2 ) )
			->method( 'add_action' )
			->withConsecutive( 
				[ 'init', [ $contacts, 'register_taxonomies' ] ],
				[ 'init', [ $contacts, 'register_post_types' ] ]
			);
		$contacts->init();
	}
}

