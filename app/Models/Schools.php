<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schools extends Model
{
    //Para usar factories
    use HasFactory;
       
        protected $table = 'schools';

        // Si no deseas usar la convención de timestamps (created_at y updated_at)
        public $timestamps = true;
    
        // Definir los atributos que son asignables
        protected $fillable = ['name', 'location'];

        //Metodo directo
        public function teacher()
        {
        return $this->hasOne(Teachers::class,'schools_id');
        }

}
