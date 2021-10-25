@extends('customer/layout/template')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
				<form method="POST" action="">
                @csrf
				<div id="step1" class="d-none">
                   <div class='row'>
				   	<div class="alert alert-success alert-message alert-dismissable d-none" id="success"></div>
                    <div class="alert alert-danger alert-message alert-dismissable d-none" id="error"></div>
				   		<div class="col-md-6 col-6">
						   	<div class="d-grid gap-2">
						   		<button type="button" class="btn btn-primary" id="asap" onclick="clickasap()"><i class="far fa-clock"></i>  ASAP</button>
							</div>
						</div>
						<div class="col-md-6 col-6">
							<div class="d-grid gap-2">
						   		<button type="button" class="btn btn-outline-dark" id="schedule" onclick="clicksched()"><i class="far fa-calendar"></i>  Schedule</button>
						   	</div>
					   	</div>
				   </div>
					</br>
					<div class="d-grid gap-2">
						<button type="button" class="btn btn-dark" id="getLocations" onclick="getLocation()">
						<i class="fas fa-location-arrow"></i>  Get Location</button>
					</div>
					<input type="hidden" name="Latitude">
					<input type="hidden" name="Longtitude">
					<br/>
					<div class='row'>
				   		<div class="col-md-6 col-6">
						   <div class="mb-3">
								<label class="form-label">Name</label>
								<input class="form-control form-control-lg @error('name') is-invalid @enderror" autofocus  
								type="text" name="name" placeholder="Enter your name" value="{{auth()->user()->name}}" required/>
								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6 col-6">
							<div class="mb-3">
								<label class="form-label">Phone Number</label>
								<input class="form-control form-control-lg @error('phone') is-invalid @enderror"   autofocus  
								type="text" name="phone" placeholder="Enter your phone" value="{{auth()->user()->phone}}" required/>
								@error('phone')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
					   	</div>
				   	</div>
				   	<div class="mb-3">
						<label class="form-label">Landmark</label>
						<input class="form-control form-control-lg @error('landmark') is-invalid @enderror"  value="{{ old('landmark') }}" autofocus 
						type="text" name="landmark" placeholder="Enter your landmark" required/>
						@error('landmark')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-12 col-12">
						<div class="mb-3">
							<label for="title">Type of Vehicle</label>
							<select name="vehicle1" class="form-control" required>
								<option value="">------- Select Vehicle -------</option>
								@foreach ($vehicle as $vehicles)
									<option value="{{ $vehicles->id }}">{{ $vehicles->Type }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-md-12 col-12">
						<div id="schedule_book" class="d-none">
							<label class="form-label">Select Schedule Date</label>
							<input class="form-control form-control-lg @error('sched_date') is-invalid @enderror"  value="{{ old('sched_date') }}" autofocus 
							type="datetime-local" name="sched_date" placeholder="Enter your landmark" required/>
							@error('sched_date')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<br/>
					<div class="d-grid gap-2">
						<button type="button" class="btn btn-primary" id="nextStep1">Next</button>
					</div>
					<br/>
					
					</div>
				</div>
				<div id="step2" class="d-none">

				</div>

				<div id="step3" class="d-none">
					<div class='row p-3'>
					<div class="col-md-12 col-12">
						<button type="button" class="btn btn-light float-start" onclick="backstep2()"><i class="fas fa-chevron-left"></i></button>
						<h3 style="text-align: center;"><b> Booking Information </b></h3>
					</div>

					<div class="container-fluid">
						<div class="col-12 mt-3">
							<div class="card">
								<div class="card-horizontal" style=" display: flex;flex: 1 1 auto;">
									<div class="img-square-wrapper">
										<img class="" id="rider_image" src="/r_image/" width="100" height="100">
									</div>
									<div class="card-body">
										<input type="hidden" name="rider_id" id="rider_id"/>
										<h4 class="card-title" id="rider_name"></h4>
										<p class="card-text" id="rider_phone"></p>
										<p class="card-text" id="rider_add"></p>
										<p class="card-text" id="current_rider_add"></p>
									</div>
								</div>
							</div>
							<div class="mb-3">
								<h4 class="card-text" style="text-align: center;"><b>Details</b></h4>
							</div>
							<div class="mb-3">
							<input type="hidden" name="vehicle_id" id="vehicle_id"/>
							<input type="hidden" name="booking_amount" id="booking_amount"/>
							<input type="hidden" name="total_amount" id="total_amount"/>
							Type:<p class="card-text" style=" font-size: 15px;" id="car_type"></p>
							Cleaning amount:<p class="card-text" style=" font-size: 15px;" id="amount"></p>
								<br/><br/>
							Total: <p class="card-text" style="font-size: 20px;" id="total_booking"></p>
								<br/><br/><br/>
							</div>
						</div>
					</div>
					
					<div class="d-grid gap-2">
						<button type="button" class="btn btn-primary" id="button_book">Book</button>
					</div>

					</div>
				</div>
			</form>	
            </div>
        </div>
    </div> <!-- END OF DIV ROW -->
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

<script type="text/javascript">
$('#step1').removeClass('d-none');

var interval = null;

interval = setInterval(function(){
    $.ajax({
        url: '/getBookingCustomer',
        type: "GET",
        data: {
        },
        success: function(data){
            if(data == 0){

            }else{
                swal({
                title: "Booking Accepted!",
                text: "",
                imageUrl: '/asset/img/scooter-running.gif',
				imageWidth: 100,
				imageHeight: 100

                }).then(function (e) {
                    var id = data.id;
					console.log(e);
                    // if (e.value === true) {

                    //     $.ajax({
                    //         type: "POST",
                    //         url: '/confirmBooking/' +id,
                    //         success: function (data) {
                    //             window.location.href = '/booking_data/'+data;
                    //         }         
                    //     });
                    // }
                });
                clearInterval(interval); // stop the interval
            }
        }
    });
}, 1000);

$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});	

	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}

	function showPosition(position) {
		$('input[name=Latitude]').val(position.coords.latitude);
		$('input[name=Longtitude]').val(position.coords.longitude);

		$('#getLocations').css({
				'border-color': '#212529',
				'background-color': 'transparent',
				'color': '#212529',
			});	

		setTimeout(function(){
			$('#getLocations').css({
				'background-color': '#212529',
				'color': 'white',
			});	
		}, 1000);	

	}

	function clicksched(){
		$('#schedule').css({
			'background-color': '#212529',
			'color': 'white',
		});

		$('#asap').css({
			'border-color': '#c31c22',
			'background-color': 'transparent',
			'color': '#c31c22',
		});		
		$('#schedule_book').removeClass('d-none');
	}
	
	function clickasap(){
		$('#asap').css({
			'background-color': '#c31c22',
			'color': 'white',
		});

		$('#schedule').css({
			'border-color': '#212529',
			'background-color': 'transparent',
			'color': '#212529',
		});
		$('#schedule_book').addClass('d-none');
	}

	function onclickriderprofile(idx){
		var vehicle1= $('select[name=vehicle1]').val();
		
         $.ajax({
          url:"{{ route('riderinfofetch') }}",
          method:"POST",
          data:{idx:idx, vehicle1:vehicle1},
          success:function(data){
			$('#rider_id').val(data.rider.id);
			$('#vehicle_id').val(data.vehicle.id);
			$('#booking_amount').val(data.vehicle.price);
			$('#total_amount').val(data.vehicle.price);
			$('#rider_name').html(data.rider.name);
			$('#rider_phone').html(data.rider.phone);
			$('#rider_add').html(data.rider.citymunDesc+', '+data.rider.brgyDesc+', '+data.rider.street_add);
			$('#current_rider_add').html('<a href= "https://www.google.com/maps/place/'+data.rider.lat+','+data.rider.long+'" target="_blank">Check My Current Location</a>');
			$('#car_type').html(data.vehicle.Type);
			$('#amount').html(data.vehicle.price);
			$('#total_booking').html(data.vehicle.price);
			$('#rider_image').attr("src",(data.rider.image == null)? '/r_image/null.jpg':'/r_image/'+data.rider.image);
          }
         });

		$('#step3').removeClass('d-none');
		$('#step2').addClass('d-none');
	}

	$('#nextStep1').on('click', function(){

		var lat= $('input[name=Latitude]').val();
		var long= $('input[name=Longtitude]').val();
		var name= $('input[name=name]').val();
		var phone= $('input[name=phone]').val();
		var landmark= $('input[name=landmark]').val();
		var vehicle1= $('select[name=vehicle1]').val();
		var sched_date= $('input[name=sched_date]').val();

		if(lat == "" && long==""){
			$('#error').removeClass('d-none');
			$('#error').html("Please settle your location.");
			setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);	
		}else if(name == ""){
			$('#error').removeClass('d-none');
			$('#error').html("Please enter your name.");
			setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);
		}else if(phone == ""){
			$('#error').removeClass('d-none');
			$('#error').html("Please enter your phone.");
			setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);
		}else if(landmark == ""){
			$('#error').removeClass('d-none');
			$('#error').html("Please enter your landmark.");
			setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);
		}else if(vehicle1 == ""){
			$('#error').removeClass('d-none');
			$('#error').html("Please select your vehicle.");
			setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);
		}else{
		var html = "";

         $.ajax({
          url:"{{ route('riderdistancefetch') }}",
          method:"POST",
          data:{lat:lat, long:long, vehicle1:vehicle1},
          success:function(data){
			var nullimage = 'null.jpg';
			
			html += `
					<button type="button" class="btn btn-light float-start" id="backstep1" onclick="backstep1()"><i class="fas fa-chevron-left"></i></button>
					<h3 style="text-align: center;"><b> Carwash Provider </b></h3>
					<div class='row p-3'>`

				$.each( data, function( key, riders ) {

					html += `<div class="col-md-2 col-6">
						<a onclick="onclickriderprofile(`+ riders.id+`);">
						<div class="card text-center">
							<div class="col-auto">
								<img src="/r_image/`+(riders.image == null ? nullimage:riders.image)+`" class="img-fluid" width="200" height="150">
							</div>
							<div class="card-body">
								<h5 class="card-title">`+ riders.name+`</h5>
								<small class="card-text">`+ riders.phone+`</small><br/>
								<small class="card-text">`+ riders.distance +` km away</small>
							</div>
						</div>
						</a>
					</div>`
				});
			html += `</div>`

			$("#step2").html(html);

			$('#step2').removeClass('d-none');
			$('#step1').addClass('d-none');
          }
         });
		}
	});
	
	function backstep1(){
		$('#step1').removeClass('d-none');
		$('#step2').addClass('d-none');
	}

	function backstep2(){
		$('#step2').removeClass('d-none');
		$('#step3').addClass('d-none');
	}

	$('#button_book').on('click', function(){
		var lat= $('input[name=Latitude]').val();
		var long= $('input[name=Longtitude]').val();
		var rider_id= $('input[name=rider_id]').val();
		var vehicle_id= $('input[name=vehicle_id]').val();
		var landmark= $('input[name=landmark]').val();
		var sched_date= $('input[name=sched_date]').val();
		var booking_amount= $('input[name=booking_amount]').val();
		var total_amount= $('input[name=total_amount]').val();

		$.ajax({
			url:"{{ route('saveBooking') }}",
			method:"POST",
			data:{	
					lat:lat, 
					long:long,
					rider_id:rider_id,
					vehicle_id:vehicle_id,
					landmark:landmark,
					sched_date:sched_date,
					booking_amount:booking_amount,
					total_amount:total_amount
				},
			success:function(data){
				swal({
                title: "Booking Sent",
                text: "Please wait...",
                imageUrl: '/asset/img/loading.gif',
				imageWidth: 100,
				imageHeight: 100
                })				
			}
		});
		
	});


</script>
@stop