@extends('admin/layout/template')

@section('title', 'Rider List')
@section('content')
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
    </div>

    
@stop