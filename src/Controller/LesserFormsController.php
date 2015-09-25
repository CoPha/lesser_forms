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

  const CONFIG_FIELDS = array(
    'promote',
    'sticky',
    'preview',
    'author',
    'revision_information',
  );

  /**
   * Show the configuration panel.
   */
  public function config() {

    $settings = \Drupal::config('lesser_forms.settings')
      ->get('lesser_forms_config');

    $user_roles = Role::loadMultiple();

    $header = $this->getTableHeader($user_roles);

    $form['lf_table'] = array(
      '#type' => 'table',
      '#header' => $header,
    );
    foreach (self::CONFIG_FIELDS as $field) {
      $form['lf_table'][$field]['title'] = array(
        '#plain_text' => $field,
      );
      foreach ($user_roles as $id => $entity) {
        $form['lf_table'][$field][$entity->label()] = array(
          '#type' => 'checkbox',
          '#checked' => $this->getSettingsValue($settings, $entity->label(), $field),
        );
      }
    }
    return $form;
  }

  /**
   * Get the default value of the checkbox out of the settings.
   */
  public function getSettingsValue($settings, $role_name, $field_name) {
    if ($settings == NULL || $settings[$field_name] == NULL) {
      return false;
    }

    if (in_array($role_name, $settings[$field_name])) {
      return true;
    }
    return false;
  }

  /**
   * Prepares the config table header.
   */
  public function getTableHeader($user_roles) {
    $header = array(t('field'));

    foreach ($user_roles as $id => $entity) {
      $header[] = $entity->label();
    }
    return $header;
  }

}
