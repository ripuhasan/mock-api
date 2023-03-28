@extends('admin.layouts.master')
@section('title', $info->page_title)

@section('content')
<div class="main">
    <div class="container-fluid">
        @include('admin.partials.breadcrumb')
        <!-- /# row -->
        <section id="main-content">
            <div class="row">
                  @foreach ($rows as $row)

                  <div class="col-lg-12">
                        <div class="card">
                            <div class="text-right mt-2 mr-2">
                                <a href="{{ route('admin.mock.api.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="ti-pencil-alt"></i></a>
    
                                <!-- Button trigger modal -->
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">
                                    <i class="ti-trash"></i></a>
                            </div>

                              <div class="card-body">
                                    <div class="row">
                                          <div class="col-md-4">
                                                <div class="table-responsive">
                                                    @php
                                                        $model = Str::plural(strtolower(str_replace(" ", "", $row->model)));
                                                    @endphp
                                                      <table class="table table-striped">
                                                            <thead>
                                                                  <tr>
                                                                    <th>
                                                                    @if($row->method == 'apiResource')
                                                                        <code>
                                                                        [GET] {{ $url }}/api/{{ $row->url }} <br><!---List Get Method--->
                                                                        [POST] {{ $url }}/api/{{ $row->url }} <br>    <!---Store Post Method--->
                                                                        [GET] {{ $url }}/api/{{ $row->url }}/&#123;id&#125; <br><!---Show Get Method--->
                                                                        [PUT] {{ $url }}/api/{{ $row->url }}/&#123;id&#125; <br> <!---Update Put Method--->
                                                                        [DELETE] {{ $url }}/api/{{ $row->url }}/&#123;id&#125; <br> <!---Delete DELETE Method--->
                                                                        </code>
                                                                    @else
                                                                    <code>
                                                                       [{{ Str::upper($row->method) }}] {{ $url }}/api/{{ $row->url }}
                                                                    </code>
                                                                    @endif
                                                                    </th>
                                                                  </tr>
                                                            </thead>
                                                      <tbody>
                                                            <tr>
                                                                <h5>Api</h5>
                                                            </tr>
                                                            </tbody>
                                                      </table>
                                                </div>
                                          </div>
                                          <div class="col-md-8">
                                                <div class="example mb-10">
                                                    <h5 class="mt-2 ml-2">Body</h5>
                                                      <div class="example-code">
                                                          <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                                                          <div class="example-highlight">
                                                              <pre>
                                                       <code>
                                                        <?php
                                                        if (!file_exists($model.'_'.$row->id.'.json')) {
                                                            echo "No json data found!";
                                                        }else{
                                                            $json = file_get_contents($model.'_'.$row->id.'.json'); 
                                                            $json_decode = json_decode($json, true); 
                                                            $limited_data = array_slice($json_decode, 0, 2); 
                    
                                                            echo json_encode($limited_data, JSON_PRETTY_PRINT);
                                                        }
                                                        ?>
                  
                                                       </code>
                                                   </pre>
                                                          </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
                  @include('admin.layouts.inc.delete')
                @endforeach 
            </div>
            @if(count($rows) <= 0)
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-center">No api create! <a class="btn btn-sm btn-primary" href="{{ route('admin.mock.api') }}">Create api</a> </h5>
                </div>
            </div>
            @endif
                </div>
            </div>
        </section>
    </div>
</div>

@include('admin.partials.footer')
@endsection