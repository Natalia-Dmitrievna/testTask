<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeer extends Model
{
    protected $table    = 'employeer';
    public $timestamps  = false;
    protected $fillable = ['fname', 'sname', 'pname', 'department_id'];
}
