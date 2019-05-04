<?php 

namespace Drupal\fred\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure site settings for this site.
 */
class FredConfigForm extends ConfigFormBase {
   
   
    const SITE_SETTINGS = 'system.site';

   /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'site_settings_form';
  }


  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() { 
    return [
      static::SITE_SETTINGS,
    ];
  }

   /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SITE_SETTINGS);

    $form['site_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Site Name'),
      '#default_value' => $config->get('name'),
    );  

    $form['site_slogan'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Site slogan'),
        '#default_value' => $config->get('slogan'),
    );  
  

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

     // Retrieve the configuration
     $this->configFactory->getEditable(static::SITE_SETTINGS)
    // Set the submitted configuration setting
    ->set('name', $form_state->getValue('site_name'))
    ->set('slogan', $form_state->getValue('site_slogan'))
    ->save();

  parent::submitForm($form, $form_state);
}

}