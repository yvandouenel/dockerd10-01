<?php

namespace Drupal\library_books\EventSubscriber;

use Drupal\entity_events\Event\EntityEvent;
use Drupal\entity_events\EventSubscriber\EntityEventInsertSubscriber;

class BooksCopySubscriber extends EntityEventInsertSubscriber {

  public function onEntityInsert(EntityEvent $event) {
    dpm($event);
    \Drupal::messenger()->addMessage('Entity inserted');
  }

}
