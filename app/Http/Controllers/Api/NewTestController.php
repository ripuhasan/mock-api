<?php

    namespace App\Http\Controllers\Api;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Faker\Factory as Faker;
    
    class NewTestController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            if (file_exists('newtests_7.json')) {
                $da = file_get_contents('newtests_7.json');
                $da = json_decode($da);
                
                return response()->json($da);
            }
            
            $faker = Faker::create();

            $newtests = [];

            for ($i = 0; $i < 5; $i++) {
                $newtests[] = [
                    "firstName" => $faker->firstName, "lastName" => $faker->lastName, "phoneNumber" => $faker->phoneNumber, "email" => $faker->email, "password" => $faker->password
                ];
            }

            // Convert the data to JSON format
            $jsonData = json_encode($newtests);

            // Save the JSON data to a file
            file_put_contents('newtests_7.json', $jsonData);

            $da = file_get_contents('newtests_7.json', $jsonData);
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
            try{
                // Load JSON file contents into a string variable
                $json_string = file_get_contents('newtests_7.json');

                // Convert JSON string to a PHP array
                $data = json_decode($json_string, true);

                // Add new data to array
                $new_data = [
                    "firstName" => $request->firstName, "lastName" => $request->lastName, "phoneNumber" => $request->phoneNumber, "email" => $request->email, "password" => $request->password
                ];
                $data[] = $new_data;

                // Convert PHP array to JSON string
                $json_string = json_encode($data);

                // Write JSON string to file
                file_put_contents('newtests_7.json', $json_string);

                return response()->json([
                    " success " => true,
                    " message " => " Store success ",
                    " data " => $new_data
                ]);
            }catch(\Exception $e){
                return response()->json([
                    " success " => false,
                    " message " => " Store fail! ", $e,
                    " data " => $new_data
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
            $json_string = file_get_contents('newtests_7.json');

            // Convert JSON string to a PHP associative array
            $data = json_decode($json_string, true);

            // Remove element at index 0
            Unset($data[0]);

            // Access specific ID in associative array, avoiding index 0
            $id = $id;
            if (isset($data[$id]) && $id !== 0) {
                $record = $data[$id - 1];

                // Do something with the record
                return response()->json($record);
            } else {
                return response()->json([
                    " success " => false,
                    " message " => " No data found! "
                ]);
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
            try{
                // Load JSON file contents into a string variable
                $json_string = file_get_contents('newtests_7.json');

                // Convert JSON string to a PHP associative array
                $data = json_decode($json_string, true);

                // Remove element at index 0
                Unset($data[0]);

                // Define the index of the object to update
                $index = $id;

                // Update the object with new data
                $data[$index]["firstName"] = $request->firstName; $data[$index]["lastName"] = $request->lastName; $data[$index]["phoneNumber"] = $request->phoneNumber; $data[$index]["email"] = $request->email; $data[$index]["password"] = $request->password;

                // Convert the updated data back to JSON
                $json_data = json_encode($data, JSON_PRETTY_PRINT);

                // Write the updated JSON data back to the file
                file_put_contents('newtests_7.json', $json_data);
                return response()->json([
                    " success " => true,
                    " message " => " Update success "
                ]);
            }catch(\Exception $e){
                return response()->json([
                    " success " => false,
                    " message " => " Update fail! ", $e
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
                $json_string = file_get_contents('newtests_7.json');

                // Convert JSON string to a PHP associative array
                $data = json_decode($json_string, true);

                // Remove specific element from associative array
                $id = $id;
                Unset($data[$id]);

                // Convert updated associative array back to JSON format
                $json_string = json_encode($data);

                // Save updated JSON string to file
                file_put_contents('newtests_7.json', $json_string);

                return response()->json([
                    " success " => true,
                    " message " => " Delete success "
                ]);
            }catch(\Exception $e){
                return response()->json([
                    " success " => false,
                    " message " => " Delete fail! ", $e
                ]);
            }

        }
    }
        
        