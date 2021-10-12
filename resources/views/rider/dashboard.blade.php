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
                                                <div class="dropdown">
                                                    <select class="form-select" id="addressdrop" type="text" class="form-control @error('addressdrop') is-invalid @enderror"  
                                                            required autofocus {{ ($userinfo->active == '0') ? '' : 'disabled' }}>
                                                        <option value="0">--- Select Address ---</option>
                                                        <option value="1" {{ ($userinfo->addresstype == '1') ? 'selected' : '' }}>Residential</option>
                                                        <option value="2" {{ ($userinfo->addresstype == '2') ? 'selected' : '' }}>Current</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-6">
                                                <div class="form-check form-switch float-end">
                                                    <input class="form-check-input" type="checkbox" id="status" {{ ($userinfo->active == '0') ? '' : 'checked' }}>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ ($userinfo->active == '0') ? 'Offline' : 'Online' }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div id="addrressactive1">
                                            <p> Your active address is 
                                                {{($userinfo->regDesc == null) ? '' : $userinfo->regDesc}}, 
                                                {{($userinfo->provDesc == null) ? '' : $userinfo->provDesc}},
                                                {{($userinfo->citymunDesc == null) ? '' : $userinfo->citymunDesc}},
                                                {{($userinfo->brgyDesc == null) ? '' : $userinfo->brgyDesc}},
                                                {{($userinfo->street_add == null) ? '' : $userinfo->street_add}}
                                            </p>
                                        </div>
                                        <div id="addrressactive2">
                                            <p> Your active address is 
                                                {{ ($userinfocurrent == null) ? '' : $userinfocurrent->regDesc }}, 
                                                {{ ($userinfocurrent == null) ? '' : $userinfocurrent->provDesc }},
                                                {{ ($userinfocurrent == null) ? '' : $userinfocurrent->citymunDesc }},
                                                {{ ($userinfocurrent == null) ? '' : $userinfocurrent->brgyDesc }},
                                                {{ ($userinfocurrent == null) ? '' : $userinfocurrent->street }}
                                            </p>
                                        </div>
                                        <div id="address_inputarea" class="d-none">
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <label class="form-label" for="region">Region</label>
                                                    <input type="text" class="form-control" id="region" value="{{ $userinfo->regDesc }}" readonly>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label class="form-label" for="province">Province</label>
                                                    <input type="text" class="form-control" id="province" value="{{ $userinfo->provDesc }}" readonly>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label class="form-label" for="municipal">Municipal</label>
                                                    <input type="text" class="form-control" id="municipal" value="{{ $userinfo->citymunDesc }}" readonly>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label class="form-label" for="brgy">Barangay</label>
                                                    <input type="text" class="form-control" id="brgy" value="{{ $userinfo->brgyDesc }}" readonly>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <label class="form-label" for="streetadd">Street Address</label>
                                                    <input type="text" class="form-control" id="street" value="{{ $userinfo->street_add }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="current" class="d-none">
                                        <div class="row">
                            				<div class="col-md-6 col-12">
												<div class="mb-3">
													<label for="title">Region:</label>
													<select name="region" id="current_region" class="form-control" >
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
													<select name="province" id="current_province" class="form-control">
													</select>
												</div>
											</div>
										</div>

										<div class="row">
                            				<div class="col-md-6 col-12">
												<div class="mb-3">
													<label for="title">Municipal:</label>
													<select name="municipal" id="current_municipal" class="form-control" >
													</select>
												</div>
											</div>
										
                            				<div class="col-md-6 col-12">
												<div class="mb-3">
													<label for="title">Barangay:</label>
														<select name="brgy" id="current_brgy" class="form-control" >
													</select>
												</div>
											</div>
										</div>

										<div class="mb-3">
											<label class="form-label">Street Address</label>
											<input class="form-control form-control-lg" type="text" id="current_street" name="street" placeholder="Enter your village and street" required/>
                                            @error('street')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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



<script type="text/javascript">

$(document).ready(function() {

    var addressID = $("#addressdrop").val();
        if(addressID == 1)
        {
            $('#addrressactive1').removeClass('d-none');
            $('#addrressactive2').addClass('d-none');
            
        }else if(addressID == 2){
            $('#addrressactive2').removeClass('d-none');
            $('#addrressactive1').addClass('d-none');
        }else{
            $('#addrressactive1').addClass('d-none');
            $('#addrressactive2').addClass('d-none');
        }
        
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#status').on('change.bootstrapSwitch', function(e) {
        var value = e.target.checked;
        var addressval = $("#addressdrop").val();
        var current_region = $("#current_region").val();
        var current_province = $("#current_province").val();
        var current_municipal = $("#current_municipal").val();
        var current_brgy = $("#current_brgy").val();
        var current_street = $("#current_street").val();

        $.ajax({
            url: '/onchangeStatRider',
            type: "POST",
            data: {
                value : value,
                addressval : addressval,
                current_region : current_region,
                current_province : current_province,
                current_municipal : current_municipal,
                current_brgy : current_brgy,
                current_street : current_street,
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

      //ONCHANGE ADDRESS SELECT
      $("#addressdrop").change(function () {
        if($(this).val() == 1)
        {
            $('#address_inputarea').removeClass('d-none');
            $('#current').addClass('d-none');
            
        }else{
            $('#current').removeClass('d-none');
            $('#address_inputarea').addClass('d-none');
        }
        
    }); 
    //REGION ON CHANGE
			$('select[name="region"]').on('change', function() {
				$('select[name="province"]').empty();
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
@stop