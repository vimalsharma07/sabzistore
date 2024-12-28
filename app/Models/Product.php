<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'products';

    // Define the fillable attributes to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'description',
        'meta_title',
        'image',
        'slug',
        'attributes',
        'meta_description',
        'meta_tags',
        'tags',
        'brand',
        'health',
        'price',
    ];

    // Define relationships, for example, a product has many product images
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    // If needed, you can define additional accessors or mutators for image paths
    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }
}
