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
                                                <td>{{ $approves->name }}</td>
                                                <td>{{ $approves->street_add }},{{ $approves->brgyDesc }},{{ $approves->citymunDesc }}</td>
                                                <td>{{ $approves->phone }}</td>
                                                <td>{{ $approves->email }}</td>
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
                                    <table id="pending" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
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
                                                <td>{{ $requests->name }}</td>
                                                <td>{{ $approves->street_add }},{{ $approves->brgyDesc }},{{ $approves->citymunDesc }}</td>
                                                <td>{{ $requests->phone }}</td>
                                                <td>{{ $requests->email }}</td>
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
        <form method="POST" id="form_approveCarwash" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="alert alert-success alert-message alert-dismissable d-none" id="success"></div>
                <div class="alert alert-danger alert-message alert-dismissable d-none" id="error"></div>
                <div class="row">
                    <div class="col-md-10 col-10">
                        <div class="mb-3">
                            <label class="form-label">Rider Image</label>
                            <input class="form-control form-control-lg" type="file" id="image"
                            name="image" required/>
                        </div>
                    </div>
                    <div class="col-md-2 col-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-dark" id="UploadImage">Upload</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Motor Brand Name</label>
                    <input class="form-control form-control-lg" type="text"  id="motor_brand"
                    name="motor_brand" placeholder="Enter your Motor Brand Name" required/>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-6">
                    <label class="form-label">Model Name</label>
                        <div class=" input-group mb-3">
                            <input class="form-control form-control-lg" type="text" name="motor_model" id="motor_model"
                            placeholder="Enter Model Name" required/>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <label class="form-label">Model Year</label>
                        <div class=" input-group mb-3">
                            <input class="form-control form-control-lg" type="month" name="motor_year" id="motor_year"
                            required/>
                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-md-6 col-6">
                    <label class="form-label">O.R</label>
                        <div class=" input-group mb-3">
                            <input class="form-control form-control-lg" type="text" name="motor_or" id="motor_or"
                            placeholder="Enter the O.R" required/>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <label class="form-label">C.R</label>
                        <div class=" input-group mb-3">
                            <input class="form-control form-control-lg" type="text" name="motor_cr" id="motor_cr"
                            placeholder="Enter thr C.R" required/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Driver License Number</label>
                    <input class="form-control form-control-lg" type="text"  id="motor_license"
                    name="motor_license" placeholder="Enter your Driver License Number" required/>
                </div>

                <input type="hidden" name="rider_id"/>
                <input type="hidden" id="image_name"/>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="approvedSubmit">Submit</button>
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

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="title">Region:</label>
                            <select name="region" class="form-control" >
                                <option value="">--- Select Region ---</option>
                                @foreach ($region as $regions)
                                    <option value="{{ $regions->regCode }}">{{ $regions->regDesc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="title">Province:</label>
                            <select name="province" class="form-control">
                            @foreach ($province as $provinces)
                                <option value="{{ $provinces->provCode }}">{{ $provinces->provDesc }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="title">Municipal:</label>
                            <select name="municipal" class="form-control" >
                            @foreach ($municipal as $municipals)
                                <option value="{{ $municipals->citymunCode }}">{{ $municipals->citymunDesc }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label for="title">Barangay:</label>
                                <select name="brgy" class="form-control" >
                                @foreach ($brgy as $brgys)
                                    <option value="{{ $brgys->brgyCode }}">{{ $brgys->brgyDesc }}</option>
                                @endforeach
                                </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Street Address</label>
                    <input class="form-control form-control-lg" type="text" name="street" placeholder="Enter your village and street" required/>
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

<script type="text/javascript">


   function approveCarwash(idx)
   {
        $.get('carwash/show/'+idx, function (data) {
            $('#approveCarwash').modal('show');
            $('input[name=rider_id]').val(data.datas.id);
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
            $('input[name=street]').val(data.datas.street_add);
            $('select[name=region]').val(data.datas.region);
            $('select[name=province]').val(data.datas.province);
            $('select[name=municipal]').val(data.datas.municipal);
            $('select[name=brgy]').val(data.datas.brgy);
        });
   }


   $(document).ready(function() {

        //REGION ON CHANGE
        $('select[name="region"]').on('change', function() {
            $('select[name="province"]').empty();
            $('select[name="municipal"]').empty();
            $('select[name="brgy"]').empty();

            var regCode = $(this).val();
            if(regCode) {
                $.ajax({
                    url: '/regionChange/'+regCode,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="province"]').append('<option value="">--- Select Province ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="province"]').append('<option value="'+ value.provCode +'">'+ value.provDesc +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="province"]').empty();
            }
        });

        //PROVINCE ON CHANGE
        $('select[name="province"]').on('change', function() {
            $('select[name="municipal"]').empty();
            var provinceCode = $(this).val();
            if(provinceCode) {
                $.ajax({
                    url: '/provinceChange/'+provinceCode,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="municipal"]').append('<option value="">- Select Municipality -</option>');
                        $.each(data, function(key, value) {
                            $('select[name="municipal"]').append('<option value="'+ value.citymunCode +'">'+ value.citymunDesc +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="municipal"]').empty();
            }
        });

        //MUNICIPALITY ON CHANGE
        $('select[name="municipal"]').on('change', function() {
            $('select[name="brgy"]').empty();
            var municipalityCode = $(this).val();
            if(municipalityCode) {
                $.ajax({
                    url: '/municipalityChange/'+municipalityCode,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="brgy"]').append('<option value="">- Select Barangay -</option>');
                        $.each(data, function(key, value) {
                            $('select[name="brgy"]').append('<option value="'+ value.brgyCode +'">'+ value.brgyDesc +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="brgy"]').empty();
            }
        });
    });

</script>
<script>

$(document).ready(function() {
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    $('#UploadImage').click(function(){
        var id= $('input[name=rider_id]').val();
        var files = $('#image')[0].files;
            
        if(files.length > 0){
            
            var fd = new FormData();
            // Append data 
            fd.append('file',files[0]);
            fd.append('_token',CSRF_TOKEN);
            // AJAX request 
            $.ajax({ 
                url: '/carwash/uploadimage/' + id,
                method: 'post',
                data: fd,id,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    if(data.code == 1)
                    {
                        $('#success').removeClass('d-none');
                        $('#success').html(data.message);
                        $('#image_name').val(data.image);
                        setTimeout(function(){ $('#success').addClass('d-none'); }, 2000);  
                    }else{
                        $('#error').removeClass('d-none');
                        $('#error').html(data.message);
                        setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);
                    }
                }
            });
        }else{
            alert("Please select a file.");
        }
    });


    $('#form_approveCarwash').submit(function(event) {
    event.preventDefault()
        var id= $('input[name=rider_id]').val();
        var motor_brand = $("#motor_brand").val();
        var motor_model = $("#motor_model").val();
        var motor_year = $("#motor_year").val();
        var motor_or = $("#motor_or").val();
        var motor_cr = $("#motor_cr").val();
        var motor_license = $("#motor_license").val();
        var image_name = $("#image_name").val();

        if(image_name == ""){
            $('#error').removeClass('d-none');
            $('#error').html("Please upload profile first.");
            setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);
        }else{
            // AJAX request 
            $.ajax({ 
                url: '/carwash/approved/' + id,
                method: 'POST',
                data: {
                    motor_brand: motor_brand,
                    motor_model: motor_model,
                    motor_year: motor_year,
                    motor_or: motor_or,
                    motor_cr: motor_cr,
                    motor_license: motor_license,
                    image_name:image_name
                },
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
        }
    });  
 
});
</script>
@stop
