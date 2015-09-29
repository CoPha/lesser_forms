<?php
/**
 * @file
 * Contains \Drupal\lesser_forms\Controller\LesserFormsController.
 */

namespace Drupal\lesser_forms\Controller;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\Role;

/**
 * LesserFormsController.
 */
class LesserFormsController extends ConfigFormBase  {

  const CONFIG_FIELDS = array(
    'promote',
    'sticky',
    'preview',
    'author',
    'revision_information',
  );

  /**
   * gets the form ID
   */
  public function getFormId(){
    return 'lesser_forms_settings';
  }

  /**
   * Show the configuration panel.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

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
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save config'),
      '#submit' => array('submitForm'),
    );
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

  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    // \Drupal::config('lesser_forms.settings')->set();
    //  ->set('enabled', $form_state['values']['maintenance_mode'])
    //  ->set('message', $form_state['values']['maintenance_mode_message'])
    //  ->save();

    parent::submitForm($form, $form_state);
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  public function getEditableConfigNames(){
    return [
      'lesser_forms.settings',
    ];
  }


}
