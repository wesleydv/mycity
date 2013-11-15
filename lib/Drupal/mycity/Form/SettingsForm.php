<?php

namespace Drupal\mycity\Form;

use Drupal\Core\Form\ConfigFormBase;

/**
 * Configuration for the My City module
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'mycity_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    // Get the configuration object for My City.
    $config = $this->configFactory->get('mycity.settings');

    // This create a textfield on the settings.page
    $form['city'] = array(
      '#type' => 'textfield',
      '#title' => t('Site name'),
      '#default_value' => $config->get('city'),
      '#description' => t('The origin city of this site, must be at least four characters long.'),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, array &$form_state) {
    // Check the length of the city.
    if (strlen($form_state['values']['city']) < 4) {
      // Not quite sure it there is no better way of getting the fromBuilder.
      \Drupal::formBuilder()->setError($form['city'], t('City must at least be four characters long.'));
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    // This part actually saves the value in the configuration.
    $this->configFactory->get('mycity.settings')
      ->set('city', $form_state['values']['city'])
      ->save();

    parent::submitForm($form, $form_state);
  }
}
