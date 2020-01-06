<?php

namespace App\Models\Ui;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $table="master";
    protected $fillable = [
        'title','icon', 'head','header','footer','scripts'
    ];
    public $timestamps=false;
}
