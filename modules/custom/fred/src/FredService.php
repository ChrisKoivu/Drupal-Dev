<?php

namespace Drupal\fred;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Class FredService.
 */
class FredService {

 protected $database;
 protected $entityTypeManager;

/**

 @see hook_entity_type_alter()
 @see hook_entity_type_build()

*/
 
 public function __construct(EntityTypeManagerInterface $entityTypeManager) {
   $this->database = \Drupal::database();
   $this->entityTypeManager = $entityTypeManager;
 }

  public function getArticles(){
    
    /*$query = $this->database->query("SELECT * from {node} WHERE type = :type", [
      ':type' => 'article',
    ]);*/
    //$query = $this->database->query("SELECT * from {node}");
    //$result = $query->fetchAll();
    //print_r($result);
    //return 'from the default service';

    // Query with entity_type.manager (The way to go)
    /* $query = $this->entityTypeManager->getStorage('node');
    $query_result = $query->getQuery()
      ->condition('status', 1)
      ->condition('type', 'article')
      ->execute();
 */
      $node_storage = $this->entityTypeManager->getStorage('node');
      // load 2nd node
      $node = $node_storage->load(2);


    ksm($node);

  }

  public function getArticleById($id = NULL ){
    $article_storage = $this->entityTypeManager->getStorage('node');
    // load selected article
    $article = $article_storage->load(1);
    return $article;
  }

}
