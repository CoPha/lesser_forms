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
    $route = new Route('/foo', array(), array('_entity_access' => 'node.update'));
    $request = new Request();
    $node = $this->getMockBuilder('Drupal\node\Plugin\Core\Entity\Node')
      ->disableOriginalConstructor()
      ->getMock();
    $node->expects($this->any())
      ->method('access')
      ->will($this->returnValue(TRUE));
    $access_check = new AccessManager();
    $request->attributes->set('node', $node);
    $access = $access_check->access($route, $request);
    $this->assertEquals(TRUE, $access);
  }
}
