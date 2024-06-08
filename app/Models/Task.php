<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status_id',
        'user_id',
        'archived'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task_status(){
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }
}
