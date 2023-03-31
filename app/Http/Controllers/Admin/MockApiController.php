<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FakerInputField;
use App\Models\ApiUrl;
use GenerateFile;
use Helper;
use stdClass;

class MockApiController extends Controller
{

    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function __construct()
    {
        $this->middleware('permission:mock-api-view|mock-api-create|mock-api-update|mock-api-delete', ['only' => ['index']]);
        $this->middleware('permission:mock-api-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:mock-api-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mock-api-delete', ['only' => ['destroy']]);
        $this->page_title = 'User List';
        $this->access = 'mock-api';
        $this->key_word = 'Mock Api';
        $this->path = 'admin.mock-api';
        $this->route_store = 'admin.mock.api';
        $this->route_destroy = 'admin.mock.api.destroy';
        $this->route_update = 'admin.mock.api.update';
    }

    public function mockApi()
    {
        $info = new stdClass();
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->page_title = "Mock Api Create";
        $info->route_store = $this->route_store;

        $fields = FakerInputField::where('is_active', 1)->get();

        return view('admin.mock-api.create', compact('info', 'fields'));
    }

    public function mockApiStore(Request $request)
    {
        $db = ApiUrl::where('url', $request->url)->first();

        $path = 'json_data/'.$request->url;

        $folderName = Helper::folderMake($path);

        if($db){
            return redirect()->back()->with('message', 'Your api already exist!');
        }else{
            $request['method'] = 'apiResource';
            $input_field = json_encode($request->input_field);
            $db = ApiUrl::create([
                'url' => $request->url,
                'model' => $request->model,
                'input_field' => $input_field,
                'method' => $request->method,
                'total_data' => $request->how_many_data,
            ]);
        }

        //Generate Api Url
        GenerateFile::generateApi($request);

        //Generate Api Controller
        GenerateFile::generateApiController($request, $db, $folderName);

        return redirect()->back()->with('message', 'Your api create success');
    }

    public function mockApiList()
    {
        $info = new stdClass();
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->page_title = "Mock Api List";
        $info->route_store = $this->route_store;
        $info->route_destroy = $this->route_destroy;

        $url = url('/');
        $rows = ApiUrl::where('method', 'apiResource')->get();
        return view('admin.mock-api.index', compact('rows', 'info', 'url'));
    }

    public function MockApiEdit($id)
    {
        $info = new stdClass();
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->page_title = "Mock Api Edit";
        $info->route_update = $this->route_update;

        $fields = FakerInputField::where('is_active', 1)->get();
        $row = ApiUrl::findOrFail($id);
        //convert array
        $selected_fields = explode(',', $row->input_field);
        //remove '"' and '[]'
        $selected_fields = str_replace('"', '', $selected_fields);
        $selected_fields = str_replace(['[', ']'], '', $selected_fields);

        return view('admin.mock-api.edit', compact('row', 'info', 'fields', 'selected_fields'));
    }

    public function MockApiUpdate(Request $request, $id)
    {
        $db = ApiUrl::findOrFail($id);

        //Old controller
        $old_controller = 'Api\\'.ucfirst(str_replace(" ", "", $db->model)).'Controller::class';

        //Update Controller
        $update_controller = 'Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class';

        //Update Api Route
        // Get the file contents
        $apiRoute = file_get_contents('../routes/api.php');

        // Define the old string and new string
        $search_url = "Route::apiResource('$db->url', $old_controller);";
        $update_url = "Route::apiResource('$request->url', $update_controller);";

        // Replace the old string with new string
        $url_update = str_replace($search_url, $update_url, $apiRoute);

        // Write the updated content to the file
        file_put_contents('../routes/api.php', $url_update);

        //Old Controller
        $oldController = ucfirst(str_replace(" ", "", $db->model)).'Controller';

        //Old json data
        $old_json_data = Str::plural(strtolower(str_replace(" ", "", $db->model)));

        //Controller File Delete
        if(file_exists("../app/Http/Controllers/Api/{$oldController}.php")){
            unlink("../app/Http/Controllers/Api/{$oldController}.php");
        }
        //Json file delete
        if(file_exists("{$old_json_data}_{$db->id}.json")){
            unlink("{$old_json_data}_{$db->id}.json");
        }

        //Update database
        if($db){
            $input_field = json_encode($request->input_field);
            $db->update([
                'url' => $request->url,
                'model' => $request->model,
                'method' => 'apiResource',
                'input_field' => $input_field,
            ]);
            // return redirect()->back()->with('message', 'Your api update success!');
        }else{
           $db = ApiUrl::create([
                'url' => $request->url,
                'model' =>  $request->model,
                'method' => 'apiResource',
                'input_field' => $request->input_field,
            ]);
        }

        //New url
        $url = $request->url;
        //New Controller
        $controller = 'Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class';
        
        //Generate Api Url
       // GenerateFile::generateApi($url, $controller);

        $path = 'json_data/'.$request->url;

        $folderName = Helper::folderMake($path);
        //Generate Api Controller
        GenerateFile::generateApiController($request, $db, $folderName);

        return redirect()->back()->with('message', 'Your api update success!');

    }

    public function MockApiDestroy($id)
    {
        $row = ApiUrl::findOrFail($id);

        $controller = ucfirst(str_replace(" ", "", $row->model)).'Controller';
        $json = Str::plural(strtolower(str_replace(" ", "", $row->model)));

        //Controller File Delete
        if(file_exists("../app/Http/Controllers/Api/{$controller}.php")){
            unlink("../app/Http/Controllers/Api/{$controller}.php");
        }

        //Json file delete
        if(file_exists("{$json}_{$row->id}.json")){
            unlink("{$json}_{$row->id}.json");
        }

        //Url Remove
        // Get the file contents
        $apiRoute = file_get_contents('../routes/api.php');

        $url_controller = $controller."::class);";

        // Define the old string and new string
        $search_url = "Route::apiResource('$row->url', Api\\$url_controller";

        // Replace the old string with new string
        $url_remove = str_replace($search_url, '', $apiRoute);

        // Write the updated content to the file
        file_put_contents('../routes/api.php', $url_remove);

        $row->delete();

        return redirect()->back()->with('message', 'Api delete success!');

    }
}
