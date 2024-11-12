<?php

    namespace App\Http\Controllers\Api;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Faker\Factory as Faker;
    
    class CustomerController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

         
            /**
             * @OA\Get(
             *    path="/api/customer/details",
             *    tags={"Customer"},
             *    summary="Get list of Customers",
             *    description="Get list of Customers",
             *    @OA\Parameter(name="limit", in="query", description="limit", required=false,
             *        @OA\Schema(type="integer")
             *    ),
             *    @OA\Parameter(name="page", in="query", description="the page number", required=false,
             *        @OA\Schema(type="integer")
             *    ),
             *    @OA\Parameter(name="order", in="query", description="order accepts 'asc' or 'desc'", required=false,
             *        @OA\Schema(type="string")
             *    ),
             *    @OA\Response(
             *        response=200,
             *        description="Success",
             *        @OA\JsonContent(
             *            @OA\Property(property="status", type="integer", example="200"),
             *            @OA\Property(property="data", type="object")
             *        )
             *    )
             * )
             */
            

        public function index(Request $request)
        {
            $limit = $request->limit ?: 15;
            $order = $request->order == 'asc' ? 'asc' : 'desc';

            if (file_exists('json_data/customer/details/customers_165.json')) {
                $data = file_get_contents('json_data/customer/details/customers_165.json');
                $data = json_decode($data);

                // Order the data by the id field in the specified order
                if ($order == 'asc') {
                    $data = collect($data)->sortBy('id');
                } else {
                    $data = collect($data)->sortByDesc('id');
                }


                // Limit the results to 10
                $data = $data->take($limit);
                
                return response()->json($data);
            }
            return response()->json([
                'success' => false,
                'message' => 'File could not found!'
            ]);
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */

         
            /**
     * @OA\Post(
     *      path="/api/customer/details",
     *      tags={"Customer"},
     *      summary="Store Customers in DB",
     *      description="Store Customers in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"firstName","lastName","email","country"},
     *            @OA\Property(property="firstName", type="string", format="string"), @OA\Property(property="lastName", type="string", format="string"), @OA\Property(property="email", type="string", format="string"), @OA\Property(property="country", type="string", format="string")
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
            
         
        public function store(Request $request)
        {
            try{
                // Load JSON file contents into a string variable
                $json_string = file_get_contents('json_data/customer/details/customers_165.json');

                // Convert JSON string to a PHP array
                $data = json_decode($json_string, true);

                // Add new data to array
                $new_data = [
                    "first_name" => $request->firstName, "last_name" => $request->lastName, "email" => $request->email, "country" => $request->country
                ];
                $data[] = $new_data;

                // Convert PHP array to JSON string
                $json_string = json_encode($data);

                // Write JSON string to file
                file_put_contents('json_data/customer/details/customers_165.json', $json_string);

                return response()->json([
                    "success" => true,
                    "message" => "Store success",
                    "data" => $new_data
                ]);
            }catch(\Exception $e){
                return response()->json([
                    "success" => false,
                    "message" => "Store fail!", $e,
                    "data" => $new_data
                ]);
            }

        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

         /**
             * @OA\Get(
             *    path="/api/customer/details/{id}",
             *    tags={"Customer"},
             *    summary="Get Customers Detail",
             *    description="Get Customers Detail",
             *    @OA\Parameter(name="id", in="path", description="Id of Customers", required=true,
             *        @OA\Schema(type="integer")
             *    ),
             *     @OA\Response(
             *          response=200,
             *          description="Success",
             *          @OA\JsonContent(
             *          @OA\Property(property="status_code", type="integer", example="200"),
             *          @OA\Property(property="data",type="object")
             *           ),
             *        )
             *       )
             *  )
             */
            

        public function show($id)
        {
            // Load JSON file contents into a string variable
            $json_string = file_get_contents('json_data/customer/details/customers_165.json');

            // Convert JSON string to a PHP associative array
            $data = json_decode($json_string, true);

            // Remove element at index 0
            Unset($data[0]);

            // Access specific ID in associative array, avoiding index 0
            
            if (isset($data[$id]) && $id !== 0) {
                $record = $data[$id - 1];

                // Do something with the record
                return response()->json($record);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "No data found!"
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

         /**
            * @OA\Put(
            *     path="/api/customer/details/{id}",
            *     tags={"Customer"},
            *     summary="Update Customers in DB",
            *     description="Update Customers in DB",
            *     @OA\Parameter(name="id", in="path", description="Id of Customers", required=true,
            *         @OA\Schema(type="integer")
            *     ),
            *     @OA\RequestBody(
            *        required=true,
            *        @OA\JsonContent(
            *           required={"firstName","lastName","email","country"},
            *           @OA\Property(property="firstName", type="string", format="string"), @OA\Property(property="lastName", type="string", format="string"), @OA\Property(property="email", type="string", format="string"), @OA\Property(property="country", type="string", format="string")
            *        ),
            *     ),
            *     @OA\Response(
            *          response=200, description="Success",
            *          @OA\JsonContent(
            *             @OA\Property(property="status_code", type="integer", example="200"),
            *             @OA\Property(property="data",type="object")
            *          )
            *       )
            *  )
            */
            

        public function update(Request $request, $id)
        {
            try{
                // Load JSON file contents into a string variable
                $json_string = file_get_contents('json_data/customer/details/customers_165.json');

                // Convert JSON string to a PHP associative array
                $data = json_decode($json_string, true);

                // Remove element at index 0
                Unset($data[0]);

                // Define the index of the object to update
                $index = $id;

                // Update the object with new data
                $data[$index]["first_name"] = $request->firstName; $data[$index]["last_name"] = $request->lastName; $data[$index]["email"] = $request->email; $data[$index]["country"] = $request->country;

                // Convert the updated data back to JSON
                $json_data = json_encode($data, JSON_PRETTY_PRINT);

                // Write the updated JSON data back to the file
                file_put_contents('json_data/customer/details/customers_165.json', $json_data);
                return response()->json([
                    "success" => true,
                    "message" => "Update success"
                ]);
            }catch(\Exception $e){
                return response()->json([
                    "success" => false,
                    "message" => "Update fail!", $e
                ]);
            }
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

         /**
            * @OA\Delete(
            *    path="/api/customer/details/{id}",
            *    tags={"Customer"},
            *    summary="Delete Customers",
            *    description="Delete Customers",
            *    @OA\Parameter(name="id", in="path", description="Id of Customers", required=true,
            *        @OA\Schema(type="integer")
            *    ),
            *    @OA\Response(
            *         response=200,
            *         description="Success",
            *         @OA\JsonContent(
            *         @OA\Property(property="status_code", type="integer", example="200"),
            *         @OA\Property(property="data",type="object")
            *          ),
            *       )
            *      )
            *  )
            */
            

        public function destroy($id)
        {
            try{
                // Load JSON file contents into a string variable
                $json_string = file_get_contents('json_data/customer/details/customers_165.json');

                // Convert JSON string to a PHP associative array
                $data = json_decode($json_string, true);

                // Remove specific element from associative array
                
                Unset($data[$id]);

                // Convert updated associative array back to JSON format
                $json_string = json_encode($data);

                // Save updated JSON string to file
                file_put_contents('json_data/customer/details/customers_165.json', $json_string);

                return response()->json([
                    "success" => true,
                    "message" => "Delete success"
                ]);
            }catch(\Exception $e){
                return response()->json([
                    "success" => false,
                    "message" => "Delete fail!", $e
                ]);
            }

        }
    }
        
        