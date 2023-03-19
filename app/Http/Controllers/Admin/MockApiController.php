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
        $db_id = ApiUrl::where('url', $request->url)->first();
        if($db_id){
            return redirect()->back()->with('message', 'Your api already exist!');
        }else{
           $db_id = ApiUrl::create([
                'url' => $request->url,
                'model' => str_replace(" ", "", $request->model),
                'input_field' => $request->input_field,
                'method' => 'apiResource',
            ]);
        }

        $db_id = $db_id->id;

        $url = $request->url;

        
        $controller = 'Api\\'.$request->model.'Controller::class';

        //Generate Api Url
        GenerateFile::generateApi($url, $controller);

        //Generate Api Controller
        GenerateFile::generateApiController($url, $controller, $request, $db_id);

        return redirect()->back()->with('message', 'Your api create success');
    }

    public function mockApiList()
    {
        $info = new stdClass();
        $info->access = $this->access;
        $info->key_word = $this->key_word;
        $info->page_title = "Mock Api Create";
        $info->route_store = $this->route_store;
        $info->route_destroy = $this->route_store;

        $url = url('/');
        $rows = ApiUrl::get();
        return view('admin.mock-api.index', compact('rows', 'info', 'url'));
    }
}
