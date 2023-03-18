<?php

    namespace App\Http\Controllers\Api;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Faker\Factory as Faker;
    
    class ContactController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $faker = Faker::create();

            $contacts = [];

            for ($i = 0; $i < 100; $i++) {
                $contacts[] = [
                    "name" => $faker->name, "email" => $faker->email, "phoneNumber" => $faker->phoneNumber, "country" => $faker->country, "state" => $faker->state, "city" => $faker->city, "address" => $faker->address
                ];
            }

            // Convert the data to JSON format
            $jsonData = json_encode($contacts);

            // Save the JSON data to a file
            file_put_contents('contacts_4.json', $jsonData);

            $da = file_get_contents('contacts_4.json', $jsonData);
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
            $json_string = file_get_contents('contacts_4.json');

            // Convert JSON string to a PHP array
            $data = json_decode($json_string, true);

            // Add new data to array
            $new_data = [
                "name" => $request->name, "email" => $request->email, "phoneNumber" => $request->phoneNumber, "country" => $request->country, "state" => $request->state, "city" => $request->city, "address" => $request->address
            ];
            $data[] = $new_data;

            // Convert PHP array to JSON string
            $json_string = json_encode($data);

            // Write JSON string to file
            file_put_contents('contacts_4.json', $json_string);
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
            $json_string = file_get_contents('contacts_4.json');

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
            $json_string = file_get_contents('contacts_4.json');

            // Convert JSON string to a PHP associative array
            $data = json_decode($json_string, true);

            // Remove specific element from associative array
            $id = $id;
            Unset($data[$id]);

            // Convert updated associative array back to JSON format
            $json_string = json_encode($data);

            // Save updated JSON string to file
            file_put_contents('contacts_4.json', $json_string);
        }
    }
        
        