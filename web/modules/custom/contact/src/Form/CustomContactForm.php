<?php

namespace Drupal\contact\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an example form.
 */
class CustomContactForm extends FormBase {

  const EMAIL = 'jaxdotes@gmail.com';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_contact';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your name'),
    ];
    $form['phone_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Your phone number'),
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
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('phone_number')) < 3) {
      $form_state->setErrorByName('phone_number', $this->t('The phone number is too short. Please enter a full phone number.'));
    }
    if ($form_state->getValue('name') == 'Igor') {
      $form_state->setErrorByName('name', $this->t('Sorry, but Igor, it\'s not a name, it\'s nickname'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $newMail = \Drupal::service('plugin.manager.mail');
    $params['email'] = self::EMAIL;
    $params['phone'] = $form_state->getValue('phone_number');
    $params['name'] = $form_state->getValue('name');
    $reply = \Drupal::config('contact.settings')
      ->get('settings.email');
    $newMail->mail('contact', 'custom_contact', self::EMAIL, 'en', $params, $reply, $send = TRUE);
    \Drupal::messenger()->addMessage('Mail has been sent.', 'status');
  }

}
