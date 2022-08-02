<?php declare(strict_types=1);

namespace Creogen\Contacts\PostType;

class PostTypeFactory {
	/**
	 * @var PostTypeInterface|null
	 */
	private static $custom_contact_post_type;

	public static function set_custom_contact_post_type( ?PostTypeInterface $custom_contact_post_type ): void {
		self::$custom_contact_post_type = $custom_contact_post_type;
	}

	public static function create_contact_post_type(): PostTypeInterface {
		if ( self::$custom_contact_post_type ) {
			return self::$custom_contact_post_type;
		}
		return new ContactPostType();
	}
}
