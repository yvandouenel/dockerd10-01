<?php

namespace Drupal\library_books\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines a controller to load books management page.
 */
class LibraryBooksManagement extends ControllerBase {
  /**
   * The current User.
   *
   * @var Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->currentUser = $this->entityTypeManager()->getStorage('user')->load($this->currentUser()->id());
  }

  /**
   * Méthode qui permet d'afficher la liste des livres.
   */
  public function index() {
    $query = $this->entityTypeManager()->getStorage('library_books')->getQuery();
    $query->accessCheck(TRUE);

    $entities_id = $query
      ->condition('bundle', 'book', '=')
      ->condition('status', 1)
      ->execute();

    // Chargement de entités.
    // $entities_books = $this->entityTypeManager()->getStorage('library_books')->loadMultiple($entities_id);
    // dpm($entities_books);
    return [
      '#theme' => 'books_management',
      '#user' => [
        "name" => $this->currentUser->getDisplayName(),
      ],
      "#books" => $entities_id,
      '#cache' => [
        'tags' => ['library_books_list:book', 'library_books_list:copy_book'],
        "contexts" => ['user'],
      ],
    ];
  }

}
