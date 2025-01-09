<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    //
    public  function getAll (Request $request){
            $students=DB::table('students')->get();
            return response()->json([
            'sucess'=> true,
            'message' => "Obtengo todas los alumnos desde el controller",
            'data'=>$students
        ]);
    }

    public  function getById (Request $request,$id){
        $student=DB::table('students')->where('id',$id)->get();
        return response()->json([
        'sucess'=> true,
        'message' => "Obtengo un alumno concreto desde el controller con id: " . $id,
        'data'=>$student
    ]);
}

    public  function delete (Request $request,$id){
        DB::table('students')->where('id',$id)->delete();
        return response()->json([
            'sucess'=> true,
            'message' => "Borro el alumno desde el controller con id: " . $id,
        ]);
    }

    public  function create (Request $request){
        //Validaciones de Laravel
         $request->validate([
            'name' => 'required|string|max:32',
            'phone' => 'nullable|string|max:16',
            'age' => 'nullable|integer|min:1|max:120',
            'pass' => 'required|string',
            'email' => 'required|string|max:64|unique:students,email', 
            'gender' => 'nullable|string|size:1',
        ]);

        // Obtener los datos directamente del request
        $name = $request->input('name');
        $phone = $request->input('phone');
        $age = $request->input('age');
        $pass = $request->input('pass');
        $email = $request->input('email');
        $gender = $request->input('gender');

        // Insertar datos en la base de datos usando Query Builder
        DB::table('students')->insert([
            'name' => $name,
            'phone' => $phone,
            'age' => $age,
            'pass' => $pass,
            'email' => $email,
            'gender' => $gender,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(
    [
        'sucess'=>true,
        'message' => "Añado el alumno desde el controller",
        'status'=> 201
    ]);
    }

    public  function modifyById (Request $request,$id){
        //Validaciones de Laravel
         $request->validate([
            'name' => 'required|string|max:32',
            'phone' => 'nullable|string|max:16',
            'age' => 'nullable|integer|min:1|max:999',
            'pass' => 'required|string',
            'email' => 'required|string|max:64|unique:students,email', 
            'gender' => 'nullable|string|size:1',
        ]);
             // Obtener los datos directamente del request
             $name = $request->input('name');
             $phone = $request->input('phone');
             $age = $request->input('age');
             $pass = $request->input('pass');
             $email = $request->input('email');
             $gender = $request->input('gender');
             
        $studentModified=DB::table('students')->where('id',$id)->update([
            'name' => $name,
            'phone' => $phone,
            'age' => $age,
            'pass' => $pass,
            'email' => $email,
            'gender' => $gender,
            'created_at' => now(),
            'updated_at' => now(),
    ]);
        return response()->json([
        'sucess'=> true,
        'message' => "Modifico un alumno concreto desde el controller con id: " . $id,
        'data'=>$studentModified
    ]);
    }
}
