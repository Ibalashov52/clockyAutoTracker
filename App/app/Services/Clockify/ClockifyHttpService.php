<?php

namespace App\Services\Clockify;

use App\Services\Guzzle\GuzzleHttpService;
use GuzzleHttp\Client;

class ClockifyHttpService
{
    private $client;
    private string $url;
    private string $workspace;
    private string $userId;
    private string $apiKey;

    public function __construct(GuzzleHttpService $client)
    {
        $this->client = $client;
        $this->url = config('clockify.base_url');
        $this->workspace = config('clockify.workspace');
        $this->userId = config('clockify.user_id');
        $this->apiKey = config('clockify.api_key');
    }

    public function getTimeEntries()
    {
        $entries = $this->client->get(
            $this->url . '/workspaces/' . $this->workspace . '/user/' . $this->userId . '/time-entries',
            [
                'headers' => [
                    'X-Api-Key' => config('clockify.api_key'),
                ],
            ]);

        return $entries;
    }

    public function getTagName($tagId): string
    {
        $tag = $this->client->get(
            $this->url . '/workspaces/' . $this->workspace . '/tags/' . $tagId,
            [
                'headers' => [
                    'X-Api-Key' => config('clockify.api_key'),
                ],
            ]
        );

        return $tag['name'];
    }

    public function getProjectName($projectId): string
    {
        $project = $this->client->get(
            $this->url . '/workspaces/' . $this->workspace . '/projects/' . $projectId,
            [
                'headers' => [
                    'X-Api-Key' => config('clockify.api_key'),
                ],
            ]
        );

        return $project['name'];
    }

    public function setProject($name)
    {
        try {
            $created = $this->client->post(
                $this->url . '/workspaces/' . $this->workspace . '/projects',
                [
                    'headers' => [
                        'X-Api-Key' => config('clockify.api_key'),
                    ],
                    'json' => [
                        'name' => $name,
                        'clientId' => '',
                        'isPublic' => false,
                        'color' => '#f44336',
                        'note' => '',
                        'billable' => true,
                        'public' => false
                    ]
                ]
            );
        } catch (\Throwable $e) {

        }

        return 'ok';
    }

    public function setTag($name)
    {
        try {
            $created = $this->client->post(
                $this->url . '/workspaces/' . $this->workspace . '/tags',
                [
                    'headers' => [
                        'X-Api-Key' => config('clockify.api_key'),
                    ],
                    'json' => [
                        'name' => $name,
                    ]
                ]
            );
        } catch (\Throwable $e) {

        }

        return 'ok';
    }
}
