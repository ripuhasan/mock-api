<?php

use Illuminate\Support\Str;

class GenerateFile{

      public static function generateApi($url, $controller)
      {
            $apiRoute = fopen("../routes/api.php", "a") or die("Unable to open file!");
            $routeTest = "Route::apiResource('$url', $controller);\n";
            fwrite($apiRoute, $routeTest);
            fclose($apiRoute);
      }

      public static function generateApiController($url, $controller, $request, $db_id)
      {
            $input_arrays = explode(", ", $request->input_field);
            $con = '"';
            $field = [];
            $faker = '$faker->';
            $req = '$request->';
            $var_faker = '$faker';
            $input_field = [];

            foreach($input_arrays as $key => $array){
                  $input = $array;
                  $fi = $con.$input.$con. ' => ' .$faker.$input;
                  array_push($field, $fi);
                  $field_input = $con.$input.$con. ' => ' .$req.$input;
                  array_push($input_field, $field_input);
              }
      
              $final_field = implode(', ', $field);
              $final_input_field = implode(', ', $input_field);
      
              $id = '$id';
              $modelName = $request->model.'Controller';
              $req = '$request';
              $how_many_data = $request->how_many_data;
              
              $jsonData = '$jsonData';
              $i = '$i';
              $model_url = Str::plural(strtolower($request->model));

            $record = '$record';
            $data = '$data';
            $array_data = '$data[]';
            $new_data = '$new_data';
            $da = '$da';
            $data_array = '$data[$id';
            $json_string = '$json_string';
            $unset = 'Unset($data[0]);';

            $var_url = '$'.$model_url;

        $controllerMake = fopen("../app/Http/Controllers/Api/{$request->model}Controller.php", "w") or die("Unable to open file!");
        $controllerText = "<?php

    namespace App\Http\Controllers\Api;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Faker\Factory as Faker;
    
    class {$modelName} extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $var_faker = Faker::create();

            $var_url = [];

            for ($i = 0; $i < $how_many_data; $i++) {
                {$var_url}[] = [
                    $final_field
                ];
            }

            // Convert the data to JSON format
            $jsonData = json_encode($var_url);

            // Save the JSON data to a file
            file_put_contents('{$model_url}_{$db_id}.json', $jsonData);

            $da = file_get_contents('{$model_url}_{$db_id}.json', $jsonData);
            $da = json_decode($da);
            return response()->json($da);
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $req
         * @return \Illuminate\Http\Response
         */
        public function store(Request $req)
        {
            // Load JSON file contents into a string variable
            $json_string = file_get_contents('{$model_url}_{$db_id}.json');

            // Convert JSON string to a PHP array
            $data = json_decode($json_string, true);

            // Add new data to array
            $new_data = [
                $final_input_field
            ];
            $array_data = $new_data;

            // Convert PHP array to JSON string
            $json_string = json_encode($data);

            // Write JSON string to file
            file_put_contents('{$model_url}_{$db_id}.json', $json_string);
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            // Load JSON file contents into a string variable
            $json_string = file_get_contents('{$model_url}_{$db_id}.json');

            // Convert JSON string to a PHP associative array
            $data = json_decode($json_string, true);

            // Remove element at index 0
            $unset

            // Access specific ID in associative array, avoiding index 0
            $id = $id;
            if (isset($data_array]) && $id !== 0) {
                $record = $data_array - 1];

                // Do something with the record
                return $record;
            } else {
                // Handle case where record doesn't exist or has index 0
            }
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $req
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $req, $id)
        {
            //
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            // Load JSON file contents into a string variable
            $json_string = file_get_contents('{$model_url}_{$db_id}.json');

            // Convert JSON string to a PHP associative array
            $data = json_decode($json_string, true);

            // Remove specific element from associative array
            $id = $id;
            Unset($data_array]);

            // Convert updated associative array back to JSON format
            $json_string = json_encode($data);

            // Save updated JSON string to file
            file_put_contents('{$model_url}_{$db_id}.json', $json_string);
        }
    }
        
        ";
        fwrite($controllerMake, $controllerText);
        fclose($controllerMake);

      }



}