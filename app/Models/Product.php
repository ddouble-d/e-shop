<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'user_id',
        'sku',
        'type',
        'name',
        'slug',
        'price',
        'weight',
        'length',
        'width',
        'height',
        'short_description',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productInventory()
    {
        return $this->hasOne(ProductInventory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function variants()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function productAttributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public static function statuses()
    {
        return [
            0 => 'Draft',
            1 => 'Active',
            2 => 'Inactive'
        ];
    }

    function status_label()
    {
        $statuses = $this->statuses();
        return isset($this->status) ? $statuses[$this->status] : null;
    }

    public static function types()
    {
        return [
            'simple' => 'Simple',
            'configurable' => 'Configurable'
        ];
    }
}
