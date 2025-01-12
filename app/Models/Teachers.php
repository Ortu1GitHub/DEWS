<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teachers extends Model
{
    //
       //Para usar factories
       use HasFactory;

       protected $table = 'teachers';

        // Si no deseas usar la convención de timestamps (created_at y updated_at)
        public $timestamps = true;
    
        // Definir los atributos que son asignables
        protected $fillable = ['name', 'age','salary','school_id'];

        // Relación inversa 1:1 con Schools
        public function school()
        {
        return $this->belongsTo(Schools::class,'schools_id');
        }

        // Relación directa 1:N con Subjects
        public function subject()
        {
        return $this->hasMany(Subjects::class,'teachers_id');
        }
}
