<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Pintereso Bootstrap Template</title>
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <link rel="stylesheet" href="{{ asset('/LandingPage/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('/LandingPage/assets/css/theme.css')}}">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <a class="navbar-brand font-weight-bolder mr-4" href="{{route('home')}}"><img src="{{ asset('/LandingPage/assets/img/logo_new.jpg')}}"></a>
    <button class="navbar-light navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsDefault">
    	<ul class="navbar-nav mr-auto align-items-center">
    		<form class="bd-search hidden-sm-down" action="{{ route('users.search')}}" method="GET">
    			<input type="text" class="form-control bg-graylight border-gray-200 font-weight-bold" id="search" name="search" placeholder="Search..." autocomplete="off">
    			<div class="dropdown-menu bd-search-results" id="search-results">
    			</div>
    		</form>
    	</ul>
    	<ul class="navbar-nav ml-auto align-items-center">
    		<li class="nav-item">
    		    <a class="nav-link" href="{{route('home')}}">Home</a>
    		</li>
			<li class="nav-item">
				<a class="nav-link" href="{{route('upload')}}">Post</a>
			</li>
    		<li class="nav-item">
                <a class="nav-link" href="{{route('profile')}}">
                    @if (Auth::user()->image === 'assets/profile/profile_default.jpg')
                    <img class="rounded-circle mr-2" src="{{ asset('/LandingPage/assets/img/av.png')}}" width="30" height="30"><span class="align-middle"><span class="align-middle">{{Auth::user()->username}}</span>
                    @else
                    <img class="rounded-circle mr-2" src="{{ asset('storage/' . Auth::user()->image) }}" width="30" height="30"><span class="align-middle">{{Auth::user()->username}}</span>
                    @endif
                </a>
    		</li>
    		<li class="nav-item dropdown">
    		<a class="nav-link" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    		<svg style="margin-top:10px;" class="_3DJPT" version="1.1" viewbox="0 0 32 32" width="21" height="21" aria-hidden="false" data-reactid="71"><path d="M7 15.5c0 1.9-1.6 3.5-3.5 3.5s-3.5-1.6-3.5-3.5 1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5zm21.5-3.5c-1.9 0-3.5 1.6-3.5 3.5s1.6 3.5 3.5 3.5 3.5-1.6 3.5-3.5-1.6-3.5-3.5-3.5zm-12.5 0c-1.9 0-3.5 1.6-3.5 3.5s1.6 3.5 3.5 3.5 3.5-1.6 3.5-3.5-1.6-3.5-3.5-3.5z" data-reactid="22"></path></svg>
    		</a>
			<div class="dropdown-menu dropdown-menu-right shadow-lg" aria-labelledby="dropdown02">
				<form id="logout-form" action="{{ route('logout') }}" method="POST">
					@csrf
					<button type="submit" class="dropdown-item btn btn-primary d-block text-center">Keluar</button>
				</form>
			</div>
			
			
    		</li>
    	</ul>
    </div>
    </nav>    
    <main role="main">