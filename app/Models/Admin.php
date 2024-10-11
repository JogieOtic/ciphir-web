<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Admin extends Model
{
    use Notifiable;

    protected $table = 'Admin';  // Table name

    protected $primaryKey = 'Admin_ID';  // Correct primary key

    public $incrementing = true;  // If Admin_ID is auto-incrementing

    protected $keyType = 'int';  // Primary key type

    protected $fillable = ['Username', 'Password'];  // Fillable fields
}
