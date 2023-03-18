@extends('admin.layouts.master')
@section('title', $info->page_title)

@section('content')
<div class="main">
    <div class="container-fluid">
        @include('admin.partials.breadcrumb')
        <!-- /# row -->
        <section id="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title">
                            <h4>{{ $info->page_title }}</h4>
                            
                        </div>
                        <div class="card-body">
                            @if(count($rows) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                          <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                          @foreach($rows as $key=>$row)
                                          <tr>
                                              <td>#{{ $key + 1 }}</td>
                                              <td>{{ $row->name }}</td>
                                              <td>{{ $row->email }}</td>
                                              <td>{{ $row->created_at->diffForHumans() }}</td>
                                              <td class="d-flex justify-content-end">
                                                  <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                        @can($info->access.'-view')
                                                        <li class="p-1">
                                                            <a href="{{ route($info->route_show, $row->id) }}" class="btn btn-sm btn-primary">
                                                                  <i class="ti-eye"></i></a>
                                                        </li>
                                                        @endcan
                                                        @can($info->access.'-edit')
                                                        <li class="p-1">
                                                            <a href="{{ route($info->route_edit, $row->id) }}" class="btn btn-sm btn-warning">
                                                                  <i class="ti-pencil-alt"></i></a>
                                                        </li>
                                                        @endcan
                                                        @can($info->access.'-destroy')
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