<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'Media';

    // Define the fillable attributes to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'logo',
        'address',
        'whatsapp',
        'facebook',
        'instagram',
        'twitter',
        'mobile',
    ];
    

    // Define relationships, for example, a Media has many Media images
   
}
