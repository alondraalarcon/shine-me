@extends('admin/layout/template')

@section('title', 'Carwash Provider')
@section('content')
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
                        </div>
                    </div>
                </div>  <!-- END OF DIV ROW -->
            </div>
            <div class="tab-pane" id="Approved" role="tabpanel">
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
                        </div>
                    </div>
                </div>  <!-- END OF DIV ROW -->
            </div>  <!-- END OF DIV Approved -->
        </div>
    </div>

@stop