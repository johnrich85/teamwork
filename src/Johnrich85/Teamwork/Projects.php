<?php  namespace Johnrich85\Teamwork;

use Johnrich85\Teamwork\Traits\TimeTrait;
use Johnrich85\Teamwork\Traits\RestfulTrait;

class Projects extends AbstractObject {
    protected $endpoint = '/projects/api/v3/projects';

    public function all(?array $projectIds = null)
    {
        $query = [];

        if($projectIds && count($projectIds)) {
            $query['projectIds'] = implode(",", $projectIds);
        }

        return $this->client->get($this->endpoint, $query)
            ->response();
    }
}
