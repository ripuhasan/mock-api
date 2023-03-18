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
                            <h5>Input field list</h5>
                            <pre>
<code>firstName, lastName, title, suffix, name, username, email, safeEmail, freeEmail, companyEmail, 
password, phoneNumber, tollFreePhoneNumber, e164PhoneNumber, jobTitle, city, streetName, 
buildingNumber, postcode, address, country, latitude, longitude, timeZone, creditCardType, 
creditCardNumber, creditCardExpirationDate, creditCardExpirationDateString, creditCardDetails,
bankAccountNumber, iban, swiftBicNumber, vat, word, words, sentence, sentences, paragraph, 
aragraphs, text, realText, boolean, randomNumber, randomFloat, randomDigit, randomLetter, 
randomElements, shuffle, uuid, mimeType, fileExtension, file, company, state, dateTime, 
dateBetween, timeBetween, imageUrl, countryCode,freeEmailDomain, safeEmailDomain, 
domainName, domainWord, tld, url, ipv4, ipv6, localIpv4, macAddress, userAgent, 
faxNumber, nullValue, booleanValue, md5, sha1, sha256, locale, languageCode, currencyCode
</code>
                                                  </pre>
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
                                          <input type="text" class="form-control" name="url" placeholder="Enter Api Url" required>
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
                                                <label>Input Field(Using seperator ,) *</label>
                                                <input type="text" class="form-control" name="input_field" placeholder="Example: name, email, phoneNumber" required>
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