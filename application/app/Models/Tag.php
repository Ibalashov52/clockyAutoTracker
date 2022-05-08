<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

//    public function TimeEntries()
//    {
//        return $this->belongsToMany(TimeEntrie::class, 'time_entries_tags', 'time_entries_id');
//    }
}
