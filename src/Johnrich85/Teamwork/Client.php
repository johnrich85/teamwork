<?php  namespace Johnrich85\Teamwork;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Psr7\Response;
use Johnrich85\Teamwork\Contracts\RequestableInterface;

class Client implements RequestableInterface {

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var Response
     */
    protected $response;

    /**
     * API Key
     *
     * The custom API key provided by Teamwork
     *
     * @var string
     */
    protected $key;

    /**
     * URL
     *
     * The URL that is set to query the Teamwork API.
     * This is the account URL used to access the project
     * management system. This is passed in on construct.
     *
     * @var string
     */
    protected $url;

    /**
     * Currently this package doesn't support XML
     * but overtime this would be part of that support
     *
     * @var string
     */
    protected $dataFormat = 'json';

    /**
     * @param Guzzle $client
     * @param        $key
     * @param        $url
     */
    public function __construct(Guzzle $client, $key, $url)
    {
        $this->client = $client;
        $this->key = $key;
        $this->url = $url;
    }

    /**
     * Get
     *
     * @param $endpoint
     *
     * @return Client
     */
    public function get($endpoint, $query = null)
    {
        $this->buildRequest($endpoint, 'GET', $query);

        return $this;
    }

    /**
     * Post
     *
     * @param $endpoint
     * @param $data
     *
     * @return Client
     */
    public function post($endpoint, $data)
    {
        return $this->buildRequest($endpoint, 'POST', $data);
    }

    /**
     * Put
     *
     * @param $endpoint
     * @param $data
     *
     * @return Client
     */
    public function put($endpoint, $data)
    {
        return $this->buildRequest($endpoint, 'PUT', $data);
    }

    /**
     * Delete
     *
     * @param $endpoint
     *
     * @return Client
     * @internal param $data
     *
     */
    public function delete($endpoint)
    {
        return $this->buildRequest($endpoint, 'DELETE');
    }

    /**
     * Build Request
     *
     * build up request including authentication, body,
     * and string queries if necessary. This is where the bulk
     * of the data is build up to connect to Teamwork with.
     *
     * @param $endpoint
     * @param $action
     * @param array $params
     * @return $this
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function buildRequest($endpoint, $action, $params = [])
    {
        $requestOptions = ['auth' => [$this->key, 'X']];

        if (!empty($params))
        {
            $requestOptions += $this->formatRequestParams($action, $params);
        }

        $this->response = $this->client->request(
            $action,
            $this->buildUrl($endpoint),
            $requestOptions
        );

        return $this;
    }

    /**
     * @param string $requestType
     * @param array $params
     * @return array
     */
    protected function formatRequestParams(string $requestType, $params = []) {
        $requestPart = 'query';

        if($requestType !== 'GET' ) {
            $requestPart = 'body';
            $params = json_encode($params);
        }

        return [
            $requestPart => $params
        ];
    }

    /**
     * Response
     *
     * this send the request from the built response and
     * returns the response as a JSON payload
     */
    public function response()
    {
        return json_decode($this->response->getBody(), true);
    }

    /**
     * Build Url
     *
     * builds the url to make the request to Teamwork with
     * and passes it into Guzzle. Also checks if trailing slash
     * is present.
     *
     * @param $endpoint
     *
     * @return string
     */
    public function buildUrl($endpoint)
    {
        if (filter_var($endpoint, FILTER_VALIDATE_URL))
        {
            return $endpoint . '.' . $this->dataFormat;
        }

        if (substr($this->url, -1) != '/')
        {
            $this->url = $this->url . '/';
        }

        return $this->url . $endpoint . '.' . $this->dataFormat;
    }

    public function getResponse() {
        return $this->response;
    }
}
