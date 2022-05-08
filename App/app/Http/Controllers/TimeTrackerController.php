<?php

namespace App\Http\Controllers;

use ActiveCollab\SDK\Authenticator\Cloud;
use ActiveCollab\SDK\Authenticator\SelfHosted;
use ActiveCollab\SDK\Client;
use App\Actions\TimeEntries\GetTimeEntries;
use App\Actions\TimeEntries\TimeEntriesSync;
use App\Models\TimeEntrie;
use App\Services\ActiveCollab\ActiveCollabHttpService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Clockify\ClockifyHttpService;

class TimeTrackerController extends Controller
{
    /**
     * @group Тайм трекер
     *
     * @return void
     */
    public function index(
        TimeEntrie     $entrie,
        GetTimeEntries $action
    )
    {
        return view('pages.time-tracker', ['data' => $action->handle($entrie)]);
    }

    public function sync(
        TimeEntriesSync     $entriesSync,
        ClockifyHttpService $clockifyHttpService
    )
    {
        $entriesSync->handle($clockifyHttpService);
        return redirect()->back();
    }

    public function track(
        TimeEntrie              $entrie,
        ActiveCollabHttpService $activeCollabHttpService
    )
    {
        $activeCollabHttpService->createTimeRecord(
            Carbon::parse($entrie->value)->format('H:i'),
            $entrie->description
        );

        $entrie->update([
            'is_sync' => true
        ]);

        return redirect()->back();
    }
}
