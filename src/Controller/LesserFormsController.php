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
    return array(
      '#markup' => t('Hello World!'),
    );
  }
}
