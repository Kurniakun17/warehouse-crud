<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'type', // in/out
        'quantity',
        'date',
        'description'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
