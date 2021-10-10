<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table   = "account_tb";
    protected $guarded = ["id","created_at","updated"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
