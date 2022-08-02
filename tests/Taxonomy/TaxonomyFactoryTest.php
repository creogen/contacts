<?php declare( strict_types = 1 );

use Creogen\Contacts\Taxonomy\TaxonomyFactory;
use Creogen\Contacts\Taxonomy\TaxonomyInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\Taxonomy\TaxonomyFactory
 */
class TaxonomyFactoryTest extends TestCase {
	public function testCreateDepartmentTaxonomy_WhenCalled_ReturnsDepartmentTaxonomy(): void {
		$taxonomy = TaxonomyFactory::create_department_taxonomy();

		self::assertInstanceOf( TaxonomyInterface::class, $taxonomy );
	}

	public function testCreateDepartmentTaxonomy_WhenCustonDepartmentTaxonomySet_ReturnsCustomDepartmentTaxonomy(): void {
		$custom_taxonomy = $this->createMock( TaxonomyInterface::class );
		TaxonomyFactory::set_custom_department_taxonomy( $custom_taxonomy );

		$taxonomy = TaxonomyFactory::create_department_taxonomy();

		self::assertSame( $custom_taxonomy, $taxonomy );
	}
}
