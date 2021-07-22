<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructionalResource extends Model
{
    use HasFactory;

    protected $fillable = ['resource_type', 'file', 'subject', 'description'];
}
