<?php

namespace Drupal\site_name_change\Form;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Logger\LoggerChannelInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Configure Site Name Change settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   * 
   */
   protected $logger;

   /**
    * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
    */

   public function __construct(ConfigFactoryInterface 
   $config_factory, LoggerChannelInterface $logger) {
    parent::__construct($config_factory);
    $this->logger = $logger;
  }

   /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('site_name_change.logger.channel.site_name_change')
    );
  }

   function getEditableConfigNames(){
     
   }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'site_name_change_settings';
  }

   /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $site_name = \Drupal::config('system.site')->get('name');
    $form['example'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Example'),
      '#default_value' =>  $site_name,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!is_string($form_state->getValue('example'))){
      $form_state->setErrorByName('example', $this->t('The value is not a string'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set the site name.
    \Drupal::configFactory()->getEditable('system.site')->set('name', 
    $form_state->getValue('example'))->save();
   
    parent::submitForm($form, $form_state);
    $this->logger->info('The Site Name has been changed to @message @from', 
    ['@message' => $form_state->getValue('example'),
    '@from' => 'from submit form method']);

    $accounts[] = \Drupal::config('system.site')->get('mail');
  $this->site_name_change_notify();
  }

  public function site_name_change_notify() {
    $email = \Drupal::config('system.site')->get('mail');
    $langcode = \Drupal::config('system.site')->get('langcode');
     
  
     \Drupal::service('plugin.manager.mail')
        ->mail('site_name_change', 'notice', $email, $langcode, $params = array(), $reply = "chriskoivu@gmail.com", $send = TRUE);
     
  } 

}
