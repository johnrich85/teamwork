<?php  namespace Johnrich85\Teamwork;

use Johnrich85\Teamwork\Traits\RestfulTrait;

class Time extends AbstractObject {

    use RestfulTrait;

    protected $wrapper  = 'time-entry';

    protected $endpoint = 'time_entries';

    /**
     * GET /time_entries.json
     *
     * @return mixed
     */
    public function all($args = null)
    {
        $this->areArgumentsValid($args, ['page']);

        return $this->client->get($this->endpoint, $args)->response();
    }
}
