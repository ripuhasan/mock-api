<?php

    namespace App\Http\Controllers\Api;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Faker\Factory as Faker;
    
    class BlogController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $faker = Faker::create();

            $blogs = [];

            for ($i = 0; $i < 10; $i++) {
                $blogs[] = [
                    "name" => $faker->name, "title" => $faker->title, "text" => $faker->text
                ];
            }

            // Convert the data to JSON format
            $jsonData = json_encode($blogs);

            // Save the JSON data to a file
            file_put_contents('blogs_3.json', $jsonData);

            $da = file_get_contents('blogs_3.json', $jsonData);
            $da = json_decode($da);
            return response()->json($da);
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            // Load JSON file contents into a string variable
            $json_string = file_get_contents('blogs_3.json');

            // Convert JSON string to a PHP array
            $data = json_decode($json_string, true);

            // Add new data to array
            $new_data = [
                "name" => $request->name, "title" => $request->title, "text" => $request->text
            ];
            $data[] = $new_data;

            // Convert PHP array to JSON string
            $json_string = json_encode($data);

            // Write JSON string to file
            file_put_contents('blogs_3.json', $json_string);
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
            $json_string = file_get_contents('blogs_3.json');

            // Convert JSON string to a PHP associative array
            $data = json_decode($json_string, true);

            // Remove element at index 0
            Unset($data[0]);

            // Access specific ID in associative array, avoiding index 0
            $id = $id;
            if (isset($data[$id]) && $id !== 0) {
                $record = $data[$id - 1];

                // Do something with the record
                return $record;
            } else {
                // Handle case where record doesn't exist or has index 0
            }
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
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
            $json_string = file_get_contents('blogs_3.json');

            // Convert JSON string to a PHP associative array
            $data = json_decode($json_string, true);

            // Remove specific element from associative array
            $id = $id;
            Unset($data[$id]);

            // Convert updated associative array back to JSON format
            $json_string = json_encode($data);

            // Save updated JSON string to file
            file_put_contents('blogs_3.json', $json_string);
        }
    }
        
        