<?php

namespace Drupal\custom_admin_registration\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DefaultForm.
 */
class DefaultForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_admin_registration.default',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'default_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_admin_registration.default');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('country'),
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('city'),
    ];

    # the values for the dropdown box
     $form['location'] = array (
    '#type' => 'select',
    '#title' => ('Timezone:'),
    '#description' => "Select the timezone.",
    '#options' => array(
      ' America/Chicago' => t(' America/Chicago'),
      'America/New_York' => t('America/New_York'),
      'Asia/Tokyo' => t('Asia/Tokyo'),
      ' Asia/Dubai' => t(' Asia/Dubai'),
      'Asia/Kolkata' => t('Asia/Kolkata'),
      'Europe/Amsterdam' => t('Europe/Amsterdam'),
      ' Europe/Oslo' => t(' Europe/Oslo'),
      'Europe/London' => t('Europe/London'),
    ),
  );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('custom_admin_registration.default')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->save();
  }

}