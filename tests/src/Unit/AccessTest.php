<?php

/**
 * @file
 * Contains Drupal\Tests\lesser_forms\Unit\AccessTest
 */

namespace Drupal\Tests\lesser_forms\Unit;

use Drupal\Core\Url;
use Drupal\Core\Access\AccessManager;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Drupal\lesser_forms\Controller\LesserFormsController;

/**
 * Covers LesserFormsController.
 *
 * @coversDefaultClass Drupal\lesser_forms\Controller\LesserFormsController
 *
 * @group lesser_forms
 */
class AccessTest extends UnitTestCase {
  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Tests access on a unit.
   */
  public function testAccess() {
    // @todo: Write test that check on the access level based on permission.
  }
}
