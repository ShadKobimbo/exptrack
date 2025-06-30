<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Shop extends Model
{
    /** @use HasFactory<\Database\Factories\ShopFactory> */
    use HasFactory;

    protected $fillable = ['name', 'location'];

    /* Get all of the expenses for the Shop
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function expeses(): HasMany
   {
       return $this->hasMany(Expense::class, 'foreign_key', 'local_key');
   }
}
