<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subjects extends Model
{
    //
        //Para usar factories
        use HasFactory;
        protected $table = 'subjects';

        // Si no deseas usar la convención de timestamps (created_at y updated_at)
        public $timestamps = true;
    
        // Definir los atributos que son asignables
        protected $fillable = ['name', 'course','grade'];

}
