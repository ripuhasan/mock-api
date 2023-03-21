<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiUrl;
use GenerateFile;
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

        return view('admin.mock-api.create', compact('info'));
    }

    public function mockApiStore(Request $request)
    {
        $db = ApiUrl::where('url', $request->url)->first();
        if($db){
            return redirect()->back()->with('message', 'Your api already exist!');
        }else{
           $db = ApiUrl::create([
                'url' => $request->url,
                'model' => $request->model,
                'input_field' => $request->input_field,
                'method' => 'apiResource',
                'total_data' => $request->how_many_data,
            ]);
        }

        $url = $request->url;

        
        $controller = 'Api\\'.ucfirst(str_replace(" ", "", $request->model)).'Controller::class';

        //Generate Api Url
        GenerateFile::generateApi($url, $controller);

        //Generate Api Controller
        GenerateFile::generateApiController($request, $db);

        return redirect()->back()->with('message', 'Your api create success');
    }

    public function mockApiList()
    {
        $info = new stdClass();
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->page_title = "Mock Api Create";
        $info->route_store = $this->route_store;
        $info->route_destroy = $this->route_destroy;

        $url = url('/');
        $rows = ApiUrl::get();
        return view('admin.mock-api.index', compact('rows', 'info', 'url'));
    }

    public function MockApiEdit($id)
    {
        $info = new stdClass();
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->page_title = "Mock Api Create";
        $info->route_update = $this->route_update;

        $row = ApiUrl::findOrFail($id);
        return view('admin.mock-api.edit', compact('row', 'info'));
    }

    public function MockApiUpdate(Request $request, $id)
    {
        return "Mock Api Update Method";
    }

    public function MockApiDestroy($id)
    {
        return "Mock Api Destroy Method";
    }
}
