@extends('admin/layout/template')

@section('content')
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
                                                    <button type="button" class="btn btn-primary" onclick="updateCarwash({{$approves->id}});"> Update </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>     
                            </div>
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
                                                <button type="button" class="btn btn-primary" onclick="approveCarwash({{$requests->id}});"> Approve </button>
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
<!-- APPROVE RIDER MODAL -->
<div class="modal fade" id="approveCarwash" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="form_approveCarwash">
            @csrf
            <div class="modal-body">
                <p>Are you sure you want to approve?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- UPDATE RIDER MODAL -->
<div class="modal fade" id="updateCarwash" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="form_updateCarwash">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input class="form-control form-control-lg" type="text"  id="name"
                    name="name" placeholder="Enter your name" required/>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-6">

                    <label class="form-label">Phone</label>
                        <div class=" input-group mb-3">
                            <span class="input-group-text" id="addon1">+63</span>
                            <input class="form-control form-control-lg" type="text" name="phone" id="phone"
                            placeholder="Enter phone number" aria-describedby="addon1" required/>
                        </div>
                    </div>

                    <div class="col-md-6 col-6">			
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control form-control-lg" type="email" id="email"
                            name="email" placeholder="Enter your email" required />
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input class="form-control form-control-lg" type="text" id="address"
                    name="address" placeholder="Enter your address" required/>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>


<script type="text/javascript">

   function approveCarwash(idx)
   {
        $.get('carwash/show/'+idx, function (data) {
            $('#approveCarwash').modal('show');
            $("#form_approveCarwash").attr("action", "/carwash/approved/" + data.datas.id);
        });
   }

   function updateCarwash(idx)
   {
        $.get('carwash/show/'+idx, function (data) {
            $('#updateCarwash').modal('show');
            $("#form_updateCarwash").attr("action", "/carwash/update/" + data.datas.id);
            $('input[name=name]').val(data.datas.name);
            $('input[name=phone]').val(data.phone);
            $('input[name=email]').val(data.datas.email);
            $('input[name=address]').val(data.datas.address);
        });
   }

</script>
@stop