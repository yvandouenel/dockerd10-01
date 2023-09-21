<?php

declare(strict_types = 1);

namespace Drupal\library_books\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the library books entity edit forms.
 */
final class LibraryBooksForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int {
    $result = parent::save($form, $form_state);
    $message_args = ['%label' => $this->entity->toLink()->toString()];
    $logger_args = [
      '%label' => $this->entity->label(),
      'link' => $this->entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New library books %label has been created.', $message_args));
        $this->logger('library_books')->notice('New library books %label has been created.', $logger_args);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The library books %label has been updated.', $message_args));
        $this->logger('library_books')->notice('The library books %label has been updated.', $logger_args);
        break;

      default:
        throw new \LogicException('Could not save the entity.');
    }

    if ($this->entity->bundle() === "copy_book") {
      // Modification du livre concerné par ce nouvel exemplaire :
      $book_id = $this->entity->field_copy_of[0]->target_id;
      $entity_book = \Drupal::entityTypeManager()->getStorage("library_books")->load($book_id);
      $entity_book->get('field_copy_book')->appendItem([
        'target_id' => $this->entity->id(),
      ]);
      $entity_book->save();
    }

    $form_state->setRedirectUrl($this->entity->toUrl());

    return $result;
  }

}
