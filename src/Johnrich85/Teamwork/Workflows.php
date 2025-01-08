<?php  namespace Johnrich85\Teamwork;

class Workflows extends AbstractObject {
    protected $endpoint = 'projects/api/v3/workflows';

    /**
     * Account Details
     * GET /account.json
     *
     * @link http://developer.teamwork.com/account
     * @return mixed
     */
    public function all(?array $projectIds = null)
    {
        $query = [];

        if($projectIds && count($projectIds)) {
            $query['projectIds'] = implode(",", $projectIds);
        }

        return $this->client->get($this->endpoint, $query)
            ->response();
    }

    /**
     * Authenticate Call
     * GET /authenticate.json
     *
     * @link http://developer.teamwork.com/account
     * @return mixed
     */
    public function stages()
    {
        return $this->client->get("$this->endpoint/{$this->id}/stages")->response();
    }
}
