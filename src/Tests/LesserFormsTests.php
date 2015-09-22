<?php
namespace Drupal\lesser_forms\Tests;

/**
 * @file
 * Tests for Lesser Forms.
 */
class LesserFormsTests extends \Drupal\simpletest\WebTestBase {

  protected $profile = 'standard';

  /**
   * Perform any setup tasks for our test case.
   */
  public function setUp() {
    parent::setUp(['lesser_forms']);
  }

}
