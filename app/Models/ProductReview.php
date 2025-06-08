<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $table = 'product_reviews';
    protected $guarded = ['id'];

    protected $fillable = ['product_id', 'user_id', 'point', 'review'];

    protected $casts = [
        'point' => 'float', // atau 'integer' jika hanya bulat
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
