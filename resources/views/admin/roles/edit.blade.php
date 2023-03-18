@extends('admin.layouts.master')
@section('title', $info->page_title)

@section('content')
<div class="main">
    <div class="container-fluid">
        @include('admin.partials.breadcrumb')
        <!-- /# row -->
        <section id="main-content">
            <form action="{{ route($info->route_update, $row->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-title">
                            <h4>Edit {{ $info->key_word }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $row->name }}">
                                    </div>

                                    

                                <div class="form-group row mb-0">
                                    <div class="col-sm-9">
                                        <div class="layout-button mt-25">
                                            <input type="button" class="btn btn-default btn-squared border-normal bg-normal px-20" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-default btn-squared px-30" value="Update">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-title">
                            <h4>{{ $info->page_title }} </h4>
                            
                        </div>
                        <div class="card-body">
                              @php
                              $separation = '0';
                              @endphp
                                      
                              @foreach($permission as $value) 

                              @if($separation != $value->group)
                                      <h6 class="mt-4 text-primary">{{ $value->group }}</h6>
                              @endif
                                          
                              <div class="form-group d-inline" style="margin-right: 40px;">
                                      <div class="checkbox d-inline m-r-10">
                                          <input type="checkbox" id="checkbox-{{ $value->id }}" name="permission[]" value="{{ $value->id }}" 
                                          @foreach($rolePermissions as $rolePermission)
                                          @if($rolePermission->permission_id == $value->id) checked @endif
                                          @endforeach
                                          >

                                          <label for="checkbox-{{ $value->id }}" class="cr">{{ $value->title }}</label>
                                      </div>
                              </div>

                              @php
                                      $separation = $value->group;
                              @endphp

                              @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
      </form>
</div>

@include('admin.partials.footer')
@endsection