<?php

/**
 * @file
 * Contains \Drupal\mycity\Controller\MyCityController.
 */

namespace Drupal\mycity\Controller;

/**
 * Controller for My City.
 */
class MyCityController {

  /**
   * Simple page to proof the variable was saved in the configuration.
   */
  public function page() {
    $city = \Drupal::config('mycity.settings')->get('city');
    return t('@city is the City.', array('@city' => $city));
  }

}
