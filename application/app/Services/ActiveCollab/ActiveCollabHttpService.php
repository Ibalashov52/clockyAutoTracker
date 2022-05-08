<?php

namespace App\Services\ActiveCollab;

use ActiveCollab\SDK\Authenticator\SelfHosted;
use ActiveCollab\SDK\Client;

class ActiveCollabHttpService
{
//$tasks = $client->get('projects/89/tasks');

    private $auth;
    private $token;
    private $client;

    public function __construct()
    {
        $this->auth = new SelfHosted(
            config('ac.org_name'),
            config('ac.app_name'),
            config('ac.email'),
            config('ac.password'),
            config('ac.url')
        );

        $this->token = $this->auth->issueToken();
        $this->client = new Client($this->token);
    }

    public function getProjects()
    {
        return json_decode($this->client->get('projects/')->getBody(), true);
    }

    public function getTags()
    {
        return json_decode($this->client->get('job-types/')->getBody(), true);
    }

    public function getTasks($projectId)
    {
        return json_decode($this->client->get('projects/' . $projectId . '/tasks')->getBody(), true);
    }

    public function getTask($projectId, $taskId)
    {
        return json_decode($this->client->get('projects/' . $projectId . '/tasks/' . $taskId)->getBody(), true);
    }

//    public function timeRecord($projectId, $taskId, $time, $options)
//    {
//        return json_decode($this->client->post('projects/' . 79, [
//            'value' => '00:10',
//            'user_id' => '36',
//            'task_id' => '13389',
////            'description' => 'Это первый автоматически созданный трек времени',
//            'job_type_id' => 3,
//            'record_date' => now()->format('YYYY-MM-DD'),
//            'billable_status' => true
//        ])->getBody(), true);
//    }

    public function createTimeRecord(
//        $projectId,
//        $taskId,
//        $userId,
//        $jobTypeId,
//        $value,
//        $recordDate,
//        $summary = null,
        $value,
        $summary
    )
    {
        $data = [
            'task_id' => '13389',
            'user_id'     => 36,
            'job_type_id' => 3,
            'value'       => $value,
            'record_date' => now(),
            'summary' => $summary,
        ];
//        isset($summary) && $data['summary'] = $summary;

        return json_decode($this->client->post("projects/79/time-records", $data)->getBody(), true);
    }

    public function getUsers()
    {
        return json_decode($this->client->get('users/')->getBody(), true);
    }
}
