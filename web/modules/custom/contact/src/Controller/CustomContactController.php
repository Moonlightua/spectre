<?php

namespace Drupal\contact\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines HelloController class.
 */
class CustomContactController extends ControllerBase {

  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello, World!'),
    ];
  }

  public function settings() {

    $default_config = \Drupal::config('contact.settings')
      ->get('hello.name');

    return [
      '#type' => 'markup',
      '#markup' => $this->t("$default_config"),
    ];
  }

}
