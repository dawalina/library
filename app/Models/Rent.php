<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    public const STATUS_ISSUED   = 0;
    public const STATUS_RETURNED = 1;
    public const STATUS_LOST     = 2;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'issued_at',
        'expire_at',
        'returned_at',
        'created_at',
        'updated_at',
    ];

    public static $statuses = [
        self::STATUS_ISSUED   => 'Issued',
        self::STATUS_RETURNED => 'Returned',
        self::STATUS_LOST     => 'Lost',
    ];

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

    public function copy()
    {
        return $this->belongsTo(Copy::class);
    }
}
