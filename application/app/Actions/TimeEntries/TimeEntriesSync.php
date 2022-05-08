<?php

namespace App\Actions\TimeEntries;

use App\Models\TimeEntrie;
use App\Services\Clockify\ClockifyHttpService;
use Carbon\Carbon;

class TimeEntriesSync
{
    public function handle(ClockifyHttpService $clock)
    {
        $entriesData = [];

        //TODO Заменить на upsert
        foreach ($clock->getTimeEntries() as $entries) {
            TimeEntrie::query()->updateOrInsert([
                'time_tracker_entries_id' => $entries['id'],
                'value'                   => Carbon::parse($entries['timeInterval']['end'])
                    ->diff(Carbon::parse($entries['timeInterval']['start']))
                    ->format('%H:%I:%S'),
                'description'             => $entries['description'],
            ], [
                'time_tracker_entries_id' => $entries['id'],
            ]);
        }
    }
}
