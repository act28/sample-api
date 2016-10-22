<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'libraries';

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = ['id', 'code', 'name', 'abbr', 'url'];

    /**
     * No timestamps
     *
     * @var bool
     */
    public $timestamps = false;
}