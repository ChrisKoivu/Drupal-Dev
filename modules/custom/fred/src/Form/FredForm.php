<?php

namespace Drupal\fred\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 */
class FredForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('For configuring Fred'),
    ];

    // Textfield.
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your Name'),
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => $this->t('Textfield, #type = textfield'),
    ];




    // CheckBoxes.
    $form['tests_taken'] = [
      '#type' => 'checkboxes',
      '#options' => ['SAT' => $this->t('SAT'), 'ACT' => $this->t('ACT')],
      '#title' => $this->t('What standardized tests did you take?'),
      '#description' => 'Checkboxes, #type = checkboxes',
    ];

    // Textfield.
    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subject'),
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => $this->t('Textfield, #type = textfield'),
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#description' => $this->t('Submit, #type = submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_for_fred';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();
    foreach ($values as $key => $value) {
      $label = isset($form[$key]['#title']) ? $form[$key]['#title'] : $key;

      // Many arrays return 0 for unselected values so lets filter that out.
      if (is_array($value)) {
        $value = array_filter($value);
      }


      // Only display for controls that have titles and values.
      if ($value && $label) {
        $display_value = is_array($value) ? preg_replace('/[\n\r\s]+/', ' ', print_r($value, 1)) : $value;
        $message = $this->t('Value for %title: %value', ['%title' => $label, '%value' => $display_value]);
        $this->messenger()->addMessage($message);
      }
    }

    ksm($values['name']);
  }

}
