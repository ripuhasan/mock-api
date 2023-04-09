<?php

use Illuminate\Support\Str;

class Swagger{
      public static function getIndex($db)
      {
            $path = $db->url;
            $tag = ucfirst(str_replace(" ", "", $db->model));
            $plural = Str::plural($db->model);

            return "
            /**
             * @OA\Get(
             *    path=\"/api/$path\",
             *    tags={\"$tag\"},
             *    summary=\"Get list of $plural\",
             *    description=\"Get list of $plural\",
             *    @OA\Parameter(name=\"limit\", in=\"query\", description=\"limit\", required=false,
             *        @OA\Schema(type=\"integer\")
             *    ),
             *    @OA\Parameter(name=\"page\", in=\"query\", description=\"the page number\", required=false,
             *        @OA\Schema(type=\"integer\")
             *    ),
             *    @OA\Parameter(name=\"order\", in=\"query\", description=\"order accepts 'asc' or 'desc'\", required=false,
             *        @OA\Schema(type=\"string\")
             *    ),
             *    @OA\Response(
             *        response=200,
             *        description=\"Success\",
             *        @OA\JsonContent(
             *            @OA\Property(property=\"status\", type=\"integer\", example=\"200\"),
             *            @OA\Property(property=\"data\", type=\"object\")
             *        )
             *    )
             * )
             */
            ";
      }

      public static function store($db)
      {
            $path = $db->url;
            $tag = ucfirst(str_replace(" ", "", $db->model));
            $plural = Str::plural($db->model);
            $required = str_replace(['[', ']'], ['{', '}'], $db->input_field);

            $input_fields = explode(",", $db->input_field);
            $properties = [];

            foreach ($input_fields as $field) {
                  $string = '@OA\Property(property=' . $field . ', type="string", format="string")';
                  $properties[$field] = $string;
            }
            //remove '[]'
        $properties = str_replace(['[', ']'], '', $properties);
        $properties = implode(', ', $properties);


            return "
            /**
     * @OA\Post(
     *      path=\"/api/$path\",
     *      tags={\"$tag\"},
     *      summary=\"Store $plural in DB\",
     *      description=\"Store $plural in DB\",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required=$required,
     *            $properties
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description=\"Success\",
     *          @OA\JsonContent(
     *             @OA\Property(property=\"status\", type=\"integer\", example=\"\"),
     *             @OA\Property(property=\"data\",type=\"object\")
     *          )
     *       )
     *  )
     */
            ";
      }

      public static function show($db)
      {
            $path = $db->url.'/{id}';
            $tag = ucfirst(str_replace(" ", "", $db->model));
            $plural = Str::plural($db->model);

            return "/**
             * @OA\Get(
             *    path=\"/api/$path\",
             *    tags={\"$tag\"},
             *    summary=\"Get $plural Detail\",
             *    description=\"Get $plural Detail\",
             *    @OA\Parameter(name=\"id\", in=\"path\", description=\"Id of $plural\", required=true,
             *        @OA\Schema(type=\"integer\")
             *    ),
             *     @OA\Response(
             *          response=200,
             *          description=\"Success\",
             *          @OA\JsonContent(
             *          @OA\Property(property=\"status_code\", type=\"integer\", example=\"200\"),
             *          @OA\Property(property=\"data\",type=\"object\")
             *           ),
             *        )
             *       )
             *  )
             */
            ";
      }

      public static function update($db)
      {
            $path = $db->url.'/{id}';
            $tag = ucfirst(str_replace(" ", "", $db->model));
            $plural = Str::plural($db->model);

            $required = str_replace(['[', ']'], ['{', '}'], $db->input_field);

            $input_fields = explode(",", $db->input_field);
            $properties = [];

            foreach ($input_fields as $field) {
                  $string = '@OA\Property(property=' . $field . ', type="string", format="string")';
                  $properties[$field] = $string;
            }
            //remove '[]'
            $properties = str_replace(['[', ']'], '', $properties);
            $properties = implode(', ', $properties);


            return "/**
            * @OA\Put(
            *     path=\"/api/$path\",
            *     tags={\"$tag\"},
            *     summary=\"Update $plural in DB\",
            *     description=\"Update $plural in DB\",
            *     @OA\Parameter(name=\"id\", in=\"path\", description=\"Id of $plural\", required=true,
            *         @OA\Schema(type=\"integer\")
            *     ),
            *     @OA\RequestBody(
            *        required=true,
            *        @OA\JsonContent(
            *           required=$required,
            *           $properties
            *        ),
            *     ),
            *     @OA\Response(
            *          response=200, description=\"Success\",
            *          @OA\JsonContent(
            *             @OA\Property(property=\"status_code\", type=\"integer\", example=\"200\"),
            *             @OA\Property(property=\"data\",type=\"object\")
            *          )
            *       )
            *  )
            */
            ";
      }

      public static function delete($db)
      {
            $path = $db->url.'/{id}';
            $tag = ucfirst(str_replace(" ", "", $db->model));
            $plural = Str::plural($db->model);

            return "/**
            * @OA\Delete(
            *    path=\"/api/$path\",
            *    tags={\"$tag\"},
            *    summary=\"Delete $plural\",
            *    description=\"Delete $plural\",
            *    @OA\Parameter(name=\"id\", in=\"path\", description=\"Id of $plural\", required=true,
            *        @OA\Schema(type=\"integer\")
            *    ),
            *    @OA\Response(
            *         response=200,
            *         description=\"Success\",
            *         @OA\JsonContent(
            *         @OA\Property(property=\"status_code\", type=\"integer\", example=\"200\"),
            *         @OA\Property(property=\"data\",type=\"object\")
            *          ),
            *       )
            *      )
            *  )
            */
            ";
      }
}




