<?php

namespace Drupal\generator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for generating content
 */
class GeneratorForm extends FormBase {

  /**
   * Config settings.
   */
  const SETTINGS = 'generator.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'generator_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = \Drupal::config(self::SETTINGS);

    $form['content_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Content type'),
      '#description' => $this->t('Choose content type for generating nodes.'),
      '#options' => $this->getContentTypes(),
      '#empty_option' => '- Select _',
      '#required' => true,
    ];

    $form['quantity'] = [
      '#type' => 'number',
      '#title' => $this->t('Quantity'),
      '#description' => $this->t('Number of created nodes.'),
      '#default_value' => $config->get('quantity'),
      '#min' => 1,
      '#max' => 15,
    ];

    $form['random_images'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use random images'),
      '#description' => $this->t('If checked, module will use random images from media libriary.'),
      '#default_value' => $config->get('random_images'),
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // TODO: Implement submitForm() method.
  }

  public function getContentTypes()
  {

    $types = \Drupal::entityTypeManager()
      ->getStorage('node_type')
      ->loadMultiple();
    $content_types = [];

    dump($types);


    return $content_types;
  }
}
