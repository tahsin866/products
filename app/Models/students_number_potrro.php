<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\student;
class students_number_potrro extends Model
{

    protected $fillable = [
        'Name',
        'BirthRegistrationNo_nid_no',
        'st_en_name',
        'Father',
        'mobileNumber',
        'st_en_Fname',
        'DateofBirth'
    ];




    protected $table = 'students_number_potrro';
    public $timestamps = false; // Add this if you don't have timestamp columns


public function student(): HasOne
 {

    return $this->hasOne(student::class, 'Roll', 'Roll')  // foreign key and local key
                ->where('years', $this->years);
 }
}
