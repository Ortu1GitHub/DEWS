<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjects;

class SubjectsController extends Controller
{
    //
    
     public function getAll(Request $request){
        // Usar Eloquent para obtener todas las asignaturas
        $subjects = Subjects::all();
    
        return response()->json([
            'success' => true,
            'message' => "Obtengo todas las asignaturas desde el controller",
            'data' => $subjects
        ]);
    }

public  function getById (Request $request,$id){
   // Usar Eloquent para buscar una asignatura por su ID
   $subject = Subjects::find($id);

         // Verificar si la asignatura existe
         if (!$subject) {
            return response()->json([
                'success' => false,
                'message' => "No existe la asignatura con ID: $id"
            ], 404);
        }

   return response()->json([
       'success' => true,
       'message' => "Obtengo una asignatura concreta desde el controller con id: $id",
       'data' => $subject,
   ]);
}

public  function delete (Request $request,$id){
    // Usar Eloquent para borrar una asignatura por su ID
    $subject=Subjects::find($id);

    // Verificar si la asignatura existe
   if (!$subject) {
    return response()->json([
        'success' => false,
        'message' => "No existe la asignatura con ID: $id"
    ], 404);
    }

    Subjects::find($id)->delete();
    
    return response()->json([
        'sucess'=> true,
        'message' => "Borro la asignatura desde el controller con id: " . $id,
    ]);
}

public  function create (Request $request){
    // Obtener los datos directamente del request
    $name = $request->input('name');
    $course = $request->input('course');
    $grade = $request->input('grade');

    // Insertar datos en la base de datos usando Eloquent
    Subjects::create([
        'name' => $name,
        'course' => $course,
        'grade' => $grade,
    ]);

    return response()->json([
    'sucess'=>true,
    'message' => "Inserto la asignatura nueva desde el controller",
    'status'=> 201
    ]);
}

public  function modifyById (Request $request,$id){   
   // Buscar la asignatura por su ID
   $subject = Subjects::find($id);

   // Verificar si el profesor existe
   if (!$subject) {
       return response()->json([
           'success' => false,
           'message' => "No existe la asignatura con ID: $id"
       ], 404);
   }

    // Obtener los datos directamente del request
    $subject->name = $request->input('name', $subject->name);
    $subject->course = $request->input('course', $subject->course);
    $subject->grade = $request->input('grade', $subject->grade);

   // Guardar los cambios
   $subject->save();

   return response()->json([
       'success' => true,
       'message' => "Modifico una asignatura concreta desde el controller con id: $id",
       'data' => $subject
   ]);
}
}
