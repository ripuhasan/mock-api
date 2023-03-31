@extends('admin.layouts.master')
@section('title', $info->page_title)
@push('custom_css')
<link href="{{ asset('admin/assets/css/custom/bootstrap-select.css') }}" rel="stylesheet">
@endpush

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
                                          <input type="text" class="form-control" id="url" name="url" onkeyup="setModelName(this.value)" placeholder="Enter Your Api Url" required>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="form-group">
                                          <label>Model *</label>
                                          <input type="text" id="model" class="form-control" name="model" placeholder="Enter Model" required>
                                    </div>
                              </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Input Field(Using seperator ,) *</label>
                                                <select name="input_field[]" class="form-control selectpicker" id="tag-input10" multiple data-live-search="true" required>
                                                    @foreach($fields as $field)
                                                    <option value="{{ $field->key }}">{{ $field->name }}</option>
                                                    @endforeach
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
<script src="{{ asset('admin/assets/js/custom/bootstrap-select.min.js') }}"></script>
<script>
function setModelName(input) {
    if (input.length > 0) {
        spaceless_input = input.replace(/\s/g, '');
        document.getElementById('url').value = spaceless_input;
        var keyword = spaceless_input.split(/[\/ ]+/).pop();
        var capitalize_model = '';
        keyword.split(/[- ]+/).forEach(function(item) {
            if (item.length > 0) {
                capitalize_model = capitalize_model + item[0].toUpperCase() + item.substring(1);
            }
        });
        document.getElementById('model').value = capitalize_model;
    }
}

</script>
@endpush