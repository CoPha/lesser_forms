<?php
/**
 * @file
 * Contains \Drupal\lesser_forms\Controller\LesserFormsController.
 */

namespace Drupal\lesser_forms\Controller;
use Drupal\user\Entity\Role;

/**
 * LesserFormsController.
 */
class LesserFormsController {
  /**
   * Show the configuration panel.
   */
  public function config() {

    $settings = \Drupal::config('lesser_forms.settings')->get('lesser_forms_config');

    $user_roles = Role::loadMultiple();

    $header = array(t('field'));

    foreach ($user_roles as $id => $entity) {
        $header[]=$entity->label();
    }
    $form['lf_table'] = array(
        '#type' => 'table',
        '#header' => $header,
    );
    $fields = array('promote','sticky','preview','author','revision_information');

    foreach ($fields as $field) {
      $form['lf_table'][$field]['title'] = array(
          '#plain_text' => $field,
      );
      foreach ($user_roles as $id => $entity) {
        $form['lf_table'][$field][$entity->label()] = array(
           '#type' => 'checkbox',
           '#default_value' => '',
        );
      }
    }

    return $form;
  }
}
