<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\students_number_potrro;


class madrasha extends Model
{

protected $table= 'madrasha';
protected $primarykey = 'id';



public function students_number_potrro()
{
    return $this->hasMany(students_number_potrro::class, 'MID', 'id');
}


}
