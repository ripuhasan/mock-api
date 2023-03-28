<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class FackerInputFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faker_input_fields')->delete();

        $fields = [
                ['name' => 'First Name', 'key' => 'firstName', 'is_active' => '1'],
                ['name' => 'Last Name', 'key' => 'lastName', 'is_active' => '1'],
                ['name' => 'Title', 'key' => 'title', 'is_active' => '1'],
                ['name' => 'Suffix', 'key' => 'suffix', 'is_active' => '1'],
                ['name' => 'Name', 'key' => 'name', 'is_active' => '1'],
                ['name' => 'Username', 'key' => 'username', 'is_active' => '1'],
                ['name' => 'Email', 'key' => 'email', 'is_active' => '1'],
                ['name' => 'Safe Email', 'key' => 'safeEmail', 'is_active' => '1'],
                ['name' => 'Free Email', 'key' => 'freeEmail', 'is_active' => '1'],
                ['name' => 'Company Email', 'key' => 'companyEmail', 'is_active' => '1'],
                ['name' => 'Password', 'key' => 'password', 'is_active' => '1'],
                ['name' => 'Phone Number', 'key' => 'phoneNumber', 'is_active' => '1'],
                ['name' => 'Toll-free Phone Number', 'key' => 'tollFreePhoneNumber', 'is_active' => '1'],
                ['name' => 'E.164 Phone Number', 'key' => 'e164PhoneNumber', 'is_active' => '1'],
                ['name' => 'Job Title', 'key' => 'jobTitle', 'is_active' => '1'],
                ['name' => 'City', 'key' => 'city', 'is_active' => '1'],
                ['name' => 'Street Name', 'key' => 'streetName', 'is_active' => '1'],
                ['name' => 'Building Number', 'key' => 'buildingNumber', 'is_active' => '1'],
                ['name' => 'Postcode', 'key' => 'postcode', 'is_active' => '1'],
                ['name' => 'Address', 'key' => 'address', 'is_active' => '1'],
                ['name' => 'Country', 'key' => 'country', 'is_active' => '1'],
                ['name' => 'Latitude', 'key' => 'latitude', 'is_active' => '1'],
                ['name' => 'Longitude', 'key' => 'longitude', 'is_active' => '1'],
                ['name' => 'Time Zone', 'key' => 'timeZone', 'is_active' => '1'],
                ['name' => 'Credit Card Type', 'key' => 'creditCardType', 'is_active' => '1'],
                ['name' => 'Credit Card Number', 'key' => 'creditCardNumber', 'is_active' => '1'],
                ['name' => 'Credit Card Expiration Date', 'key' => 'creditCardExpirationDate', 'is_active' => '1'],
                ['name' => 'Credit Card Expiration Date String', 'key' => 'creditCardExpirationDateString', 'is_active' => '1'],
                ['name' => 'Credit Card Details', 'key' => 'creditCardDetails', 'is_active' => '1'],
                ['name' => 'Bank Account Number', 'key' => 'bankAccountNumber', 'is_active' => '1'],
                ['name' => 'IBAN', 'key' => 'iban', 'is_active' => '1'],
                ['name' => 'SWIFT/BIC Number', 'key' => 'swiftBicNumber', 'is_active' => '1'],
                ['name' => 'Word', 'key' => 'word', 'is_active' => '1'],
                ['name' => 'Words', 'key' => 'words', 'is_active' => '1'],
        ];

        DB::table('faker_input_fields')->insert($fields);
    }
}
