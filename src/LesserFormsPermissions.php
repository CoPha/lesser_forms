<?php
namespace Drupal\lesser_forms;

class LesserFormsPermissions extends LesserFormsTests {
  /**
   * Metadata about our test case.
   */
  public static function getInfo() {
    return array(
      'name' => 'Lesser Forms permissions',
      'description' => 'Tests for permission related actions in Lesser Forms.',
      'group' => 'Lesser Forms',
    );
  }

  /**
   * Accessing as user with correct permissions.
   */
  public function testLesserFormsPrivilegedUser() {
    // Create and log in a privileged user.
    $privileged_user = $this->drupalCreateUser(array('administer lesser forms'));
    $this->drupalLogin($privileged_user);

    // Can the user access the page?
    $this->drupalGet('admin/config/content/lesser_forms');
    $this->assertResponse(200);

    // Can the user save?
    $edit = array();
    $this->drupalPost('admin/config/content/lesser_forms', $edit, t('Save'));
    $this->assertText(t('System preferences saved!'), 'Correctly saved.');
  }

  /**
   * Accessing as anonymous.
   */
  public function testLesserFormsAccessAnonymous() {
    // Make sure we're logged out and don't have a session.
    $this->drupalLogout();
    drupal_save_session(FALSE);

    // Try accessing lesser forms as anonymous.
    $this->drupalGet('admin/config/content/lesser_forms');
    // If we get a 403, that's a good thing.
    $this->assertResponse(403);

  }
}
