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

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Shine Me</title>

    <link href="/asset/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.css">
    

</head>

<body>
    <div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand">
                    <center><img src="/asset/img/shineme-removebg.png" style="width:70%"></center>
                </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Menu
					</li>

					<li class="sidebar-item {{ Request::is('admin') ? 'active':''}}">
                        <a class="sidebar-link" href="/admin">
                            <i class="fas fa-home"></i>
                            <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Request::is('riders') ? 'active':''}}">
						<a class="sidebar-link" href="/riders">
                            <i class="fas fa-motorcycle"></i>                            
                            <span class="align-middle">Carwash Provider List</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Request::is('customers') ? 'active':''}}">
						<a class="sidebar-link" href="/customers">
                            <i class="fas fa-users"></i>
                            <span class="align-middle">Customer List</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Request::is('vehicles') ? 'active':''}}">
						<a class="sidebar-link" href="/vehicles">
                            <i class="fas fa-car"></i>
                            <span class="align-middle">Vehicles</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Request::is('services') ? 'active':''}}">
						<a class="sidebar-link" href="/services">
							<i class="fas fa-briefcase"></i>
                            <span class="align-middle">Services</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Request::is('booking') ? 'active':''}}">
						<a class="sidebar-link" href="/booking">
							<i class="fas fa-map"></i>
                            <span class="align-middle">Monitor Booking</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Request::is('sales') ? 'active':''}}">
						<a class="sidebar-link" href="/sales">
							<i class="fas fa-money-bill-wave-alt"></i>
                            <span class="align-middle">Monitor Sales</span>
                        </a>
					</li>

                    <a data-bs-target="#settings" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                        <i class="fas fa-cog"></i>
                        <span class="align-middle">Settings</span>
                    </a>

                    <ul id="settings" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                        <li class="sidebar-item"><a class="sidebar-link" href="/"> Set Commissions </a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="/"> </a></li>
                    </ul>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="/asset/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

            <main class="content">
                @include('layouts.notifications')
                @yield('content')
            </main>
    </div>
    @extends('admin/layout/script')

</body>
</html>
<style>
    *{
        font-family: 'Ubuntu', sans-serif;
    }
</style>