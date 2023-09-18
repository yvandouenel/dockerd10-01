<?php declare(strict_types = 1);

namespace Drupal\library_books;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of library books type entities.
 *
 * @see \Drupal\library_books\Entity\LibraryBooksType
 */
final class LibraryBooksTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['label'] = $this->t('Label');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    $row['label'] = $entity->label();
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    $build = parent::render();

    $build['table']['#empty'] = $this->t(
      'No library books types available. <a href=":link">Add library books type</a>.',
      [':link' => Url::fromRoute('entity.library_books_type.add_form')->toString()],
    );

    return $build;
  }

}
