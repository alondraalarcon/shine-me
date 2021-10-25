@extends('admin/layout/template')

@section('title', 'Customer List')
@section('content')

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
                            </tr>
                        </thead>
                        <tbody>

                            @php $count = 1; @endphp
                            @foreach($customers as $customers)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $customers->name }}</td>
                                <td>{{ $customers->street_add }},{{ $customers->brgyDesc }},{{ $customers->citymunDesc }}</td>
                                <td>{{ $customers->phone }}</td>
                                <td>{{ $customers->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>     
            </div>
        </div>
    </div>  <!-- END OF DIV ROW -->
@stop