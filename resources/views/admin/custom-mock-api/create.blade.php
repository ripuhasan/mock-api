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
                                                <input type="text" class="form-control" name="input_field" placeholder="Example: name, email, phoneNumber" required>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Type *</label>
                                                <select name="type" class="form-control">
                                                      <option value="firstName">First Name</option>
                                                      <option value="lastName">Last Name</option>
                                                      <option value="email">Email Address</option>
                                                      <option value="phoneNumber">Phone Number</option>
                                                      <option value="city">City</option>
                                                      <option value="postcode">Postcode</option>
                                                      <option value="country">Country</option>
                                                      <option value="creditCardNumber">Credit Card Number</option>
                                                      <option value="jobTitle">Job Title</option>
                                                      <option value="company">Company Name</option>
                                                      <option value="ipv4">IPv4 Address</option>
                                                      <option value="imageUrl">Image URL</option>
                                                      <option value="streetAddress">Street Address</option>
                                                      <option value="buildingNumber">Building Number</option>
                                                      <option value="latitude">Latitude</option>
                                                      <option value="longitude">Longitude</option>
                                                      <option value="creditCardExpirationDate">Credit Card Expiration Date</option>
                                                      <option value="bankAccountNumber">Bank Account Number</option>
                                                      <option value="iban">IBAN</option>
                                                      <option value="swiftBicNumber">SWIFT/BIC Number</option>
                                                      <option value="word">Word</option>
                                                      <option value="words">Words</option>
                                                      <option value="sentence">Sentence</option>
                                                      <option value="sentences">Sentences</option>
                                                      <option value="paragraph">Paragraph</option>
                                                      <option value="paragraphs">Paragraphs</option>
                                                      <option value="text">Text</option>
                                                      <option value="realText">Real Text</option>
                                                      <option value="boolean">Boolean (True/False)</option>
                                                      <option value="randomNumber">Random Number</option>
                                                      <option value="randomFloat">Random Float</option>
                                                      <option value="randomDigit">Random Digit</option>
                                                      <option value="randomLetter">Random Letter</option>
                                                      <option value="randomElements">Random Elements</option>
                                                      <option value="shuffle">Shuffle</option>
                                                      <option value="uuid">UUID</option>
                                                      <option value="mimeType">MIME Type</option>
                                                      <option value="fileExtension">File Extension</option>
                                                      <option value="state">State</option>
                                                      <option value="dateTime">Date and Time</option>
                                                      <option value="freeEmailDomain">Free Email Domain</option>
                                                      <option value="safeEmailDomain">Safe Email Domain</option>
                                                      <option value="domainName">Domain Name</option>
                                                      <option value="domainWord">Domain Word</option>
                                                      <option value="tld">Top-Level Domain</option>
                                                      <option value="url">URL</option>
                                                      <option value="ipv6">IPv6 Address</option>
                                                      <option value="localIpv4">Local IPv4 Address</option>
                                                      <option value="macAddress">MAC Address</option>
                                                      <option value="userAgent">User Agent</option>
                                                      <option value="md5">MD5 Hash</option>
                                                      <option value="sha1">SHA1 Hash</option>
                                                      <option value="sha256">SHA256 Hash</option>
                                                      <option value="locale">Locale</option>
                                                      <option value="languageCode">Language Code</option>
                                                      <option value="currencyCode">Currency Code</option>
                                                      <option value="jobDescription">Job Description</option>
                                                      <option value="creditCardType">Credit Card Type</option>
                                                      <option value="creditCardExpirationDateString">Credit Card Expiration Date String</option>
                                                      <option value="creditCardDetails">Credit Card Details</option>
                                                      <option value="wordList">Word List</option>
                                                      <option value="linuxPlatformToken">Linux Platform Token</option>
                                                      <option value="windowsPlatformToken">Windows Platform Token</option>
                                                      <option value="macPlatformToken">Mac Platform Token</option>
                                                      <option value="hexColor">Hex Color</option>
                                                      <option value="rgbColor">RGB Color</option>
                                                      <option value="rgbColorAsArray">RGB Color as Array</option>
                                                      <option value="rgbaColor">RGBA Color</option>
                                                      <option value="rgbaColorAsArray">RGBA Color as Array</option>
                                                      <option value="hslColor">HSL Color</option>
                                                      <option value="hslaColor">HSLA Color</option>
                                                      <option value="filePath">File Path</option>
                                                      <option value="commonFileName">Common File Name</option>
                                                      <option value="fileType">File Type</option>
                                                      <option value="file">File</option>
                                                      <option value="binary">Binary</option>
                                                      <option value="image">Image</option>
                                                      <option value="password">Password</option>
                                                      <option value="uri">URI</option>
                                                      <option value="ipv4Address">IPv4 Address</option>
                                                      <option value="ipv6Address">IPv6 Address</option>
                                                      <option value="userName">User Name</option>
                                                      <option value="fullName">Full Name</option>
                                                      <option value="zipcode">Zipcode</option>
                                                      <option value="coordinate">Coordinate</option>
                                                      <option value="catchPhrase">Catch Phrase</option>
                                                      <option value="bs">BS</option>
                                                </select>
                                          </div>
                                    </div>
                              </div>


{{-- [
  {"name": "First Name", "key": "firstName", "is_active": "1"},
  {"name": "Last Name", "key": "lastName", "is_active": "1"},
  {"name": "Title", "key": "title", "is_active": "1"},
  {"name": "Suffix", "key": "suffix", "is_active": "1"},
  {"name": "Name", "key": "name", "is_active": "1"},
  {"name": "Username", "key": "username", "is_active": "1"},
  {"name": "Email", "key": "email", "is_active": "1"},
  {"name": "Safe Email", "key": "safeEmail", "is_active": "1"},
  {"name": "Free Email", "key": "freeEmail", "is_active": "1"},
  {"name": "Company Email", "key": "companyEmail", "is_active": "1"},
  {"name": "Password", "key": "password", "is_active": "1"},
  {"name": "Phone Number", "key": "phoneNumber", "is_active": "1"},
  {"name": "Toll-free Phone Number", "key": "tollFreePhoneNumber", "is_active": "1"},
  {"name": "E.164 Phone Number", "key": "e164PhoneNumber", "is_active": "1"},
  {"name": "Job Title", "key": "jobTitle", "is_active": "1"},
  {"name": "City", "key": "city", "is_active": "1"},
  {"name": "Street Name", "key": "streetName", "is_active": "1"},
  {"name": "Building Number", "key": "buildingNumber", "is_active": "1"},
  {"name": "Postcode", "key": "postcode", "is_active": "1"},
  {"name": "Address", "key": "address", "is_active": "1"},
  {"name": "Country", "key": "country", "is_active": "1"},
  {"name": "Latitude", "key": "latitude", "is_active": "1"},
  {"name": "Longitude", "key": "longitude", "is_active": "1"},
  {"name": "Time Zone", "key": "timeZone", "is_active": "1"},
  {"name": "Credit Card Type", "key": "creditCardType", "is_active": "1"},
  {"name": "Credit Card Number", "key": "creditCardNumber", "is_active": "1"},
  {"name": "Credit Card Expiration Date", "key": "creditCardExpirationDate", "is_active": "1"},
  {"name": "Credit Card Expiration Date String", "key": "creditCardExpirationDateString", "is_active": "1"},
  {"name": "Credit Card Details", "key": "creditCardDetails", "is_active": "1"},
  {"name": "Bank Account Number", "key": "bankAccountNumber", "is_active": "1"},
  {"name": "IBAN", "key": "iban", "is_active": "1"},
  {"name": "SWIFT/BIC Number", "key": "swiftBicNumber", "is_active": "1"},
  {"name": "Word", "key": "word", "is_active": "1"},
  {"name": "Words", "key": "words", "is_active": "1"},
] --}}

                              <div id="dynamicForm"></div>

                              <button type="button" name="add" id="add" class="btn btn-success"><i class="ti-plus"></i></button>

                              <div class="row">
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
                                                <input type="text" class="form-control" name="input_field" placeholder="Example: name, email, phoneNumber" required>
                                          </div>
                                    </div>
                                    <div class="col-md-5">
                                          <div class="form-group">
                                                <label>Type *</label>
                                                <select name="type" class="form-control">
                                                      <option value="firstName">First Name</option>
                                                      <option value="lastName">Last Name</option>
                                                      <option value="email">Email Address</option>
                                                      <option value="phoneNumber">Phone Number</option>
                                                      <option value="city">City</option>
                                                      <option value="postcode">Postcode</option>
                                                      <option value="country">Country</option>
                                                      <option value="creditCardNumber">Credit Card Number</option>
                                                      <option value="jobTitle">Job Title</option>
                                                      <option value="company">Company Name</option>
                                                      <option value="ipv4">IPv4 Address</option>
                                                      <option value="imageUrl">Image URL</option>
                                                      <option value="streetAddress">Street Address</option>
                                                      <option value="buildingNumber">Building Number</option>
                                                      <option value="latitude">Latitude</option>
                                                      <option value="longitude">Longitude</option>
                                                      <option value="creditCardExpirationDate">Credit Card Expiration Date</option>
                                                      <option value="bankAccountNumber">Bank Account Number</option>
                                                      <option value="iban">IBAN</option>
                                                      <option value="swiftBicNumber">SWIFT/BIC Number</option>
                                                      <option value="word">Word</option>
                                                      <option value="words">Words</option>
                                                      <option value="sentence">Sentence</option>
                                                      <option value="sentences">Sentences</option>
                                                      <option value="paragraph">Paragraph</option>
                                                      <option value="paragraphs">Paragraphs</option>
                                                      <option value="text">Text</option>
                                                      <option value="realText">Real Text</option>
                                                      <option value="boolean">Boolean (True/False)</option>
                                                      <option value="randomNumber">Random Number</option>
                                                      <option value="randomFloat">Random Float</option>
                                                      <option value="randomDigit">Random Digit</option>
                                                      <option value="randomLetter">Random Letter</option>
                                                      <option value="randomElements">Random Elements</option>
                                                      <option value="shuffle">Shuffle</option>
                                                      <option value="uuid">UUID</option>
                                                      <option value="mimeType">MIME Type</option>
                                                      <option value="fileExtension">File Extension</option>
                                                      <option value="state">State</option>
                                                      <option value="dateTime">Date and Time</option>
                                                      <option value="freeEmailDomain">Free Email Domain</option>
                                                      <option value="safeEmailDomain">Safe Email Domain</option>
                                                      <option value="domainName">Domain Name</option>
                                                      <option value="domainWord">Domain Word</option>
                                                      <option value="tld">Top-Level Domain</option>
                                                      <option value="url">URL</option>
                                                      <option value="ipv6">IPv6 Address</option>
                                                      <option value="localIpv4">Local IPv4 Address</option>
                                                      <option value="macAddress">MAC Address</option>
                                                      <option value="userAgent">User Agent</option>
                                                      <option value="md5">MD5 Hash</option>
                                                      <option value="sha1">SHA1 Hash</option>
                                                      <option value="sha256">SHA256 Hash</option>
                                                      <option value="locale">Locale</option>
                                                      <option value="languageCode">Language Code</option>
                                                      <option value="currencyCode">Currency Code</option>
                                                      <option value="jobDescription">Job Description</option>
                                                      <option value="creditCardType">Credit Card Type</option>
                                                      <option value="creditCardExpirationDateString">Credit Card Expiration Date String</option>
                                                      <option value="creditCardDetails">Credit Card Details</option>
                                                      <option value="wordList">Word List</option>
                                                      <option value="linuxPlatformToken">Linux Platform Token</option>
                                                      <option value="windowsPlatformToken">Windows Platform Token</option>
                                                      <option value="macPlatformToken">Mac Platform Token</option>
                                                      <option value="hexColor">Hex Color</option>
                                                      <option value="rgbColor">RGB Color</option>
                                                      <option value="rgbColorAsArray">RGB Color as Array</option>
                                                      <option value="rgbaColor">RGBA Color</option>
                                                      <option value="rgbaColorAsArray">RGBA Color as Array</option>
                                                      <option value="hslColor">HSL Color</option>
                                                      <option value="hslaColor">HSLA Color</option>
                                                      <option value="filePath">File Path</option>
                                                      <option value="commonFileName">Common File Name</option>
                                                      <option value="fileType">File Type</option>
                                                      <option value="file">File</option>
                                                      <option value="binary">Binary</option>
                                                      <option value="image">Image</option>
                                                      <option value="password">Password</option>
                                                      <option value="uri">URI</option>
                                                      <option value="ipv4Address">IPv4 Address</option>
                                                      <option value="ipv6Address">IPv6 Address</option>
                                                      <option value="userName">User Name</option>
                                                      <option value="fullName">Full Name</option>
                                                      <option value="zipcode">Zipcode</option>
                                                      <option value="coordinate">Coordinate</option>
                                                      <option value="catchPhrase">Catch Phrase</option>
                                                      <option value="bs">BS</option>
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