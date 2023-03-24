<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
          $this->middleware('permission:mock-api-view|mock-api-create|mock-api-update|mock-api-delete', ['only' => ['index']]);
          $this->middleware('permission:mock-api-create', ['only' => ['create', 'store']]);
          $this->middleware('permission:mock-api-update', ['only' => ['edit', 'update']]);
          $this->middleware('permission:mock-api-delete', ['only' => ['destroy']]);
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
        $info->route_store = $this->route_store;

        return view('admin.custom-mock-api.create', compact('info'));
    }
}
