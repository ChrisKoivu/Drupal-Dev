<?php

namespace Drupal\fred\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Example: configurable text string' block.
 *
 * Drupal\Core\Block\BlockBase gives us a very useful set of basic functionality
 * for this configurable block. We can just fill in a few of the blanks with
 * defaultConfiguration(), blockForm(), blockSubmit(), and build().
 *
 * @Block(
 *   id = "fred block",
 *   admin_label = @Translation("This is Fred's block")
 * )
 */
class FredBlock extends BlockBase {

  /**
   * {@inheritdoc}
   *
   * This method sets the block default configuration. This configuration
   * determines the block's behavior when a block is initially placed in a
   * region. Default values for the block configuration form should be added to
   * the configuration array. System default configurations are assembled in
   * BlockBase::__construct() e.g. cache setting and block title visibility.
   *
   * @see \Drupal\block\BlockBase::__construct()
   */
  public function defaultConfiguration() {
    return [
      'block_example_string' => $this->t('A default value. This block was created at %time', ['%time' => date('c')]),
    ];
  }


 
  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'my_template',
      '#title' => 't functions never ever ever work!',
    ];
    
    /* return [
      '#markup' => $this->configuration['block_example_string'],
    ]; */
  }

}