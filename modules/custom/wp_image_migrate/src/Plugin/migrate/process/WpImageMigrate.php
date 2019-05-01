<?php

namespace Drupal\wp_image_migrate\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Provides a wp_image_migrate plugin.
 *
 * Usage:
 *
 * @code
 * process:
 *   image_url:
 *     plugin: wp_image_migrate
 *     source: Image
 * @endcode
 *
 * @MigrateProcessPlugin(
 *   id = "wp_image_migrate"
 * )
 */

class WpImageMigrate extends ProcessPluginBase {
  
  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
      if(!empty($value)){
        $drupal_path = file_create_url("public://images") .'/' . basename($value);
       //$drupal_path = file_create_url("public://") . date("Y-m"). '/' . basename($value);
        return $drupal_path;
      }

      return null;
  }

}
