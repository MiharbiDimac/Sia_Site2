<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class User extends Model{
    protected $table = 'employees';
    protected $primaryKey = 'EmployeeID';
    public $timestamps = false;
    // column sa table
     protected $fillable = [
        'EmployeeID', 'EmployeeName', 'JobID'
    ];
}