@extends('admin.layouts.master')
@section('title', $info->page_title)
@push('custom_css')
<style>
.tags-input-wrapper{
    background: transparent;
    padding: 10px;
    border-radius: 4px;
    /* max-width: 400px; */
    border: 1px solid #ccc
}
.tags-input-wrapper input{
    border: none;
    background: transparent;
    outline: none;
    width: 140px;
    margin-left: 8px;
}
.tags-input-wrapper .tag{
    display: inline-block;
    background-color: #fa0e7e;
    color: white;
    border-radius: 40px;
    padding: 0px 3px 0px 7px;
    margin-right: 5px;
    margin-bottom:5px;
    box-shadow: 0 5px 15px -2px rgba(250 , 14 , 126 , .7)
}
.tags-input-wrapper .tag a {
    margin: 0 7px 3px;
    display: inline-block;
    cursor: pointer;
}
</style>
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
                            <h5>Input field list</h5>
                            <pre>
<code>firstName, lastName, title, suffix, name, username, email, safeEmail, freeEmail, companyEmail, 
password, phoneNumber, tollFreePhoneNumber, e164PhoneNumber, jobTitle, city, streetName, 
buildingNumber, postcode, address, country, latitude, longitude, timeZone, creditCardType, 
creditCardNumber, creditCardExpirationDate, creditCardExpirationDateString, creditCardDetails,
bankAccountNumber, iban, swiftBicNumber, word, words, sentence, sentences, paragraph, 
paragraphs, text, realText, boolean, randomNumber, randomFloat, randomDigit, randomLetter, 
randomElements, shuffle, uuid, mimeType, fileExtension, company, state, dateTime, 
imageUrl, image, countryCode,freeEmailDomain, safeEmailDomain, 
domainName, domainWord, tld, url, ipv4, ipv6, localIpv4, macAddress, 
userAgent, md5, sha1, sha256, locale, languageCode, currencyCode
</code>
                                                  </pre>
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
                                          <input type="text" class="form-control" name="model" value="{{ $row->model }}" required>
                                    </div>
                              </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Input Field(Using seperator ,) *</label>
                                                <input type="text" class="form-control" name="input_field" value="{{ $row->input_field }}" id="tag-input1" required>
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
<script>
(function(){
    "use strict"
    // Plugin Constructor
    var TagsInput = function(opts){
        this.options = Object.assign(TagsInput.defaults , opts);
        this.init();
    }

    // Initialize the plugin
    TagsInput.prototype.init = function(opts){
        this.options = opts ? Object.assign(this.options, opts) : this.options;

        if(this.initialized)
            this.destroy();
            
        if(!(this.orignal_input = document.getElementById(this.options.selector)) ){
            console.error("tags-input couldn't find an element with the specified ID");
            return this;
        }

        this.arr = [];
        this.wrapper = document.createElement('div');
        this.input = document.createElement('input');
        init(this);
        initEvents(this);

        this.initialized =  true;
        return this;
    }

    // Add Tags
    TagsInput.prototype.addTag = function(string){

        if(this.anyErrors(string))
            return ;

        this.arr.push(string);
        var tagInput = this;

        var tag = document.createElement('span');
        tag.className = this.options.tagClass;
        tag.innerText = string;

        var closeIcon = document.createElement('a');
        closeIcon.innerHTML = '&times;';
        
        // delete the tag when icon is clicked
        closeIcon.addEventListener('click' , function(e){
            e.preventDefault();
            var tag = this.parentNode;

            for(var i =0 ;i < tagInput.wrapper.childNodes.length ; i++){
                if(tagInput.wrapper.childNodes[i] == tag)
                    tagInput.deleteTag(tag , i);
            }
        })


        tag.appendChild(closeIcon);
        this.wrapper.insertBefore(tag , this.input);
        this.orignal_input.value = this.arr.join(',');

        return this;
    }

    // Delete Tags
    TagsInput.prototype.deleteTag = function(tag , i){
        tag.remove();
        this.arr.splice( i , 1);
        this.orignal_input.value =  this.arr.join(',');
        return this;
    }

    // Make sure input string have no error with the plugin
    TagsInput.prototype.anyErrors = function(string){
        if( this.options.max != null && this.arr.length >= this.options.max ){
            console.log('max tags limit reached');
            return true;
        }
        
        if(!this.options.duplicate && this.arr.indexOf(string) != -1 ){
            console.log('duplicate found " '+string+' " ')
            return true;
        }

        return false;
    }

    // Add tags programmatically 
    TagsInput.prototype.addData = function(array){
        var plugin = this;
        
        array.forEach(function(string){
            plugin.addTag(string);
        })
        return this;
    }

    // Get the Input String
    TagsInput.prototype.getInputString = function(){
        return this.arr.join(',');
    }


    // destroy the plugin
    TagsInput.prototype.destroy = function(){
        this.orignal_input.removeAttribute('hidden');

        delete this.orignal_input;
        var self = this;
        
        Object.keys(this).forEach(function(key){
            if(self[key] instanceof HTMLElement)
                self[key].remove();
            
            if(key != 'options')
                delete self[key];
        });

        this.initialized = false;
    }

    // Private function to initialize the tag input plugin
    function init(tags){
        tags.wrapper.append(tags.input);
        tags.wrapper.classList.add(tags.options.wrapperClass);
        tags.orignal_input.setAttribute('hidden' , 'true');
        tags.orignal_input.parentNode.insertBefore(tags.wrapper , tags.orignal_input);
    }

    // initialize the Events
    function initEvents(tags){
        tags.wrapper.addEventListener('click' ,function(){
            tags.input.focus();           
        });
        

        tags.input.addEventListener('keydown' , function(e){
            var str = tags.input.value.trim(); 

            if( !!(~[9 , 13 , 188].indexOf( e.keyCode ))  )
            {
                e.preventDefault();
                tags.input.value = "";
                if(str != "")
                    tags.addTag(str);
            }

        });
    }


    // Set All the Default Values
    TagsInput.defaults = {
        selector : '',
        wrapperClass : 'tags-input-wrapper',
        tagClass : 'tag',
        max : null,
        duplicate: false
    }

    window.TagsInput = TagsInput;

    })();

    var tagInput1 = new TagsInput({
        selector: 'tag-input1',
        duplicate : false,
        max : 10
    });
    tagInput1.addData(['firstName' , 'lastName' , 'phoneNumber', 'email'])
</script>
@endpush