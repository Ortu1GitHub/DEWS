<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schools;
use Illuminate\Support\Facades\Auth;

class SchoolsController extends Controller
{
    //
      //
      public function getAll(Request $request){
        // Usar Eloquent para obtener todas las escuelas
        $schools = Schools::all();
    
        return response()->json([
            'success' => true,
            'message' => "Obtengo todas las escuelas desde el controller",
            'data' => $schools
        ]);
    }

public  function getById (Request $request,$id){
   // Usar Eloquent para buscar una escuela por su ID
   $school = Schools::find($id);

      // Verificar si la escuela existe
      if (!$school) {
        return response()->json([
            'success' => false,
            'message' => "No existe la escuela con ID: $id"
        ], 404);
    }

   return response()->json([
       'success' => true,
       'message' => "Obtengo una escuela concreta desde el controller con id: $id",
       'data' => $school,
   ]);

}

public  function create (Request $request){
    // Obtener los datos directamente del request
    $name = $request->input('name');
    $location = $request->input('location');

    // Insertar datos en la base de datos usando Eloquent
    Schools::create([
        'name' => $name,
        'location' => $location,
    ]);

    return response()->json([
    'sucess'=>true,
    'message' => "Inserto la escuela nueva desde el controller",
    'status'=> 201
    ]);
}

public  function modifyById (Request $request,$id){   
   // Buscar la escuela por ID
   $school = Schools::find($id);

   // Verificar si la escuela existe
   if (!$school) {
       return response()->json([
           'success' => false,
           'message' => "No existe la escuela con ID: $id"
       ], 404);
   }

    // Obtener los datos directamente del request
    $school->name = $request->input('name', $school->name); 
    $school->location = $request->input('location', $school->location);
   // Guardar los cambios
   $school->save();

   return response()->json([
       'success' => true,
       'message' => "Modifico una escuela concreta desde el controller con id: $id",
       'data' => $school
   ]);
}

    public function getSchoolAndTeacher($id)
    {
            $school = Schools::with('teacher')->findOrFail($id);
            return response()->json($school);
    }

}
