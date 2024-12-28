<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'product_images';

    // Define the fillable attributes for mass-assignment
    protected $fillable = [
        'product_id',
        'image',
    ];

    // Define the relationship between ProductImage and Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // If needed, you can define additional accessors or mutators for image paths
    public function getImageUrlAttribute()
    {
        return asset($this->image_path);
    }
}
