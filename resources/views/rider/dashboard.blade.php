@extends('rider/layout/template')

@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong></strong></h3>
        </div>
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <h4><strong>Request Booking</strong></h4><br/>
                                    <table id="example" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                                        <thead>
                                            <tr role="row">
                                                <th> Name</th>                                
                                                <th> Address</th>                                
                                                <th> Phone</th>                                
                                                <th> Email </th>                                
                                                <th> Action</th>                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Airi Satou</td>
                                                <td>Quezon City</td>
                                                <td>+639999393455</td>
                                                <td>Test</td>
                                                <td>
                                                    <button type="button" style="font-weight: 700;" class="btn btn-primary" 
                                                    data-id="" id="Updaterider"> Accept </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>     
                            </div>
                        </div>
                    </div>  <!-- END OF DIV ROW -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <h4><strong>Booking History</strong></h4><br/>
                                    <table id="approved" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                                        <thead>
                                            <tr role="row">
                                                <th> Name</th>                                
                                                <th> Address</th>                                
                                                <th> Phone</th>                                
                                                <th> Email </th>                                
                                                <th> Action</th>                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Airi Satou</td>
                                                <td>Quezon City</td>
                                                <td>+639999393455</td>
                                                <td>Test</td>
                                                <td>
                                                    <button type="button" style="font-weight: 700;" class="btn btn-dark" 
                                                    data-id="" id="Updaterider"> View </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>     
                            </div>
                        </div>
                    </div>  <!-- END OF DIV ROW -->

                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop