<?php

namespace Drupal\migrate_tools;

/**
 * Utility functionality for use in migrate_tools.
 */
class MigrateTools {

  /**
   * Build the list of specific source IDs to import.
   *
   * @param array $options
   *   The migration executable options.
   *
   * @return array
   *   The ID list.
   */
  public static function buildIdList(array $options) {
    $options += [
      'idlist' => NULL,
      'idlist-delimiter' => ':',
    ];
    $id_list = [];
    if ($options['idlist']) {
      $id_list = explode(',', $options['idlist']);
      array_walk($id_list, function (&$value) use ($options) {
        $value = str_getcsv($value, $options['idlist-delimiter']);
      });
    }
    return $id_list;
  }

}
