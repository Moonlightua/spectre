<?php
namespace Drupal\module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class ExampleController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function myPage() {

    $config = \Drupal::service('config.factory')
      ->getEditable('module.settings')
      ->set('custom', 'One more')
      ->save()
      ->get('custom');

    return [
      '#markup' => "Hello $config",
    ];
  }

}
