<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = "users";
    protected $primaryKey = "id";

    public $timestamps = true;
    public $incrementing = true;
}
