<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FakerInputField;
use App\Models\ApiUrl;
use GenerateFile;
use stdClass;

class CustomMockApiController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __construct()
    {
        $this->middleware('permission:custom-mock-api-view|custom-mock-api-create|custom-mock-api-update|custom-mock-api-delete', ['only' => ['index']]);
        $this->middleware('permission:custom-mock-api-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:custom-mock-api-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:custom-mock-api-delete', ['only' => ['destroy']]);
        $this->page_title = 'User List';
        $this->access = 'custom-mock-api';
        $this->key_word = 'Custom Mock Api';
        $this->path = 'admin.custom-mock-api';
        $this->route_store = 'admin.mock.api';
        $this->route_destroy = 'admin.mock.api.destroy';
        $this->route_update = 'admin.mock.api.update';
    }

    public function customMockApi()
    {
        $info = new stdClass();
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->page_title = "Custom Mock Api Create";
        $info->route_store = 'admin.custom.mock.api.store';

        $fields = FakerInputField::where('is_active', 1)->get();
        return view('admin.custom-mock-api.create', compact('info', 'fields'));
    }

    public function customMockApiStore(Request $request)
    {
        $input_field = implode(', ', $request->input_field);
        $type = implode(', ', $request->type);

        $db = ApiUrl::where('url', $request->url)->where('method', 'apiResource')->first();
        if($db){
            return redirect()->back()->with('message', 'Your api already exist!');
        }else{
           $db = ApiUrl::create([
                'url' => $request->url,
                'model' => $request->model,
                'input_field' => $input_field,
                'type' => $type,
                'method' => $request->method,
                'total_data' => $request->how_many_data,
            ]);
        }

        //Generate Api Url
        GenerateFile::generateApi($request);

        //Generate Api Controller
        GenerateFile::generateApiController($request, $db);

        return redirect()->back()->with('message', 'Your api create success');
    }
}
