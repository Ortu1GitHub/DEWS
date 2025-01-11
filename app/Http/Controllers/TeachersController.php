<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;

class TeachersController extends Controller
{
    //
    
     public function getAll(Request $request){
        // Usar Eloquent para obtener todos los profesores
        $teachers = Teachers::all();
    
        return response()->json([
            'success' => true,
            'message' => "Obtengo todos los profesores desde el controller",
            'data' => $teachers
        ]);
    }

public  function getById (Request $request,$id){
   // Usar Eloquent para buscar un profesor por su ID
   $teacher = Teachers::find($id);

   return response()->json([
       'success' => true,
       'message' => "Obtengo un profesor concreto desde el controller con id: $id",
       'data' => $teacher,
   ]);
}

public  function delete (Request $request,$id){
    // Usar Eloquent para borrar un profesor por su ID
    Teachers::find($id)->delete();
    
    return response()->json([
        'sucess'=> true,
        'message' => "Borro el profesor desde el controller con id: " . $id,
    ]);
}

public  function create (Request $request){
    // Obtener los datos directamente del request
    $name = $request->input('name');
    $age = $request->input('age');
    $salary = $request->input('salary');

    // Insertar datos en la base de datos usando Eloquent
    Teachers::create([
        'name' => $name,
        'age' => $age,
        'salary' => $salary,
    ]);

    return response()->json([
    'sucess'=>true,
    'message' => "Inserto el profesor nuevo desde el controller",
    'status'=> 201
    ]);
}

public  function modifyById (Request $request,$id){
   // Obtener los datos directamente del request
   //$name = $request->input('name');
   //$location = $request->input('location');
   
   // Buscar el profesor por ID
   $teacher = Teachers::find($id);

   // Verificar si el profesor existe
   if (!$teacher) {
       return response()->json([
           'success' => false,
           'message' => "No existe el profesor con ID: $id"
       ], 404);
   }

   // Guardar los cambios
   $teacher->save();

   return response()->json([
       'success' => true,
       'message' => "Modifico un profesor concreto desde el controller con id: $id",
       'data' => $teacher
   ]);
}
}
