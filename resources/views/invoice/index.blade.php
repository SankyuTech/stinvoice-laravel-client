@extends('stinvoice-client::layouts.app')

@section('content')

<h3 class="mb-3">Invoices</h3>


<div class="row">
    <div class="col-6">
      
    </div>
  </div>


<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body px-4 pt-0 pb-2">

              <div class="row mt-3 mb-3" style="align-items:flex-end;">
                <div class="col-sm-10 col-md-8">
                  <div class="form-group">
                    <label class="form-control-label">Reference Number <small>(For multiple reference number, please add comma (,) as seperator)</small></label>
                    <input class="form-control" type="text">

                  </div>
                </div>
                <div class="col-sm-2 col-md-4">
                  <button class="btn btn-primary">Filter</button>
                </div>
                  
              </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reference</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Person</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">E-Invoice Type</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">E-Invoice</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        1
                      </td>
                      <td>
                        1
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                        <p class="text-xs text-secondary mb-0">Organization</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle text-center">
                        <a  href="#" class="text-secondary font-weight-bold text-xs">View</a>
                      </td>
                      <td class="align-middle text-end">
                        <a  href="{{route('stinvoice.invoice.view',['ulid' => 1])}}" class="btn btn-dark btn-sm text-white" >View</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
@endsection