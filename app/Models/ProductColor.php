<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_colors';
    protected $fillable = [
        'product_id',
        'color_id',
        'quantity',
    ];

    public function color(): BelongsTo
    {
        return $this->belongsTo(Colors::class, 'color_id', 'id');
    }
}
