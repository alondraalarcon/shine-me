@extends('customer/layout/template')

@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Dashboard</strong></h3>
        </div>
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">

                <form method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="dropdown">
                                        <select class="form-select" id="booking_time" type="text" class="form-control @error('addressdrop') is-invalid @enderror"  
                                                required autofocus}}>
                                            <option value="1">Pick-Up(ASAP)</option>
                                            <option value="2">Schedule</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
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
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
                    

                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop