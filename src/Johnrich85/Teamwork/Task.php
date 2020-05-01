<?php  namespace Johnrich85\Teamwork;

use Johnrich85\Teamwork\Traits\TimeTrait;
use Johnrich85\Teamwork\Traits\RestfulTrait;

class Task extends AbstractObject {

    use RestfulTrait, TimeTrait;

    protected $wrapper  = 'task';

    protected $endpoint = 'tasks';

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
        $this->areArgumentsValid($args, ['filter', 'page', 'pageSize', 'startdate', 'enddate', 'updatedAfterDate', 'completedAfterDate', 'completedBeforeDate', 'showDeleted', 'includeCompletedTasks', 'includeCompletedSubtasks', 'creator-ids', 'include', 'responsible-party-ids', 'sort', 'getSubTasks', 'nestSubTasks', 'getFiles', 'dataSet', 'includeToday', 'ignore-start-date']);

        return $this->client->get($this->endpoint, $args)->response();
    }

    /*
     * Get a task
     */
    public function get()
    {
        return $this->client->get("$this->endpoint/$this->id", [])->response();
    }

    /**
     * Complete A Task
     * PUT tasks/{id}/complete.json
     *
     * @return mixed
     */
    public function complete()
    {
        return $this->client->put("$this->endpoint/$this->id/complete", [])->response();
    }

    /**
     * Uncomplete A Task
     * PUT tasks/{id}/uncomplete.json
     *
     * @return mixed
     */
    public function uncomplete()
    {
        return $this->client->put("$this->endpoint/$this->id/uncomplete", [])->response();
    }

    /**
     * Time Totals
     * GET /projects/{id}/time/total.json
     *
     * @return mixed
     */
    public function timeTotal()
    {
        return $this->client->get("$this->endpoint/$this->id/time/total")->response();
    }

    /**
     * Edit A Task
     * PUT tasks/{id}.json
     *
     * @return mixed
     */
    public function edit($args)
    {
        return $this->client->put("$this->endpoint/$this->id.json", ['todo-item' => $args])->response();
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
     * Add a reminder to a task
     * POST tasks/{id}/reminders.json
     * @param $args
     * @return mixed
     */
    public function addReminder($args)
    {
        $payload = ['reminder' => $args];
        $endpoint = "$this->endpoint/$this->id/reminders";

        return $this->client->post($endpoint, $payload)->response();
    }

    /**
     * Gets sub-tasks for a given
     * task ID
     *
     * GET tasks/{id}/subtasks.json
     *
     * @return mixed
     */
    public function subTasks() {
        return $this->client->get("$this->endpoint/$this->id/subtasks")->response();
    }

    /**
     * Create a subtask
     * POST tasks/{id}.json
     *
     * @return mixed
     */
    public function createSubTask($args) {
        return $this->client->post("$this->endpoint/$this->id", ['todo-item' => $args])->response();
    }
}
