<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Division extends Model
{
    protected $table = 'division';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'Division',
    ];

    public function districts()
    {
        return $this->hasMany(District::class, 'DID', 'ID');
    }
}

// District Model
class District extends Model
{
    protected $table = 'district';
    protected $primaryKey = 'DesID';

    protected $fillable = [
        'district',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'DID', 'ID');
    }

    public function thanas()
    {
        return $this->hasMany(Thana::class, 'Des_ID', 'DesID');
    }
}

// Thana Model
class Thana extends Model
{
    protected $table = 'thana';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'thana',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'Des_ID', 'DesID');
    }
}
