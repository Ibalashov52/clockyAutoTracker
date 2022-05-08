<?php

namespace App\Actions\TimeEntries;

use App\Models\TimeEntrie;

class GetTimeEntries
{
    public function handle(TimeEntrie $entrie)
    {
        return $entrie->with('tags')->orderBy('id', 'desc')->get();
    }
}
