<?php 

// app/Models/ContactType.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    use HasFactory;

    protected $table = 'contact_types';

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['type'];
}
