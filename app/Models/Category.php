<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "categories";

    /**
     * Fields
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'parent_id'
    ];
}
