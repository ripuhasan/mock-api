@extends('admin.layouts.master')
@section('title', $info->page_title)

@section('content')
<div class="main">
    <div class="container-fluid">
        @include('admin.partials.breadcrumb')
        <!-- /# row -->
        <section id="main-content">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-title">
                            <h4>Create {{ $info->key_word }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route($info->route_store) }}" method="post">
                                @csrf
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Role Name">
                                    </div>

                                    @php
                                    $separation = '0';
                                    @endphp
                                            
                                    @foreach($permission as $value) 

                                    @if($separation != $value->group)
                                            <h6 class="mt-4 text-primary">{{ $value->group }}</h6>
                                    @endif
                                                
                                    <div class="form-group d-inline" style="margin-right: 40px;">
                                            <div class="checkbox d-inline m-r-10">
                                                <input type="checkbox" id="checkbox-{{ $value->id }}" name="permission[]" value="{{ $value->id }}" checked>

                                                <label for="checkbox-{{ $value->id }}" class="cr">{{ $value->title }}</label>
                                            </div>
                                    </div>

                                    @php
                                            $separation = $value->group;
                                    @endphp

                                    @endforeach

                                <div class="form-group row mb-0">
                                    <div class="col-sm-9">
                                        <div class="layout-button mt-25">
                                            <input type="button" class="btn btn-default btn-squared border-normal bg-normal px-20" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-default btn-squared px-30" value="Save">
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-title">
                            <h4>{{ $info->page_title }}</h4>
                            
                        </div>
                        <div class="card-body">
                            @if(count($rows) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach($rows as $key=>$row)
                                            <tr>
                                                <td>#{{ $key + 1 }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>
                                                    @if (count($row->permissions) > 0)
                                                        <span class="badge badge-round badge-success badge-sm">{{ count($row->permissions) }}</span>
                                                    @else
                                                        <span class="badge badge-round badge-danger badge-sm">No permission found :(</span>
                                                    @endif
                                                </td>
                                                <td>{{ $row->created_at->diffForHumans() }}</td>
                                                <td class="d-flex justify-content-end">
                                                    <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                        @can('role-view')
                                                        <li class="p-1">
                                                            <a href="{{ route($info->route_show, $row->id) }}" class="btn btn-sm btn-primary">
                                                                <i class="ti-eye"></i></a>
                                                        </li>
                                                        @endcan
                                                        @can('role-edit')
                                                        <li class="p-1">
                                                            <a href="{{ route($info->route_edit, $row->id) }}" class="btn btn-sm btn-warning">
                                                                <i class="ti-pencil-alt"></i></a>
                                                        </li>
                                                        @endcan
                                                        @can('role-destroy')
                                                        @if($row->deletable == true)
                                                        <li class="p-1">
                                                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">
                                                                <i class="ti-trash"></i></a>
                                                        </li>
                                                        @endcan
                                                        @endif
                                                    </ul>
                                                </td>
                                            </tr>
                                            @include('admin.layouts.inc.delete')
                                        @endforeach
                            @else
                                <div class="alert alert-custom alert-notice alert-light-success fade show mb-5 text-center" role="alert">
                                        <div class="alert-icon">
                                            <i class="flaticon-questions-circular-button"></i>
                                        </div>
                                        <div class="alert-text text-dark">
                                            No Data Found..!
                                        </div>
                                </div>
                            @endif
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@include('admin.partials.footer')
@endsection