<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class district extends Model
{

protected $table = 'district';
protected $primarykey = 'DesID';

protected $fillable = [
    'district',

];




public function thana(): BelongsTo
{
    return $this->belongsTo(thana::class, 'ID', 'Des_ID');
}




}
