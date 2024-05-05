<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TaskAssignment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assignedBy()
    {
        return $this->belongsTo('App\Models\User','assigned_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo('App\Models\User','assigned_to');
    }

    public function taskId()
    {
        return $this->belongsTo('App\Models\Tasks','task_id');
    }

    
}
