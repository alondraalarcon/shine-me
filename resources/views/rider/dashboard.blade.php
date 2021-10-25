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
                                    <div class="alert alert-success alert-message alert-dismissable d-none" id="success"></div>
                                    <div class="alert alert-danger alert-message alert-dismissable d-none" id="error"></div>

                                    <form method="POST" action="">
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-3 col-6">
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-dark" id="getLocations" onclick="getLocation()">
                                                <i class="fas fa-location-arrow"></i>  Get Location</button>
                                            </div>
                                            <input type="hidden" name="Latitude">
					                        <input type="hidden" name="Longtitude">
                                            </div>
                                            <div class="col-md-9 col-6">
                                                <div class="form-check form-switch float-end">
                                                    <input class="form-check-input" type="checkbox" id="status" {{ ($userinfo->active == '0') ? '' : 'checked' }}>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ ($userinfo->active == '0') ? 'Offline' : 'Online' }}</label>
                                                </div>
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
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>



<script type="text/javascript">
var interval = null;

interval = setInterval(function(){
    $.ajax({
        url: '/getBooking',
        type: "GET",
        data: {
        },
        success: function(data){
            if(data == 0){

            }else{
                swal({
                title: "Booking Alert!",
                text: "Do you want to accept it?",
                type: "success",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                reverseButtons: !0,
                showCancelButton: !0

                }).then(function (e) {
                    var id = data.id;
                    if (e.value === true) {

                        $.ajax({
                            type: "POST",
                            url: '/confirmBooking/' +id,
                            success: function (data) {
                                window.location.href = '/booking_data/'+data;
                            }         
                        });
                    }
                });
                clearInterval(interval); // stop the interval
            }
        }
    });
}, 1000);

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

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#status').on('change.bootstrapSwitch', function(e) {
        var value = e.target.checked;
        var lat= $('input[name=Latitude]').val();
		var long= $('input[name=Longtitude]').val();

        if(value == "true"){
            if(lat == "" && long==""){
                $('#error').removeClass('d-none');
                $('#error').html("Please settle your location.");
                setTimeout(function(){ $('#error').addClass('d-none'); }, 3000);	
            }
        }

        $.ajax({
            url: '/onchangeStatRider',
            type: "POST",
            data: {
                value : value,
                lat : lat,
                long : long,
            },
            success: function(data){
                if(data.code == 1)
                {
                    $('#success').removeClass('d-none');
                    $('#success').html(data.message);
                    setTimeout(function(){ window.location.reload(); }, 2000);  
                }else{
                    $('#error').removeClass('d-none');
                    $('#error').html(data.message);
                    setTimeout(function(){ window.location.reload(); }, 2000);
                    // $(".alert-danger").fadeTo(3000, 500).slideUp(500, function(){
                    //     $(".alert-danger").slideUp(500);  
                    // });
                }
            }
        });
    });


    


});
</script>
@stop