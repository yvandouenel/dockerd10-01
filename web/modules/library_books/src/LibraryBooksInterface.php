<?php declare(strict_types = 1);

namespace Drupal\library_books;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a library books entity type.
 */
interface LibraryBooksInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
