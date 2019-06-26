<?php

use Mockery as m;
use Rossedman\Teamwork\Client;

class ClientTest extends PHPUnit_Framework_TestCase {

    protected $guzzle;

    public function setUp()
    {
        parent::setUp();
        $this->guzzle = m::mock('GuzzleHttp\Client');
    }

    public function tearDown()
    {
        m::close();
    }

    /**
     * @group client
     */
    public function test_it_builds_the_request()
    {
        $client = new Client($this->guzzle, 'key', 'http://teamwork.com');

        $this->guzzle
            ->shouldReceive('request')->once()
            ->with('GET', 'http://teamwork.com/packages.json', ['auth' => ['key', 'X'], 'query' => []])
            ->andReturn(m::mock(\GuzzleHttp\Psr7\Response::class));

        $returned = $client->buildRequest('packages', 'GET');

        $this->assertInstanceOf(Client::class, $returned);
        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $returned->getResponse());
    }

    /**
     * @group client
     */
    public function test_build_url()
    {
        $client = new Client($this->guzzle, 'key', 'http://teamwork.com/');

        $url = $client->buildUrl('test');

        $this->assertEquals('http://teamwork.com/test.json', $url);
    }

    /**
     * @group client
     */
    public function test_build_url_with_no_trailing_slash()
    {
        $client = new Client($this->guzzle, 'key', 'http://teamwork.com');

        $url = $client->buildUrl('test');

        $this->assertEquals('http://teamwork.com/test.json', $url);
    }

    /**
     * @group client
     */
    public function test_build_url_with_full_url()
    {
        $url = 'http://teamwork.com/authenticate/test/url';
        $expectedUrl = $url . '.json';
        $client = new Client($this->guzzle, 'key', 'http://teamwork.com');

        $actualUrl = $client->buildUrl($url);

        $this->assertEquals($expectedUrl, $actualUrl);
    }
}
