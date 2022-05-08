<?php

namespace App\Actions\InitsAction;

use App\Services\ActiveCollab\ActiveCollabHttpService;
use App\Services\Clockify\ClockifyHttpService;

class InitProjects
{
    public function handle(ActiveCollabHttpService $ac, ClockifyHttpService $clockify)
    {
        $projects = $ac->getProjects();

        foreach ($projects as $project) {
            $clockify->setProject($project['name']);
        }
    }
}
