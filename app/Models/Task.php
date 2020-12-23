<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name', 'urgency', 'description', 'start_date', 'finish_date', 'finish_time', 'responsible', 'number_of_executors', 'column_id'];
}
