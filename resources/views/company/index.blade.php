@extends('stinvoice-client::layouts.app')

@section('content')

<h3 class="mb-3">Company</h3>


<div class="row">
    <div class="col-6">
      
    </div>
  </div>


<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body px-4 pt-0 pb-2">

              <div class="mt-4 mb-4">
                <h5>1. Company Information</h5>
              </div>
              
              <form method="post" action="{{route('stinvoice.company.store')}}">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Registration Name</label>
                      <input type="text" name="registration_name"  class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email"  class="form-control" required>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone"  class="form-control" required>
                      </div>
                  </div>
                </div>

                <div class="row">
                  
                  <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <label>Identification Type</label>
                        <div class="form-check mb-1">
                          <input class="form-check-input" type="radio" name="id_type" id="customRadio1">
                          <label class="custom-control-label" for="customRadio1">Business Registration Number</label>
                        </div>
                        <div class="form-check mb-1">
                          <input class="form-check-input" type="radio" name="id_type" id="customRadio1">
                          <label class="custom-control-label" for="customRadio1">NRIC</label>
                        </div>
                        <div class="form-check mb-1">
                          <input class="form-check-input" type="radio" name="id_type" id="customRadio1">
                          <label class="custom-control-label" for="customRadio1">Passport</label>
                        </div>
                        <div class="form-check mb-1">
                          <input class="form-check-input" type="radio" name="id_type" id="customRadio1">
                          <label class="custom-control-label" for="customRadio1">Army</label>
                        </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <label>Identification Number</label>
                        <input type="text" name="id_no"  class="form-control" required>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label>Tax Identification Number</label>
                        <input type="text" name="tax_no"  class="form-control" required>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label>SST Registration Number</label>
                        <input type="text" name="sst_reg_no"  class="form-control" required>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label>MSIC Code</label>
                        <input type="text" name="msic"  class="form-control" required>
                      </div>
                  </div>
                </div>

                 <div class="mt-4 mb-4">
                  <h5>2. Address</h5>
                </div>
                
                
                
                <div class="form-group">
                  <label>Address 1</label>
                  <input type="text" name="address_1"  class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Address 2</label>
                  <input type="text" name="address_2"  class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Address 3</label>
                  <input type="text" name="address_3"  class="form-control" required>
                </div>

                <div class="row">
                  <div class="col-sm-12 col-md-3">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city"  class="form-control" required>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-3">
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state"  class="form-control" required>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-3">
                      <div class="form-group">
                        <label>Postcode</label>
                        <input type="text" name="postcode"  class="form-control" required>
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-3">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" value="Malaysia"  class="form-control" readonly disabled>
                      </div>
                  </div>

                  <div class="mt-4 mb-4">
                    <h5>3. StInvoice Integration</h5>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                          <label>Key</label>
                          <input type="text" name="tax_no"  class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                          <label>Secret</label>
                          <input type="text" name="sst_reg_no"  class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                          <label>Production Mode</label>
                          <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="integration_production" id="customRadio1">
                            <label class="custom-control-label" for="customRadio1">Yes</label>
                          </div>
                        <div class="form-check mb-1">
                          <input class="form-check-input" type="radio" name="integration_production" id="customRadio1">
                            <label class="custom-control-label" for="customRadio1">No</label>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div class="text-end">
                    <button class="btn btn-primary">Save</button>
                  </div>

                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
@endsection