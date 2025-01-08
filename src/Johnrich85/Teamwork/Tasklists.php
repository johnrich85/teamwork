<?php  namespace Johnrich85\Teamwork;

use Johnrich85\Teamwork\Traits\RestfulTrait;

class Tasklists extends AbstractObject {
    protected $endpoint = 'projects/api/v3/tasklists';

    /**
     * GET /tasklists/{$id}.json
     * @return mixed
     */
    public function all()
    {
        return $this->client->get("$this->endpoint")
            ->response();
    }

    /**
     * Create Task
     * GET /tasklists/{id}/tasks.json
     *
     * @return mixed
     */
    public function createTask($data)
    {
        return $this->client->post("$this->endpoint/$this->id/tasks", $data)
            ->response();
    }
}
