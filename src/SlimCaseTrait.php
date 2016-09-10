<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use BadMethodCallException;
use phpQuery;
use PHPUnit_Framework_Assert as PHPUnit;
use Slim\App;

/**
 * The Slim's TestCase named SlimCase, using Codeception BDD style.
 *
 * @see http://codeception.com/docs/modules/REST
 */
trait SlimCaseTrait
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var Client
     */
    public $client;

    /**
     * Initailize Client
     *
     * @param App|null $app
     */
    public function setApp($app)
    {
        $this->app = $app;
        $this->client = new Client($app);
    }

    /**
     * Set http header
     *
     * @param string $name
     * @param string $value
     */
    public function haveHeader($name, $value)
    {
        $this->client->setHeader($name, $value);
    }

    /**
     * @param string $exceptedName
     * @param null|string $exceptedValue
     * @param string $message
     */
    public function dontSeeHttpHeader($exceptedName, $exceptedValue = null, $message = '')
    {
        $exceptedName = (string) $exceptedName;
        $exceptedValue = $exceptedValue;

        $actual = $this->client->getResponseHeaders();

        $constraint = new Constraint\DontSeeHttpHeader($exceptedName, $exceptedValue);

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param int $excepted
     * @param string $message
     */
    public function dontSeeResponseCodeIs($excepted, $message = '')
    {
        $excepted = (int) $excepted;
        $actual = $this->client->getStatusCode();

        $constraint = new Constraint\ResponseCodeIsNot($excepted);

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $excepted
     * @param string $message
     */
    public function dontSeeResponseContains($excepted, $message = '')
    {
        $excepted = (string) $excepted;
        $actual = $this->client->getBody();

        $constraint = new Constraint\ResponseNotContains($excepted);

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $message
     */
    public function dontSeeResponseOk($message = '')
    {
        $actual = $this->client->getStatusCode();

        $constraint = new Constraint\ResponseIsNotOk();

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $excepted
     * @param string $message
     */
    public function dontSeeResponseTitleIs($excepted, $message = '')
    {
        $excepted = (string) $excepted;
        $body = (string) $this->client->getBody();

        $output = [];
        $pq = phpQuery::newDocument($body);
        $actual = $pq['title']->html();

        PHPUnit::assertNotEquals($excepted, $actual, $message);
    }

    /**
     * @param string $exceptedName
     * @param null|string $exceptedValue
     * @param string $message
     */
    public function seeHttpHeader($exceptedName, $exceptedValue = null, $message = '')
    {
        $exceptedName = (string) $exceptedName;
        $exceptedValue = $exceptedValue;

        $actual = $this->client->getResponseHeaders();

        $constraint = new Constraint\SeeHttpHeader($exceptedName, $exceptedValue);

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param int $excepted
     * @param string $message
     */
    public function seeResponseCodeIs($excepted, $message = '')
    {
        $excepted = (int) $excepted;
        $actual = $this->client->getStatusCode();

        $constraint = new Constraint\ResponseCodeIs($excepted);

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $excepted
     * @param string $message
     */
    public function seeResponseContains($excepted, $message = '')
    {
        $excepted = (string) $excepted;
        $actual = $this->client->getBody();

        $constraint = new Constraint\ResponseContains($excepted);

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $message
     */
    public function seeResponseOk($message = '')
    {
        $actual = $this->client->getStatusCode();

        $constraint = new Constraint\ResponseIsOk();

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $excepted
     * @param string $message
     */
    public function seeResponseTitleIs($excepted, $message = '')
    {
        $excepted = (string) $excepted;
        $body = (string) $this->client->getBody();

        $output = [];
        $pq = phpQuery::newDocument($body);
        $actual = $pq['title']->html();
        $actual = $actual === '' ? null : $actual;

        PHPUnit::assertEquals($excepted, $actual, $message);
    }

    /**
     * Send GET request
     *
     * @param string $url
     * @param array $data This array will transfer to query string
     */
    public function sendGET($url, $data = [])
    {
        $this->client->request('GET', $url, $data);
    }

    /**
     * Send POST request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPOST($url, $data = [])
    {
        $this->client->request('POST', $url, $data);
    }

    /**
     * Send PUT request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPUT($url, $data = [])
    {
        $this->client->request('PUT', $url, $data);
    }

    /**
     * Send DELETE request
     *
     * @param string $url
     * @param array $data
     */
    public function sendDELETE($url, $data = [])
    {
        $this->client->request('DELETE', $url, $data);
    }

    /**
     * Send HEAD request
     *
     * @param string $url
     * @param array $data
     */
    public function sendHEAD($url, $data = [])
    {
        $this->client->request('HEAD', $url, $data);
    }

    /**
     * Send PATCH request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPATCH($url, $data = [])
    {
        $this->client->request('PATCH', $url, $data);
    }

    /**
     * Send OPTIONS request
     *
     * @param string $url
     * @param array $data
     */
    public function sendOPTIONS($url, $data = [])
    {
        $this->client->request('OPTIONS', $url, $data);
    }
}
