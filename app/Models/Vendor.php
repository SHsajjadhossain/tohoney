<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Vendor extends Model
{
    use HasFactory;
    public function relationTouser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
