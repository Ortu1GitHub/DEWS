COMANDOS UTILIZADOS PARA INSTALAR PASSPORT

PS C:\xampp\htdocs\DWES\Prueba> php artisan passport:install --force

   INFO  Encryption keys generated successfully.

   INFO  Publishing [passport-migrations] assets.  

  Copying directory [C:\xampp\htdocs\DWES\Prueba\vendor\laravel\passport\database\migrations] to [C:\xampp\htdocs\DWES\Prueba\database\migrations]  DONE

 Would you like to run all pending database migrations? (yes/no) [yes]:
 > yes

   INFO  Running migrations.  

  2025_01_28_204057_create_oauth_access_tokens_table .................................................. 36.97ms DONE  
  2025_01_28_204058_create_oauth_refresh_tokens_table ................................................. 34.95ms DONE  
  2025_01_28_204059_create_oauth_clients_table ........................................................ 40.97ms DONE  
  2025_01_28_204100_create_oauth_personal_access_clients_table ........................................ 13.00ms DONE  

 Would you like to create the "personal access" and "password grant" clients? (yes/no) [yes]:
 > yes

   INFO  Personal access client created successfully.

  Client ID ...................................................................................................... 1  
  Client secret ........................................................... mQdoqw2AtiqCX8SlvEQ2tuQVZCSj81lJoDjmkwAB  

   INFO  Password grant client created successfully.

  Client ID ...................................................................................................... 2  
  Client secret ........................................................... hs4UhjmGFIPhB4HkzkAqjZ19dcBjUrtzX24Sy8B0  
PS C:\xampp\htdocs\DWES\Prueba> php artisan db:seed

   INFO  Seeding database.

  Database\Seeders\UsersSeeder ............................................................................. RUNNING  
  Database\Seeders\UsersSeeder ......................................................................... 374 ms DONE  

  Database\Seeders\StudentsSeeder .......................................................................... RUNNING  
  Database\Seeders\StudentsSeeder ....................................................................... 10 ms DONE  

  Database\Seeders\SchoolsSeeder ........................................................................... RUNNING  
  Database\Seeders\SchoolsSeeder ........................................................................ 15 ms DONE  

  Database\Seeders\TeachersSeeder .......................................................................... RUNNING  
  Database\Seeders\TeachersSeeder ....................................................................... 25 ms DONE  

  Database\Seeders\SubjectsSeeder .......................................................................... RUNNING  
  Database\Seeders\SubjectsSeeder ....................................................................... 31 ms DONE  

PS C:\xampp\htdocs\DWES\Prueba> 






