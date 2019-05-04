<?php

namespace Drupal\fred\Controller;

use Drupal\Core\Controller\ControllerBase;

class FredController extends ControllerBase {

  public function hello() {
   
    $config = \Drupal::config('system.site');
    $slogan = $config->get('slogan');
    $theme_name = \Drupal::config('system.theme')->get('default');
    
    
    return [
      '#markup' => '<p>' . $this->t('Hello message. Theme Name: ' . $theme_name) .'</p>',
    ];
  }

  public function get_articles(){
    $article_list = \Drupal::service('fred.articles')->getArticles();
    
    return [
      '#markup' => '<p>' . $this->t('Hello: ' . $article_list) .'</p>',
    ];

  }

  public function content($id = NULL) {
    $fredArticles = \Drupal::service('fred.articles');
  
   
    if ($record = $fredArticles->getArticleById($id)) {
      $title = $record->getTitle();
      //print_r('the title of this article is: ' . $title);


    return [
      '#theme' => 'my_template',
      '#title' => $title,
    ];
   }else{
    
    return [
      '#theme' => 'my_template',
      '#data' => 'no article found',
    ];
   }
    
  }

}   