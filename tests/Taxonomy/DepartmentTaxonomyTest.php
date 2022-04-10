<?php declare(strict_types=1);

use Creogen\Contacts\Taxonomy\DepartmentTaxonomy;
use Merkushin\Wpal\Service\Hooks;
use Merkushin\Wpal\ServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\Taxonomy\DepartmentTaxonomy
 */
class DepartmentTaxonomyTest extends TestCase {

	public function testRegister_WhenCalled_AddsActionOnInit() {
		$hooks = $this->createMock( Hooks::class );
		ServiceFactory::set_custom_hooks( $hooks );

		$taxonomy = new DepartmentTaxonomy();

		$hooks
			->expects( self::once() )
			->method( 'add_action' )
			->with( 'init', [ $taxonomy, 'register_taxonomy' ] );
		$taxonomy->register();
	}
}

