<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "products";

    /**
     * Fields
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'weight',
        'height',
        'length',
        'width',
        'description',
        'color',
        'material',
        'avatar',
        'images'
    ];

    public function setImagesAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['images'] = json_encode($pictures);
        }
    }

    public function getImagesAttribute($pictures)
    {
        return json_decode($pictures, true);
    }
}
