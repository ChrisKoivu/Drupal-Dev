<?php

namespace Drupal\site_name_change\EventSubscriber;

use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigCrudEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Site Name Change event subscriber.
 */
class SiteNameChangeSubscriber implements EventSubscriberInterface {

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructs event subscriber.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger.
   */
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  

  public function onSavedConfig(ConfigCrudEvent $event) {
    $config = $event->getConfig();
    drupal_set_message('Saved config: ' . $config->getName(). DRUPAL_ROOT); 
    \Drupal::service('logger.factory')->get('site_name_change')
    ->notice('the site name has changed from event subscriber');  
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [      
      ConfigEvents::SAVE => ['onSavedConfig'],
    ];
  }

}
