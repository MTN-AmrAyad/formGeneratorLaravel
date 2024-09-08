<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['slug'];

    // A form has many responses
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
