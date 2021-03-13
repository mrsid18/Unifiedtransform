<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    //
    public function school()
    {
        return $this->belongsTo('App\School');
    }
    /**
    * Get the class record associated with the syllabus.
    */
    public function myclass()
    {
        return $this->belongsTo('App\Myclass','class_id');
    }
}
