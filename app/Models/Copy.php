<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    public const STATUS_EXIST     = 0;
    public const STATUS_NOT_EXIST = 1;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static $statuses = [
        self::STATUS_EXIST     => 'Exist',
        self::STATUS_NOT_EXIST => 'Not exist',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
