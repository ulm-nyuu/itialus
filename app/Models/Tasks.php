<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    // protected $appends = ['assigned_by','assigned_to'];


    public function createdBy()
    {
        return $this->belongsTo('App\Models\User','created_by','id');
    }

    public function getTasks(){
        return Tasks::select([
            'tasks.id',
            'cb.name as createdBy',
            'title',
            'description',
            'status',
            'ab.name as assignedBy',
            'at.name as assignedTo'
        ])
        ->join('users as cb', 'cb.id', '=', 'tasks.created_by')
        ->join('task_assignments', 'task_assignments.task_id', '=', 'tasks.id')
        ->leftJoin('users as ab', 'ab.id', '=', 'task_assignments.assigned_by')
        ->leftJoin('users as at', 'at.id', '=', 'task_assignments.assigned_to')
        ->get();
    }

    
}
