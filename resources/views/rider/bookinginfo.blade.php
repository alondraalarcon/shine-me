@extends('rider/layout/template')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-auto d-none d-sm-block">
            <h3><strong></strong></h3>
        </div>
            <div class="col-xl-12 col-xxl-12">
                <div class="w-100">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-success alert-message alert-dismissable d-none" id="success"></div>
                                    <div class="alert alert-danger alert-message alert-dismissable d-none" id="error"></div>

                                    <form method="POST" action="">
                                    @csrf
                                    <div class='row'>
                                        <div class="col-md-12 col-12">
                                            <h3 style="text-align: center;"><b> Booking Information </b></h3>
                                        </div>

                                        <div class="container-fluid">
                                            <div class="col-12 mt-3">
                                                <div class="card">
                                                    <div class="card-horizontal" style=" display: flex;flex: 1 1 auto;">
                                                        <div class="img-square-wrapper">
                                                            <img class="" src="/asset/img/test.jpg" width="100" height="100">
                                                        </div>
                                                        <div class="card-body">
                                                            <input type="hidden" name="booking_id" value="{{ $bookinginfo->id }}"/>
                                                            <input type="hidden" name="customer_id" value="{{ $bookinginfo->user_id }}"/>
                                                            <h4 class="card-title" id="customer_name">{{ $bookinginfo->u_name }}</h4>
                                                            <p class="card-text" id="customer_phone">
                                                                <a href="tel:{{ $bookinginfo->u_phone }}">{{ $bookinginfo->u_phone }}</a>
                                                            </p>
                                                            <p class="card-text" id="customer_landmark">Landmark: {{ $bookinginfo->c_landmark }}</p>
                                                            <p class="card-text" id="current_customer_add">
                                                            <a href= "https://www.google.com/maps/place/{{$bookinginfo->c_lat}},{{$bookinginfo->c_long}}" target="_blank">
                                                            Check My Current Location</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <h4 class="card-text" style="text-align: center;"><b>Details</b></h4>
                                                </div>
                                                <div class="mb-3">
                                                <p class="card-text" style=" font-size: 15px;">Vehicle Type: {{$bookinginfo->v_type}}</p>
                                                    <br/><br/>
                                                <p class="card-text" style="font-size: 20px;"><b>Total Booking: {{$bookinginfo->total_booking_amount}}</b></p>
                                                    <br/>
                                                  
                                                    <br/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-primary" id="done_booking">Finish Cleaning</button>
                                            </div>

                                        </div>                                    
                                    </form>

                                </div>     
                            </div>
                        </div>
                    </div>  <!-- END OF DIV ROW -->


                    

                </div>
            </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script>
$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $('#done_booking').on('click', function(){
		var booking_id= $('input[name=booking_id]').val();
		var customer_id= $('input[name=customer_id]').val();

		$.ajax({
			url:"{{ route('doneBooking') }}",
			method:"POST",
			data:{	
                booking_id:booking_id,
                customer_id:customer_id
				},
			success:function(data){
                if(data.code == 1)
                {
                    $('#success').removeClass('d-none');
                    $('#success').html(data.message);
                    setTimeout(function(){  window.location.href = '/carwashprovider'; }, 2000);  
                }else{
                    $('#error').removeClass('d-none');
                    $('#error').html(data.message);
                    setTimeout(function(){ window.location.reload(); }, 2000);
                }			
			}
		});
		
	});
});	

</script>

@stop