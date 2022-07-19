<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Creogen\Contacts\PostType\PostTypeFactory;
use Creogen\Contacts\PostType\ContactPostType;
use Creogen\Contacts\PostType\PostTypeInterface;

/**
 * @covers \Creogen\Contacts\PostType\PostTypeFactory
 */
class PostTypeFactoryTest extends TestCase {
	public function testGetContactPostType_WhenCustomContactPostTypeSet_ReturnsSameContactPostType(): void {
		$contact_post_type = $this->createMock( PostTypeInterface::class );
		PostTypeFactory::set_custom_contact_post_type( $contact_post_type );

		$actual = PostTypeFactory::get_contact_post_type();

		self::assertSame( $contact_post_type, $actual );
	}

	public function testGetContactPostType_WhenCustomContactPostTypeSetToNull_ReturnsContactPostType(): void {
		PostTypeFactory::set_custom_contact_post_type( null );

		$actual = PostTypeFactory::get_contact_post_type();

		self::assertInstanceOf( ContactPostType::class, $actual );
	}
}
