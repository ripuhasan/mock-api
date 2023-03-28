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
                            <h4>Create {{ $info->key_word }}</h4>

                              @if(Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                              @endif
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route($info->route_store) }}" method="post">
                                @csrf
                              <div class="row">
                              <div class="col-md-6">
                                    <div class="form-group">
                                          <label>Url *</label>
                                          <input type="text" class="form-control" name="url" placeholder="Enter Your Api Url" required>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="form-group">
                                          <label>Model *</label>
                                          <input type="text" class="form-control" name="model" placeholder="Enter Model" required>
                                    </div>
                              </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Input Field *</label>
                                                <input type="text" class="form-control" name="type[]" placeholder="Example: name" required>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Type *</label>
                                                <select name="input_field[]" class="form-control" required>
                                                      @foreach($fields as $field)
                                                      <option value="{{ $field->key }}">{{ $field->name }}</option>
                                                      @endforeach
                                                </select>
                                          </div>
                                    </div>
                              </div>


                              <div id="dynamicForm"></div>

                              <button type="button" name="add" id="add" class="btn btn-success"><i class="ti-plus"></i></button>

                              <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Method *</label>
                                                <select name="method" class="form-control" required>
                                                      <option value="get">GET</option>
                                                      <option value="post">POST</option>
                                                      <option value="put">PUT</option>
                                                      <option value="delete">DELETE</option>
                                                      <option value="get_view">VIEW</option>
                                                </select>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>How many data *</label>
                                                <input type="number" class="form-control" name="how_many_data" value="1" min="1" required>
                                          </div>
                                    </div>
                              </div>

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
            </div>
        </section>
    </div>
</div>

@include('admin.partials.footer')
@endsection

@push('custom_js')
<script type="text/javascript">

      var i = 0;

      $("#add").click(function(){
          ++i;

          $("#dynamicForm").append(`<div class="row" id="myDiv">
                                    <div class="col-md-5">
                                          <div class="form-group">
                                                <label>Input Field *</label>
                                                <input type="text" class="form-control" name="type[]" placeholder="Example: name" required>
                                          </div>
                                    </div>
                                    <div class="col-md-5">
                                          <div class="form-group">
                                                <label>Type *</label>
                                                <select name="input_field[]" class="form-control" required>
                                                      @foreach($fields as $field)
                                                      <option value="{{ $field->key }}">{{ $field->name }}</option>
                                                      @endforeach
                                                </select>
                                          </div>
                                    </div><div class="col-md-2"><button type="button" class="btn btn-danger remove-btn"><i class="ti-trash"></i></button></div>
                                    
                              </div>`);
  
      });

      $(document).on('click', '.remove-btn', function() {
    $('#myDiv').remove();
});

  </script>
@endpush