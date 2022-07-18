<?php declare(strict_types=1);

use Creogen\Contacts\Taxonomy\DepartmentTaxonomy;
use Merkushin\Wpal\Service\Hooks;
use Merkushin\Wpal\Service\Taxonomies;
use Merkushin\Wpal\ServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Creogen\Contacts\Taxonomy\DepartmentTaxonomy
 */
class DepartmentTaxonomyTest extends TestCase {

	public function testRegister_WhenCalled_AddsActionOnInit() {
		$hooks = $this->createMock( Hooks::class );
		ServiceFactory::set_custom_hooks( $hooks );
		$taxonomies = $this->createMock( Taxonomies::class );
		ServiceFactory::set_custom_taxonomies( $taxonomies );

		$taxonomy = new DepartmentTaxonomy();

		$hooks
			->expects( self::once() )
			->method( 'add_action' )
			->with( 'init', [ $taxonomy, 'register_taxonomy' ] );
		$taxonomy->register();
	}

	public function testRegisterTaxonomy_WhenCalled_CallsWpRegisterTaxonomy() {
		$hooks = $this->createMock( Hooks::class );
		ServiceFactory::set_custom_hooks( $hooks );
		$taxonomies = $this->createMock( Taxonomies::class );
		ServiceFactory::set_custom_taxonomies( $taxonomies );

		$taxonomy = new DepartmentTaxonomy();

		$taxonomies
			->expects( self::once() )
			->method( 'register_taxonomy' )
			->with(
				'taxonomy_department',
				'creogen_contact',
				[
					'labels' => [
						'name' => 'Departments',
						'singular_name' => 'Department',
						'search_items' => 'Search Departments',
						'all_items' => 'All Departments',
						'edit_item' => 'Edit Department',
						'update_item' => 'Update Department',
						'add_new_item' => 'Add New Department',
						'new_item_name' => 'New Department Name',
						'menu_name' => 'Departments',
					],
					'public' => true,
					'hierarchical' => true,
					'show_ui' => true,
					'show_in_menu' => true,
					'show_in_nav_menus' => false,
					'show_tagcloud' => true,
					'show_in_quick_edit' => true,
					'meta_box_cb' => null,
					'show_admin_column' => true,
					'update_count_cb' => null,
					'query_var' => 'taxonomy_department',
					'rewrite' => [
						'slug' => 'taxonomy_department',
						'with_front' => true,
						'hierarchical' => true,
						'ep_mask' => 'EP_MASK',
					],
					'capabilities' => [
						'manage_terms' => 'manage_categories',
						'edit_terms' => 'manage_categories',
						'delete_terms' => 'manage_categories',
						'assign_terms' => 'edit_posts',
					],
					'sort' => true,
				]
			);
		$taxonomy->register_taxonomy();
	}
}

