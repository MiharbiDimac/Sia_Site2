<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class UserJob extends Model{
    protected $table = 'jobs';
    protected $primaryKey = 'JobID';
    public $timestamps = false;
    // column sa table
     protected $fillable = [
        'JobID', 'JobName'
    ];
}