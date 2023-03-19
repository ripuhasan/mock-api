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
            $input_arrays = preg_split("/[\s,]+/", $request->input_field);
            $con = '"';
            $field = [];
            $faker = '$faker->';
            $req = '$request->';
            $var_faker = '$faker';
            $data_index = '$data[$index]';
            $input_field = [];
            $update_field = [];

            foreach($input_arrays as $key => $array){
                  $input = $array;
                  $fi = $con.$input.$con. ' => ' .$faker.$input;
                  array_push($field, $fi);
                  $field_input = $con.$input.$con. ' => ' .$req.$input;
                  array_push($input_field, $field_input);
                  $field_update = $data_index.'['.$con.$input.$con.']'. ' = ' .$req.$input;
                  array_push($update_field, $field_update);
              }
      
              $final_field = implode(', ', $field);
              $final_input_field = implode(', ', $input_field);
              $final_update_field = implode('; ', $update_field);

                $index = '$index';
                $json_data = '$json_data';
                $e = '$e';
      
              $model_controller = str_replace(" ", "", $request->model);
              $id = '$id';
              $modelName = $model_controller.'Controller';
              $req = '$request';
              $how_many_data = $request->how_many_data;
              
              $jsonData = '$jsonData';
              $i = '$i';
              $model_url = Str::plural(strtolower(str_replace(" ", "", $request->model)));

            $record = '$record';
            $data = '$data';
            $array_data = '$data[]';
            $new_data = '$new_data';
            $da = '$da';
            $data_array = '$data[$id';
            $json_string = '$json_string';
            $unset = 'Unset($data[0]);';

            $var_url = '$'.$model_url;

        $controllerMake = fopen("../app/Http/Controllers/Api/{$model_controller}Controller.php", "w") or die("Unable to open file!");
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
            if (file_exists('{$model_url}_{$db_id}.json')) {
                $da = file_get_contents('{$model_url}_{$db_id}.json');
                $da = json_decode($da);
                
                return response()->json($da);
            }
            
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
            try{
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

                return response()->json([
                    $con success $con => true,
                    $con message $con => $con Store success $con,
                    $con data $con => $new_data
                ]);
            }catch(\Exception $e){
                return response()->json([
                    $con success $con => false,
                    $con message $con => $con Store fail! $con, $e,
                    $con data $con => $new_data
                ]);
            }

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
                return response()->json($record);
            } else {
                return response()->json([
                    $con success $con => false,
                    $con message $con => $con No data found! $con
                ]);
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
            try{
                // Load JSON file contents into a string variable
                $json_string = file_get_contents('{$model_url}_{$db_id}.json');

                // Convert JSON string to a PHP associative array
                $data = json_decode($json_string, true);

                // Remove element at index 0
                $unset

                // Define the index of the object to update
                $index = $id;

                // Update the object with new data
                $final_update_field;

                // Convert the updated data back to JSON
                $json_data = json_encode($data, JSON_PRETTY_PRINT);

                // Write the updated JSON data back to the file
                file_put_contents('{$model_url}_{$db_id}.json', $json_data);
                return response()->json([
                    $con success $con => true,
                    $con message $con => $con Update success $con
                ]);
            }catch(\Exception $e){
                return response()->json([
                    $con success $con => false,
                    $con message $con => $con Update fail! $con, $e
                ]);
            }
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            try{
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

                return response()->json([
                    $con success $con => true,
                    $con message $con => $con Delete success $con
                ]);
            }catch(\Exception $e){
                return response()->json([
                    $con success $con => false,
                    $con message $con => $con Delete fail! $con, $e
                ]);
            }

        }
    }
        
        ";
        fwrite($controllerMake, $controllerText);
        fclose($controllerMake);

      }



}