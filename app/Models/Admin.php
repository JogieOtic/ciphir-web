<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{

    protected $table = 'Admin';  // Table name

    protected $primaryKey = 'Admin_ID';  // Correct primary key

    public $timestamps = false;

    protected $fillable = ['Username', 'Password', 'Role'];  // Fillable fields
}
