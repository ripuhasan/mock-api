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
                                <form action="{{ route($info->route_update, $row->id) }}" method="post">
                                @csrf
                                @method('PUT')
                              <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Url *</label>
                                                <input type="text" class="form-control" name="url" value="{{ $row->url }}" required>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Model *</label>
                                                <input type="text" class="form-control" name="model" value="{{ $row->model }}" readonly required>
                                          </div>
                                    </div>
                              </div>
                              @foreach($selected_fields as $type => $input_field)
                              <div class="row" id="hideRow_{{ $loop->index }}">
                                    <div class="col-md-5">
                                          <div class="form-group">
                                          <label>Input Field *</label>
                                          <input type="text" class="form-control" name="type[]" value="{{ $type }}" required>
                                          </div>
                                    </div>
                                    <div class="col-md-5">
                                          <div class="form-group">
                                          <label>Type *</label>
                                          <select name="input_field[]" class="form-control" required>
                                                @foreach($fields as $field)
                                                      <option {{ $input_field == $field->key ? 'selected' : '' }} value="{{ $field->key }}">{{ $field->name }}</option>
                                                @endforeach
                                          </select>
                                          </div>
                                    </div>
                                    @if(!$loop->first)
                                          <div class="col-md-2">
                                          <button type="button" class="btn btn-danger remove-btn" onClick="deleteRow('{{ $loop->index }}')"><i class="ti-trash"></i></button>
                                          </div>
                                    @endif
                              </div>
                              @endforeach


                              <div id="dynamicForm"></div>

                              <button type="button" name="add" id="add" class="btn btn-success"><i class="ti-plus"></i></button>

                              <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Method *</label>
                                                <select name="method" class="form-control" required>
                                                      <option {{ $row->method == 'get' ? 'selected' : '' }} value="get">GET</option>
                                                      <option {{ $row->method == 'post' ? 'selected' : '' }} value="post">POST</option>
                                                      <option {{ $row->method == 'put' ? 'selected' : '' }} value="put">PUT</option>
                                                      <option {{ $row->method == 'delete' ? 'selected' : '' }} value="delete">DELETE</option>
                                                      <option {{ $row->method == 'get_view' ? 'selected' : '' }} value="get_view">VIEW</option>
                                                </select>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>How many data *</label>
                                                <input type="number" class="form-control" name="how_many_data" value="{{ $row->total_data }}" min="1" required>
                                          </div>
                                    </div>
                              </div>

                                <div class="form-group row mb-0">
                                    <div class="col-sm-9">
                                        <div class="layout-button mt-25">
                                            <input type="button" class="btn btn-default btn-squared border-normal bg-normal px-20" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-default btn-squared px-30" value="Update">
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


//Remove Row
function deleteRow(index) {
    console.log(index);
    var el = document.getElementById('hideRow_'+index);
    el.remove();
}

</script>
@endpush