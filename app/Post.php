<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //  protected $fillable = ['division', 'district','thana'];
     protected $fillable = ['userName','userEmail','userPhone','presentDivision','presentDistrict','presentThana','permanentDivision', 'permanentDistrict','permanentThana'];

}
