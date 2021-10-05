<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    protected $table = "catatans";
    protected $primaryKey = "id";

    public $timestamps = true;
}
