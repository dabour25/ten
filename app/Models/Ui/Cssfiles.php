<?php

namespace App\Models\Ui;

use Illuminate\Database\Eloquent\Model;

class Cssfiles extends Model
{
    protected $table="css_files";
    protected $fillable = [
        'file_name','full_html',
    ];
    public $timestamps=false;
}
