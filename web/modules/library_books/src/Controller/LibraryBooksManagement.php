<?php

namespace Drupal\library_books\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a controller to load books management page.
 */
class LibraryBooksManagement extends ControllerBase {
  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('entity_type.manager')
      );
  }

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * Méthode qui permet d'afficher la liste des livres.
   */
  public function index() {
    $query = $this->entityTypeManager->getStorage('library_books')->getQuery();
    $query->accessCheck(TRUE);

    $entities_id = $query
      ->condition('bundle', 'book', '=')
      ->condition('status', 1)
      ->execute();
    // $entities_id = [1, 2, 3];
    // $drupal_account = User::load($this->current_user->id());
    return [
      '#theme' => 'books_management',
      '#user' => [
    // $current_user->getAccountName()
        "name" => "Jojo",
      ],
      "#books" => $entities_id,
    ];
  }

}
