<?php
/**
 * @file
 * Contains \Drupal\lesser_forms\Controller\LesserFormsController.
 */

namespace Drupal\lesser_forms\Controller;

/**
 * LesserFormsController.
 */
class LesserFormsController {
  /**
   * Show the configuration panel.
   */
  public function config() {

    $settings = \Drupal::config('lesser_forms.settings')
      ->get('lesser_forms_config');


    return array(
      '#markup' => var_dump($settings),
    );
  }
}
