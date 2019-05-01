<?php

namespace Drupal\site_name_change\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Site Name Change routes.
 */
class SiteNameChangeController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
