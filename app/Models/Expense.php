<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'shop_id', 
        'account_debited',
        'supplier_paid', 
        'supplier_contact', 
        'amount', 
        'transaction_number',
        'evidence_path'
    ];
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function shop(): BelongsTo{
        return $this->belongsTo(Shop::class);
    }
}
