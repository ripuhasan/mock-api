<?php

use Faker\Factory as Faker;

class Helper{

      public static function folderMake($path)
      {
            $folderName = $path;
            if (!is_dir($folderName)) {
                  // Create the directory if it does not exist
                  mkdir($folderName, 0777, true);
                  
                  return $folderName;
            } else {
                  return $folderName;
            }
      }

      public static function generateFackData($how_many_data, $final_field)
      {
            $faker = Faker::create();
            $data = [];
            //explode string to array conversation
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
