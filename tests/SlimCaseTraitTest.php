<?php

namespace MilesChou\Slim\Test;

use PHPUnit\Framework\TestCase;

/**
 * Testing and demostrate how to use SlimCaseTrait
 */
class SlimCaseTraitTest extends TestCase
{
    use SlimCaseTrait;

    public function setUp()
    {
        $app = require __DIR__ . '/../app.php';
        $this->setApp($app);
    }

    public function tearDown()
    {
    }

    public function testSeeHttpHeader()
    {
        // Arrange
        $url = '/data/empty';
        $exceptedName = 'Content-type';
        $exceptedValue = 'application/json';

        // Act
        $this->haveHeader('Accept', 'application/json');
        $this->sendGET($url);

        // Assert
        $this->seeHttpHeader($exceptedName);
        $this->seeHttpHeader($exceptedName, $exceptedValue);
    }

    public function testSeeResponseOk()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->sendGET($url);

        // Assert
        $this->seeResponseOk();
    }
}
