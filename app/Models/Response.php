<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    // Specify which attributes are mass assignable
    protected $fillable = ['form_id', 'submit_key', 'key', 'value'];

    // Define the relationship to the Form model
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
