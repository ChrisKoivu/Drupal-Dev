<?php

namespace Drupal\googleform\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

Class GoogleForm extends FormBase {



    /**
   * Build the form.
   *
   *
   * @param array $form
   *   Default form array structure.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object containing current form state.
   *
   * @return array
   *   The render array defining the elements of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Partial Address'),
      '#required' => TRUE,
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }


  public function getFormId() {
    return 'googleform';
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
       $address = $form_state->getValue('address');
        // send address to the route
        $form_state->setRedirect('googleform.results',[
          'address' =>  $address
        ]);
  }
}


