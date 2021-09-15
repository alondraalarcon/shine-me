@extends('admin/layout/template')

@section('content')
<<<<<<< HEAD
    <div class="tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="#Request" data-bs-toggle="tab" 
            role="tab" aria-selected="false">Approved Carwash Provider</a></li>
            <li class="nav-item"><a class="nav-link" href="#Approved" data-bs-toggle="tab" 
            role="tab" aria-selected="true">For Approval</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="Request" role="tabpanel">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
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
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>     
=======
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Carwash Provider</strong></h3>
        </div>
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" href="#Approved" data-bs-toggle="tab" 
                role="tab" aria-selected="false">Approved Carwash Provider</a></li>
                <li class="nav-item"><a class="nav-link" href="#Request" data-bs-toggle="tab" 
                role="tab" aria-selected="true">For Approval</a></li>
            </ul>

            <div class="tab-content ">
                <div class="tab-pane active" id="Approved" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="approved" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                                        <thead>
                                            <tr role="row">
                                                <th> No</th>
                                                <th> Name</th>                                
                                                <th> Address</th>                                
                                                <th> Phone</th>                                
                                                <th> Email </th>                                
                                                <th> Action</th>                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php $count = 1; @endphp
                                            @foreach($approved as $approves)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $approves['name'] }}</td>
                                                <td>{{ $approves['address'] }}</td>
                                                <td>{{ $approves['phone'] }}</td>
                                                <td>{{ $approves['email'] }}</td>
                                                <td>
                                                    <button type="button" style="font-weight: 700;" class="btn btn-primary" 
                                                    data-id="" id="Updaterider"> Update </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>     
                            </div>
>>>>>>> e15b642297ec773320f298b978c585584093e1e5
                        </div>
                    </div>  <!-- END OF DIV ROW -->
                </div>  <!-- END OF DIV Approved -->

                <div class="tab-pane" id="Request" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                                        <thead>
                                            <tr role="row">
                                                <th> No</th>
                                                <th> Name</th>                                
                                                <th> Address</th>                                
                                                <th> Phone</th>                                
                                                <th> Email </th>                                
                                                <th> Action</th>                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $count = 1; @endphp
                                            @foreach($request as $requests)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $requests['name'] }}</td>
                                                <td>{{ $requests['address'] }}</td>
                                                <td>{{ $requests['phone'] }}</td>
                                                <td>{{ $requests['email'] }}</td>
                                                <td>
                                                    <button type="button" style="font-weight: 700;" class="btn btn-primary" 
                                                    data-id="" id="Updaterider"> Approve </button>
                                                </td>
                                            </tr>
                                            @endforeach
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