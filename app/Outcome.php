<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $table = "outcomes";
    protected $primaryKey = "id";

    public $timestamps = true;
}
