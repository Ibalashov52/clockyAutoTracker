<?php

namespace App\Actions\InitsAction;

use App\Services\ActiveCollab\ActiveCollabHttpService;
use App\Services\Clockify\ClockifyHttpService;

class InitTags
{
    public function handle(ActiveCollabHttpService $ac, ClockifyHttpService $clockify)
    {
        $tags = $ac->getTags();

        foreach ($tags as $tag) {
            $clockify->setTag($tag['name']);
        }
    }
}
