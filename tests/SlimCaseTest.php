<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;

class SlimCaseTest extends TestCase
{
    /**
     * @var Client
     */
    private $target;

    public function setUp()
    {
        $app = require __DIR__ . '/slimapp.php';
        $this->target = new SlimCase($app);
    }

    public function tearDown()
    {
        $this->target = null;
    }

    /**
     * @expectedException BadMethodCallException
     * @expectedExceptionMessageRegExp /undefinedMethod/
     */
    public function testUndefinedMethod()
    {
        // Act & Assert
        $this->target->undefinedMethod();
    }

    public function testDontSeeResponseCodeIs()
    {
        // Arrange
        $url = '/will/return/error';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->dontSeeResponseCodeIs(200);
    }

    public function testDontSeeResponseOk()
    {
        // Arrange
        $url = '/will/return/error';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->dontSeeResponseOk();
    }

    public function testSeeResponseCodeIs()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->seeResponseCodeIs(200);
    }

    public function testSeeResponseContains()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->seeResponseContains('GET');
        $this->target->seeResponseContains('OK');
        $this->target->seeResponseContains('[]');
    }

    public function testSeeResponseOk()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->seeResponseOk();
    }
}
