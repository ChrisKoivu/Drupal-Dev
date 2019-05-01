<?php

namespace Drupal\googleform\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Google Form routes.
 */
class GoogleFormController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build($address) {
    $client = \Drupal::httpClient();  
    try {
        $res = $client->request('GET', "https://maps.googleapis.com/maps/api/geocode/json?address='" . $address . "'&key=AIzaSyDILfFBUbFbc7TU6pUpaUQquwBNx2qQbS8");
        $body = $res->getBody();
        // decode the json response
        $result = json_decode($body);
        // send the result to our twig template
        return [
          '#theme' => 'geocode_results',
          '#gc_results' => $result,
        ];
    } catch (RequestException $e){
      watchdog_exception('googleform', $e->getMessage());
    } 
  }

}
