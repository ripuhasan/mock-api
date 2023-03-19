<?php

    namespace App\Http\Controllers\Api;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Faker\Factory as Faker;
    
    class TestController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $faker = Faker::create();

            $tests = [];

            for ($i = 0; $i < 10; $i++) {
                $tests[] = [
                    "firstName" => $faker->firstName, "lastName" => $faker->lastName, "title" => $faker->title, "suffix" => $faker->suffix, "name" => $faker->name, "username" => $faker->username, "email" => $faker->email, "safeEmail" => $faker->safeEmail, "freeEmail" => $faker->freeEmail, "companyEmail" => $faker->companyEmail, "password" => $faker->password, "phoneNumber" => $faker->phoneNumber, "tollFreePhoneNumber" => $faker->tollFreePhoneNumber, "e164PhoneNumber" => $faker->e164PhoneNumber, "jobTitle" => $faker->jobTitle, "city" => $faker->city, "streetName" => $faker->streetName, "buildingNumber" => $faker->buildingNumber, "postcode" => $faker->postcode, "address" => $faker->address, "country" => $faker->country, "latitude" => $faker->latitude, "longitude" => $faker->longitude, "timeZone" => $faker->timeZone, "creditCardType" => $faker->creditCardType, "creditCardNumber" => $faker->creditCardNumber, "creditCardExpirationDate" => $faker->creditCardExpirationDate, "creditCardExpirationDateString" => $faker->creditCardExpirationDateString, "creditCardDetails" => $faker->creditCardDetails, "bankAccountNumber" => $faker->bankAccountNumber, "iban" => $faker->iban, "swiftBicNumber" => $faker->swiftBicNumber, "word" => $faker->word, "words" => $faker->words, "sentence" => $faker->sentence, "sentences" => $faker->sentences, "paragraph" => $faker->paragraph, "paragraphs" => $faker->paragraphs, "text" => $faker->text, "realText" => $faker->realText, "boolean" => $faker->boolean, "randomNumber" => $faker->randomNumber, "randomFloat" => $faker->randomFloat, "randomDigit" => $faker->randomDigit, "randomLetter" => $faker->randomLetter, "randomElements" => $faker->randomElements, "shuffle" => $faker->shuffle, "uuid" => $faker->uuid, "mimeType" => $faker->mimeType, "fileExtension" => $faker->fileExtension, "company" => $faker->company, "state" => $faker->state, "dateTime" => $faker->dateTime, "imageUrl" => $faker->imageUrl, "image" => $faker->image, "countryCode" => $faker->countryCode, "freeEmailDomain" => $faker->freeEmailDomain, "safeEmailDomain" => $faker->safeEmailDomain, "domainName" => $faker->domainName, "domainWord" => $faker->domainWord, "tld" => $faker->tld, "url" => $faker->url, "ipv4" => $faker->ipv4, "ipv6" => $faker->ipv6, "localIpv4" => $faker->localIpv4, "macAddress" => $faker->macAddress, "userAgent" => $faker->userAgent, "md5" => $faker->md5, "sha1" => $faker->sha1, "sha256" => $faker->sha256, "locale" => $faker->locale, "languageCode" => $faker->languageCode, "currencyCode" => $faker->currencyCode
                ];
            }

            // Convert the data to JSON format
            $jsonData = json_encode($tests);

            // Save the JSON data to a file
            file_put_contents('tests_6.json', $jsonData);

            $da = file_get_contents('tests_6.json', $jsonData);
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
                $json_string = file_get_contents('tests_6.json');

                // Convert JSON string to a PHP array
                $data = json_decode($json_string, true);

                // Add new data to array
                $new_data = [
                    "firstName" => $request->firstName, "lastName" => $request->lastName, "title" => $request->title, "suffix" => $request->suffix, "name" => $request->name, "username" => $request->username, "email" => $request->email, "safeEmail" => $request->safeEmail, "freeEmail" => $request->freeEmail, "companyEmail" => $request->companyEmail, "password" => $request->password, "phoneNumber" => $request->phoneNumber, "tollFreePhoneNumber" => $request->tollFreePhoneNumber, "e164PhoneNumber" => $request->e164PhoneNumber, "jobTitle" => $request->jobTitle, "city" => $request->city, "streetName" => $request->streetName, "buildingNumber" => $request->buildingNumber, "postcode" => $request->postcode, "address" => $request->address, "country" => $request->country, "latitude" => $request->latitude, "longitude" => $request->longitude, "timeZone" => $request->timeZone, "creditCardType" => $request->creditCardType, "creditCardNumber" => $request->creditCardNumber, "creditCardExpirationDate" => $request->creditCardExpirationDate, "creditCardExpirationDateString" => $request->creditCardExpirationDateString, "creditCardDetails" => $request->creditCardDetails, "bankAccountNumber" => $request->bankAccountNumber, "iban" => $request->iban, "swiftBicNumber" => $request->swiftBicNumber, "word" => $request->word, "words" => $request->words, "sentence" => $request->sentence, "sentences" => $request->sentences, "paragraph" => $request->paragraph, "paragraphs" => $request->paragraphs, "text" => $request->text, "realText" => $request->realText, "boolean" => $request->boolean, "randomNumber" => $request->randomNumber, "randomFloat" => $request->randomFloat, "randomDigit" => $request->randomDigit, "randomLetter" => $request->randomLetter, "randomElements" => $request->randomElements, "shuffle" => $request->shuffle, "uuid" => $request->uuid, "mimeType" => $request->mimeType, "fileExtension" => $request->fileExtension, "company" => $request->company, "state" => $request->state, "dateTime" => $request->dateTime, "imageUrl" => $request->imageUrl, "image" => $request->image, "countryCode" => $request->countryCode, "freeEmailDomain" => $request->freeEmailDomain, "safeEmailDomain" => $request->safeEmailDomain, "domainName" => $request->domainName, "domainWord" => $request->domainWord, "tld" => $request->tld, "url" => $request->url, "ipv4" => $request->ipv4, "ipv6" => $request->ipv6, "localIpv4" => $request->localIpv4, "macAddress" => $request->macAddress, "userAgent" => $request->userAgent, "md5" => $request->md5, "sha1" => $request->sha1, "sha256" => $request->sha256, "locale" => $request->locale, "languageCode" => $request->languageCode, "currencyCode" => $request->currencyCode
                ];
                $data[] = $new_data;

                // Convert PHP array to JSON string
                $json_string = json_encode($data);

                // Write JSON string to file
                file_put_contents('tests_6.json', $json_string);

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
            $json_string = file_get_contents('tests_6.json');

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
                $json_string = file_get_contents('tests_6.json');

                // Convert JSON string to a PHP associative array
                $data = json_decode($json_string, true);

                // Remove element at index 0
                Unset($data[0]);

                // Define the index of the object to update
                $index = $id;

                // Update the object with new data
                $data[$index]["firstName"] = $request->firstName; $data[$index]["lastName"] = $request->lastName; $data[$index]["title"] = $request->title; $data[$index]["suffix"] = $request->suffix; $data[$index]["name"] = $request->name; $data[$index]["username"] = $request->username; $data[$index]["email"] = $request->email; $data[$index]["safeEmail"] = $request->safeEmail; $data[$index]["freeEmail"] = $request->freeEmail; $data[$index]["companyEmail"] = $request->companyEmail; $data[$index]["password"] = $request->password; $data[$index]["phoneNumber"] = $request->phoneNumber; $data[$index]["tollFreePhoneNumber"] = $request->tollFreePhoneNumber; $data[$index]["e164PhoneNumber"] = $request->e164PhoneNumber; $data[$index]["jobTitle"] = $request->jobTitle; $data[$index]["city"] = $request->city; $data[$index]["streetName"] = $request->streetName; $data[$index]["buildingNumber"] = $request->buildingNumber; $data[$index]["postcode"] = $request->postcode; $data[$index]["address"] = $request->address; $data[$index]["country"] = $request->country; $data[$index]["latitude"] = $request->latitude; $data[$index]["longitude"] = $request->longitude; $data[$index]["timeZone"] = $request->timeZone; $data[$index]["creditCardType"] = $request->creditCardType; $data[$index]["creditCardNumber"] = $request->creditCardNumber; $data[$index]["creditCardExpirationDate"] = $request->creditCardExpirationDate; $data[$index]["creditCardExpirationDateString"] = $request->creditCardExpirationDateString; $data[$index]["creditCardDetails"] = $request->creditCardDetails; $data[$index]["bankAccountNumber"] = $request->bankAccountNumber; $data[$index]["iban"] = $request->iban; $data[$index]["swiftBicNumber"] = $request->swiftBicNumber; $data[$index]["word"] = $request->word; $data[$index]["words"] = $request->words; $data[$index]["sentence"] = $request->sentence; $data[$index]["sentences"] = $request->sentences; $data[$index]["paragraph"] = $request->paragraph; $data[$index]["paragraphs"] = $request->paragraphs; $data[$index]["text"] = $request->text; $data[$index]["realText"] = $request->realText; $data[$index]["boolean"] = $request->boolean; $data[$index]["randomNumber"] = $request->randomNumber; $data[$index]["randomFloat"] = $request->randomFloat; $data[$index]["randomDigit"] = $request->randomDigit; $data[$index]["randomLetter"] = $request->randomLetter; $data[$index]["randomElements"] = $request->randomElements; $data[$index]["shuffle"] = $request->shuffle; $data[$index]["uuid"] = $request->uuid; $data[$index]["mimeType"] = $request->mimeType; $data[$index]["fileExtension"] = $request->fileExtension; $data[$index]["company"] = $request->company; $data[$index]["state"] = $request->state; $data[$index]["dateTime"] = $request->dateTime; $data[$index]["imageUrl"] = $request->imageUrl; $data[$index]["image"] = $request->image; $data[$index]["countryCode"] = $request->countryCode; $data[$index]["freeEmailDomain"] = $request->freeEmailDomain; $data[$index]["safeEmailDomain"] = $request->safeEmailDomain; $data[$index]["domainName"] = $request->domainName; $data[$index]["domainWord"] = $request->domainWord; $data[$index]["tld"] = $request->tld; $data[$index]["url"] = $request->url; $data[$index]["ipv4"] = $request->ipv4; $data[$index]["ipv6"] = $request->ipv6; $data[$index]["localIpv4"] = $request->localIpv4; $data[$index]["macAddress"] = $request->macAddress; $data[$index]["userAgent"] = $request->userAgent; $data[$index]["md5"] = $request->md5; $data[$index]["sha1"] = $request->sha1; $data[$index]["sha256"] = $request->sha256; $data[$index]["locale"] = $request->locale; $data[$index]["languageCode"] = $request->languageCode; $data[$index]["currencyCode"] = $request->currencyCode;

                // Convert the updated data back to JSON
                $json_data = json_encode($data, JSON_PRETTY_PRINT);

                // Write the updated JSON data back to the file
                file_put_contents('tests_6.json', $json_data);
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
                $json_string = file_get_contents('tests_6.json');

                // Convert JSON string to a PHP associative array
                $data = json_decode($json_string, true);

                // Remove specific element from associative array
                $id = $id;
                Unset($data[$id]);

                // Convert updated associative array back to JSON format
                $json_string = json_encode($data);

                // Save updated JSON string to file
                file_put_contents('tests_6.json', $json_string);

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
        
        