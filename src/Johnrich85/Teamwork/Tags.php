<?php  namespace Johnrich85\Teamwork;

use Johnrich85\Teamwork\Traits\TimeTrait;
use Johnrich85\Teamwork\Traits\RestfulTrait;

class Tags extends AbstractObject {
    protected $endpoint = '/projects/api/v3/tags';
    public function all($args = null)
    {
        return $this->client->get($this->endpoint, $args)->response();
    }
}
