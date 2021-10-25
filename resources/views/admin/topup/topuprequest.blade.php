@extends('admin/layout/template')

@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Top-Up</strong></h3>
        </div>
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link " href="#Approved" data-bs-toggle="tab" 
                role="tab" aria-selected="false">Top-Up List</a></li>
                <li class="nav-item"><a class="nav-link active" href="#Request" data-bs-toggle="tab" 
                role="tab" aria-selected="true">For Approval</a></li>
            </ul>

            <div class="tab-content ">
                <div class="tab-pane " id="Approved" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="wallet" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                                        <thead>
                                            <tr role="row">
                                                <th> No</th>
                                                <th> Name</th>                                
                                                <th> Phone</th>                                
                                                <th> Amount </th>   
                                                <th> Date </th>   
                                                <th> Type </th>                                       
                                                <!-- <th> Action</th>                                 -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php $count = 1; @endphp
                                            @foreach($approves as $approve)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $approve->uname }}</td>
                                                <td>{{ $approve->uphone }}</td>
                                                <td>{{ $approve->amount }}</td>
                                                <td>{{ $approve->date_time }}</td>
                                                <td style="color:{{ ($approve->type ==2 )? '#00b300' : 'red'}}">{{ ($approve->type ==2 )? 'Approved' : 'Rejected'}}</td>
                                                <!-- <td>
                                                    <button type="button" class="btn btn-primary" onclick="updateCarwash({{$approve->id}});"> Details </button>
                                                </td> -->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>     
                            </div>
                        </div>
                    </div>  <!-- END OF DIV ROW -->
                </div>  <!-- END OF DIV Approved -->

                <div class="tab-pane active" id="Request" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="walletrequest" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                                        <thead>
                                            <tr role="row">
                                                <th> No</th>
                                                <th> Name</th>                                
                                                <th> Phone</th>                                
                                                <th> Amount </th>   
                                                <th> Date </th>                               
                                                <th> Action</th>                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $count = 1; @endphp
                                            @foreach($requests as $request)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $request->uname }}</td>
                                                <td>{{ $request->uphone }}</td>
                                                <td>{{ $request->amount }}</td>
                                                <td>{{ $request->date_time }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" onclick="approveTopUp({{$request->id}});"> Approve </button>
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
<!-- APPROVE TOP-UP MODAL -->
<div class="modal fade" id="approveTopUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="form_approveTopUp" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="alert alert-success alert-message alert-dismissable d-none" id="success"></div>
                <div class="alert alert-danger alert-message alert-dismissable d-none" id="error"></div>
              
                <input type="hidden" name="id"/>
                <div class="mb-3">
                    <label class="form-label">Carwasher Name</label>
                    <input class="form-control form-control-lg" type="text"  id="uname"
                    name="uname" placeholder="Enter Carwasher Name" required readonly/>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Carwasher Phone</label>
                    <div class=" input-group mb-3">
                        <input class="form-control form-control-lg" type="text" name="uphone" id="uphone"
                        placeholder="Enter Carwasher Phone" required readonly/>
                    </div>
                </div>
                   
                <div class="mb-3">
                    <label class="form-label">Amount Requested</label>
                    <input class="form-control form-control-lg" type="text"  id="amount"
                    name="amount" placeholder="Enter Amount Requested" required/>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="approvedTopUp">Approve</button>
                <button type="button" class="btn btn-dark" onclick="rejectTopUp();">Reject</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- REJECT RIDER MODAL -->
<div class="modal fade" id="rejectTopUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="form_rejectTopUp" >
            @csrf
            <div class="modal-body">
                <div class="alert alert-success alert-message alert-dismissable d-none" id="success"></div>
                <div class="alert alert-danger alert-message alert-dismissable d-none" id="error"></div>
              
                <input type="hidden" name="rejectid"/>
                <div class="mb-3">
                    <label class="form-label">Carwasher Name</label>
                    <input class="form-control form-control-lg" type="text"  id="rejectuname"
                    name="rejectuname" placeholder="Enter Carwasher Name" required readonly/>
                </div>
                
                   
                <div class="mb-3">
                    <label class="form-label">Amount Requested</label>
                    <input class="form-control form-control-lg" type="text"  id="rejectamount"
                    name="rejectamount" placeholder="Enter Amount Requested" required readonly/>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message:</label>
                    <textarea class="form-control form-control-lg" id="message"
                    name="message" required ></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="rejectButton">Reject</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

<script>
    function approveTopUp(idx)
    {
        $.get('topUp/show/'+idx, function (data) {
            $('#approveTopUp').modal('show');
            $('input[name=id]').val(data.id);
            $('input[name=uname]').val(data.uname);
            $('input[name=uphone]').val(data.uphone);
            $('input[name=amount]').val(data.amount);
        });
    }


    function rejectTopUp()
    {
        var id= $('input[name=id]').val();
        $.get('topUp/rejectshow/'+id, function (data) {
            $('#rejectTopUp').modal('show');
            $('input[name=rejectid]').val(data.id);
            $('input[name=rejectuname]').val(data.uname);
            $('input[name=rejectamount]').val(data.amount);
        });
    }


$(document).ready(function() {
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $('#form_approveTopUp').submit(function(event) {
    event.preventDefault()
        var id= $('input[name=id]').val();
        var amount= $('input[name=amount]').val();

        // AJAX request 
        $.ajax({ 
            url: '/topUp/approve/' + id,
            method: 'POST',
            data:{ amount:amount },
            success: function (data) {
                if(data.code == 1)
                {
                    $('#success').removeClass('d-none');
                    $('#success').html(data.message);
                    $('#image_name').val(data.image);
                    setTimeout(function(){ window.location.reload();  }, 2000);  
                }else{
                    $('#error').removeClass('d-none');
                    $('#error').html(data.message);
                    setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);
                }
            }
        });
        
    });  

    $('#form_rejectTopUp').submit(function(event) {
    event.preventDefault()
        var id= $('input[name=rejectid]').val();
        var message= $('textarea[name=message]').val();

        // AJAX request 
        $.ajax({ 
            url: '/topUp/reject/' + id,
            method: 'POST',
            data:{ message:message },
            success: function (data) {
                if(data.code == 1)
                {
                    $('#success').removeClass('d-none');
                    $('#success').html(data.message);
                    $('#image_name').val(data.image);
                    setTimeout(function(){ window.location.reload();  }, 2000);  
                }else{
                    $('#error').removeClass('d-none');
                    $('#error').html(data.message);
                    setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);
                }
            }
        });
        
    }); 


});
</script>
@stop
