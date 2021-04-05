<?php

namespace Drupal\contact\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class CustomSettingsForm extends ConfigFormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'contact.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['settings.email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Enter e-mail sender.'),
      '#default_value' => $config->get('settings.email'),
    ];

    $form['core_autocomplete'] = [
      '#title' => $this->t('Core autocomplete'),
      '#type' => 'entity_autocomplete',
      '#target_type' => 'node',
    ];


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->configFactory->getEditable(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('example_thing', $form_state->getValue('settings.email'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
