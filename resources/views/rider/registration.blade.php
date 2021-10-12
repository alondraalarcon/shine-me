<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>Shine Me | Application </title>

	<link href="/asset/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-150">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
								@include('layouts.notifications')
									<div class="text-center">
										<img src="/asset/img/shineme.png" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
                              
                                    <form method="POST" action="{{ route('rider_register') }}">
                                    @csrf
										<div class="mb-3">
											<label class="form-label">Name</label>
											<input class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
										<div class="row">
                            				<div class="col-md-6 col-12">

											<label class="form-label">Phone</label>
												<div class=" input-group mb-3">
													<span class="input-group-text" id="addon1">+63</span>
													<input class="form-control form-control-lg" type="text" name="phone" placeholder="Enter phone number" aria-describedby="addon1" required/>
													@error('phone')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
											</div>

											<div class="col-md-6 col-12">			
												<div class="mb-3">
													<label class="form-label">Email</label>
													<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" required />
													@error('email')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
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
													</select>
												</div>
											</div>
										</div>

										<div class="row">
                            				<div class="col-md-6 col-12">
												<div class="mb-3">
													<label for="title">Municipal:</label>
													<select name="municipal" class="form-control" >
													</select>
												</div>
											</div>
										
                            				<div class="col-md-6 col-12">
												<div class="mb-3">
													<label for="title">Barangay:</label>
														<select name="brgy" class="form-control" >
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

										<div class="row">
                            				<div class="col-md-6 col-12">
												<div class="mb-3">
													<label class="form-label">Password</label>
													<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" required/>
													@error('password')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
											</div>

											<div class="col-md-6 col-12">
												<div class="mb-3">
													<label class="form-label">Confirm Password</label>
													<input id="password-confirm" type="password" class="form-control"  placeholder="Enter confirm password"
													name="password_confirmation" required autocomplete="new-password">
												</div>
											</div>
										</div>

										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Apply</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>


	<script type="text/javascript">
		$(document).ready(function() {
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

</body>

</html>
