<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsGoal extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'amount', 'balance', 'achieved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
