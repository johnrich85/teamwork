<?php  namespace Johnrich85\Teamwork;

use Johnrich85\Teamwork\Traits\TimeTrait;
use Johnrich85\Teamwork\Traits\RestfulTrait;

class Tasks extends AbstractObject {
    protected $endpoint = 'projects/api/v3/tasks';

    /**
     * Get All Tasks
     * GET /tasks.json
     *
     * @param null $args
     *
     * @return mixed
     */
    public function all($args = null)
    {
        return $this->client->get($this->endpoint, $args)->response();
    }

    public function get()
    {
        return $this->client->get("$this->endpoint/$this->id", [])->response();
    }

    /**
     * Uses v1
     *
     * PUT tasks/{id}/complete.json
     *
     * @return mixed
     */
    public function complete()
    {
        return $this->client->put("tasks/$this->id/complete", [])->response();
    }

    /**
     * Edit A Task
     * PATCH tasks/{id}.json
     *
     * @return mixed
     */
    public function edit($args)
    {
        return $this->client->patch("$this->endpoint/$this->id.json", $args)->response();
    }

    /**
     * Delete a task
     * DELETE tasks/{id}.json
     *
     * @return mixed
     */
    public function delete()
    {
        return $this->client->delete("$this->endpoint/$this->id.json")->response();
    }


    /**
     * Add a reminder to a task - uses v1
     *
     * POST tasks/{id}/reminders.json
     * @param $args
     * @return mixed
     */
    public function addReminder($args)
    {
        $payload = ['reminder' => $args];

        return $this->client->post("tasks/$this->id/reminders", $payload)->response();
    }

    /**
     * Uses v1
     *
     * GET tasks/{id}/subtasks.json
     *
     * @return mixed
     */
    public function subTasks() {
        return $this->client->get("tasks/$this->id/subtasks")->response();
    }

    /**
     * Create a subtask
     * POST tasks/{id}.json
     *
     * @return mixed
     */
    public function createSubTask($args) {
        return $this->client->post("$this->endpoint/$this->id/subtasks", $args)
            ->response();
    }
}
