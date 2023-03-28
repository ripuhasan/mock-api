<?php

use Illuminate\Support\Str;
use Faker\Factory as Faker;

class GenerateFile{

      public static function generateApi($request)
      {
        $apiRoute = fopen("../routes/api.php", "a") or die("Unable to open file!");
        
        if($request->method == 'get'){
            $controller = '[App\Http\Controllers\Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class, "index"]';
            $routeTest = "Route::get('$request->url', $controller);\n";
        }elseif($request->method == 'put'){
            $controller = '[App\Http\Controllers\Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class, "update"]';
            $routeTest = "Route::put('$request->url/{id}', $controller);\n";
        }elseif($request->method == 'get_view'){
            $controller = '[App\Http\Controllers\Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class, "show"]';
            $routeTest = "Route::get('$request->url/{id}', $controller);\n";
        }elseif($request->method == 'post'){
            $controller = '[App\Http\Controllers\Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class, "store"]';
            $routeTest = "Route::post('$request->url', $controller);\n";
        }elseif($request->method == 'delete'){
            $controller = '[App\Http\Controllers\Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class, "destroy"]';
            $routeTest = "Route::delete('$request->url/{id}', $controller);\n";
        }else{
            $controller = 'Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class';
            $routeTest = "Route::$request->method('$request->url', $controller);\n";
        }
            
            fwrite($apiRoute, $routeTest);
            fclose($apiRoute);
      }

      public static function generateApiController($request, $db)
      {
          $input_arrays = $request->input_field;
          if(!$request->type){
                $input_arrays = preg_split("/[\s,]+/", $request->input_field);
            }

            $con = '"';
            $data_index = '$data[$index]';

            $field = [];
            $input_field = [];
            $update_field = [];

            if($request->type){
                $input_data = $request->type;
            }

            foreach($input_arrays as $key => $array){
                
                $type = $array;

                if($request->type){
                    $type = Str::slug($input_data[$key], '_');
                }
                
                $input = $array;

                $fi = $con.$type.$con. '=>'.$input;
                array_push($field, $fi);

                $field_input = $con.$type.$con. ' => ' .'$request->'.$input;
                array_push($input_field, $field_input);

                $field_update = $data_index.'['.$con.$type.$con.']'. ' = '.'$request->'.$input;
                array_push($update_field, $field_update);
            }
      
            $final_field = implode(', ', $field);
            $final_input_field = implode(', ', $input_field);
            $final_update_field = implode('; ', $update_field);

            //uc first
            $modelName = ucfirst(str_replace(" ", "", $request->model)).'Controller';
            $how_many_data = $request->how_many_data;

            //Str lower & plural
            $model_url = Str::plural(strtolower(str_replace(" ", "", $request->model)));

            //Fake data generate
            $fakeData = Self::generateFackData($how_many_data, $final_field);
            // Convert the data to JSON format
            $jsonData = json_encode($fakeData);

            $fileUrl = public_path('json_data\\'.$model_url.'_'.$db->id.'.json');
            // Save the JSON data to a file
            file_put_contents($fileUrl, $jsonData);


        $controllerMake = fopen("../app/Http/Controllers/Api/{$modelName}.php", "w") or die("Unable to open file!");
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
            if (file_exists('json_data/{$model_url}_{$db->id}.json')) {
                \$data = file_get_contents('json_data/{$model_url}_{$db->id}.json');
                \$data = json_decode(\$data);
                
                return response()->json(\$data);
            }
            return response()->json([
                'success' => false,
                'message' => 'File could not found!'
            ]);
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  \$request
         * @return \Illuminate\Http\Response
         */
        public function store(Request \$request)
        {
            try{
                // Load JSON file contents into a string variable
                \$json_string = file_get_contents('json_data/{$model_url}_{$db->id}.json');

                // Convert JSON string to a PHP array
                \$data = json_decode(\$json_string, true);

                // Add new data to array
                \$new_data = [
                    $final_input_field
                ];
                \$data[] = \$new_data;

                // Convert PHP array to JSON string
                \$json_string = json_encode(\$data);

                // Write JSON string to file
                file_put_contents('{$model_url}_{$db->id}.json', \$json_string);

                return response()->json([
                    $con success $con => true,
                    $con message $con => $con Store success $con,
                    $con data $con => \$new_data
                ]);
            }catch(\Exception \$e){
                return response()->json([
                    $con success $con => false,
                    $con message $con => $con Store fail! $con, \$e,
                    $con data $con => \$new_data
                ]);
            }

        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  \$id
         * @return \Illuminate\Http\Response
         */
        public function show(\$id)
        {
            // Load JSON file contents into a string variable
            \$json_string = file_get_contents('json_data/{$model_url}_{$db->id}.json');

            // Convert JSON string to a PHP associative array
            \$data = json_decode(\$json_string, true);

            // Remove element at index 0
            Unset(\$data[0]);

            // Access specific ID in associative array, avoiding index 0
            
            if (isset(\$data[\$id]) && \$id !== 0) {
                \$record = \$data[\$id - 1];

                // Do something with the record
                return response()->json(\$record);
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
         * @param  \Illuminate\Http\Request  \$request
         * @param  int  \$id
         * @return \Illuminate\Http\Response
         */
        public function update(Request \$request, \$id)
        {
            try{
                // Load JSON file contents into a string variable
                \$json_string = file_get_contents('json_data/{$model_url}_{$db->id}.json');

                // Convert JSON string to a PHP associative array
                \$data = json_decode(\$json_string, true);

                // Remove element at index 0
                Unset(\$data[0]);

                // Define the index of the object to update
                \$index = \$id;

                // Update the object with new data
                $final_update_field;

                // Convert the updated data back to JSON
                \$json_data = json_encode(\$data, JSON_PRETTY_PRINT);

                // Write the updated JSON data back to the file
                file_put_contents('{$model_url}_{$db->id}.json', \$json_data);
                return response()->json([
                    $con success $con => true,
                    $con message $con => $con Update success $con
                ]);
            }catch(\Exception \$e){
                return response()->json([
                    $con success $con => false,
                    $con message $con => $con Update fail! $con, \$e
                ]);
            }
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  \$id
         * @return \Illuminate\Http\Response
         */
        public function destroy(\$id)
        {
            try{
                // Load JSON file contents into a string variable
                \$json_string = file_get_contents('json_data/{$model_url}_{$db->id}.json');

                // Convert JSON string to a PHP associative array
                \$data = json_decode(\$json_string, true);

                // Remove specific element from associative array
                
                Unset(\$data[\$id]);

                // Convert updated associative array back to JSON format
                \$json_string = json_encode(\$data);

                // Save updated JSON string to file
                file_put_contents('{$model_url}_{$db->id}.json', \$json_string);

                return response()->json([
                    $con success $con => true,
                    $con message $con => $con Delete success $con
                ]);
            }catch(\Exception \$e){
                return response()->json([
                    $con success $con => false,
                    $con message $con => $con Delete fail! $con, \$e
                ]);
            }

        }
    }
        
        ";
        fwrite($controllerMake, $controllerText);
        fclose($controllerMake);

      }

    public static function generateFackData($how_many_data, $final_field)
    {
        $faker = Faker::create();

        $data = [];

        $fields = explode(',', $final_field);

        for ($i = 0; $i < $how_many_data; $i++) {
            $row = [];
            foreach ($fields as $field) {
                [$key, $value] = explode('=>', $field);
                $row[$key] = $faker->$value;
            }
            $data[] = $row;
        }
        return $data;
    }


}