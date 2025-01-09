COMANDOS UTILIZADOS

C:\xampp\htdocs\laravel\prueba.laravel> php artisan serve
// Levanta el servidor

C:\xampp\htdocs\laravel\prueba.laravel>php artisan make:controller StudentsController
// Genera el controlador StudentsController

php artisan make:migration create_students_table
//Genera la migracion 2025_01_06_170742_create_students_table.php

php artisan migrate
//Ejecuta todas las migraciones

C:\xampp\htdocs\laravel\prueba.laravel>php artisan make:seeder StudentsSeeder
//Genera el seeder StudentsSeeder

C:\xampp\htdocs\laravel\prueba.laravel>php artisan db:seed --class=StudentsSeeder
//Ejecuta StudentsSeeder

C:\xampp\htdocs\laravel\prueba.laravel> php artisan make:middleware ValidateStudentId
// Genera el middleware ValidateStudentId

C:\xampp\htdocs\laravel\prueba.laravel> php artisan optimize:clear
//Limpia caché , temporales ,etc







