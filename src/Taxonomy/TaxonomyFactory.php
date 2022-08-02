<?php declare( strict_types=1 );

namespace Creogen\Contacts\Taxonomy;

class TaxonomyFactory {
	/**
	 * @var TaxonomyInterface
	 */
	private static $custom_department_taxonomy;

	public static function create_department_taxonomy(): TaxonomyInterface {
		if ( self::$custom_department_taxonomy ) {
			return self::$custom_department_taxonomy;
		}
		return new DepartmentTaxonomy();
	}

	public static function set_custom_department_taxonomy( TaxonomyInterface $custom_taxonomy ): void {
		self::$custom_department_taxonomy = $custom_taxonomy;
	}
}
