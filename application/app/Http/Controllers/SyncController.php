<?php

namespace App\Http\Controllers;

use App\Actions\InitsAction\InitProjects;
use App\Actions\InitsAction\InitTags;
use App\Services\ActiveCollab\ActiveCollabHttpService;
use App\Services\Clockify\ClockifyHttpService;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function init(
        InitProjects $initProjectsAction,
        InitTags $initTagsAction,
        ActiveCollabHttpService $ac,
        ClockifyHttpService $clockify,
    )
    {
        $initProjectsAction->handle($ac, $clockify);
        $initTagsAction->handle($ac, $clockify);

        return redirect('time-tracker');
    }
}
