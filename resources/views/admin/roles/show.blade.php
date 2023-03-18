@extends('admin.layouts.master')
@section('title', $info->page_title)

@section('content')
<div class="main">
    <div class="container-fluid">
        @include('admin.partials.breadcrumb')
        <!-- /# row -->
        <section id="main-content">
            <div class="row">
                  <div class="col-lg-12 mb-25">
                        <div class="social-overview-wrap">
                              <div class="card card-overview border-0">
                                    <div class="card-header">
                                          <h5>{{ $info->key_word }} Details</h5>
                                    </div>
            
                                    <div class="card-body">
                                    
                                    <!-- Details View Start -->
                                    <h4> {{ $row->name }}</h4>
                                    @if(count($rolePermissions) > 0)                 
                                          @if(!empty($rolePermissions))
                                                @php
                                                      $separation = '0';
                                                @endphp
                                                      
                                                @foreach($rolePermissions as $value) 
                  
                                                @if($separation != $value->group)
                                                      <h6 class="mt-4 text-primary">{{ $value->group }}</h6>
                                                @endif
                                                      <span class="badge badge-round badge-success badge-lg">
                                                      {{ $value->title }}
                                                      </span> 
                                                @php
                                                      $separation = $value->group;
                                                @endphp
                  
                                                @endforeach
                                          @endif
                                    @else
                                    <span class="badge badge-round badge-danger badge-lg">No permission found :(</span>
                                    @endif
                                    <!-- Details View End -->
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