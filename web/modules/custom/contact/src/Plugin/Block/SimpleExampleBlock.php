<?php

/**
 * @file
 * Contains \Drupal\contact\Plugin\Block\SimpleBlockExample.
 */

namespace Drupal\contact\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Добавляем простой блок с текстом.
 * Ниже - аннотация, она также обязательна.
 *
 * @Block(
 *   id = "simple_block_example",
 *   admin_label = @Translation("Simple block example"),
 * )
 */
class SimpleExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $block = [
      '#type' => 'markup',
      '#markup' => '<strong>Hello World!</strong>'
    ];
    return $block;
  }

}
