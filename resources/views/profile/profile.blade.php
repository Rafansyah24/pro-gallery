@extends('profile.partials.master')

@section('content')

        
    
    <div class="jumbotron border-round-0 min-50vh" style="background-image:url({{ asset('/assets/jumbotron/jumbotron.jpg')}});">
    </div>
    <div class="container mb-4">
        @if (Auth::user()->image === 'assets/profile/profile_default.jpg')
    	<img src="{{ asset('/LandingPage/assets/img/av.png')}}" class="mt-neg100 mb-4 rounded-circle" width="180" height="180">
        @else
        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="mt-neg100 mb-4 rounded-circle" width="180" height="180">
        @endif
    	<h1 class="font-weight-bold title">{{Auth::user()->username}}</h1>
    	<p class="mt-3">
    		I love Art, Web Design, Photography, Design, Illustration
    	</p>
		<a type="button" class="btn btn-primary" href="{{route('album')}}">
			Create album
		</a>
		<a type="button" class="btn btn-outline-success" href="{{ route('editProfile')}}">Edit Profile</a>
    </div>
    <div class="container-fluid mb-5">
    	<div class="row">
    		<div class="card-columns">
				@if (!is_null($album))
					@foreach ($album as $albm)
						<div class="card card-pin">
							<img class="card-img" src="{{ asset('storage/' . $albm->photo) }}" alt="Card image">
							<div class="overlay">
								<h2 class="card-title title">{{ $albm->nama_album }}</h2>
								<p style="color: white; font-size: 18px; text-align: center;">{{ $albm->desc }}</p>
								<div class="more">
									<a href="{{ route('detailalbum', $albm->id) }}" class="mr-2"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> More </a>
									<form action="{{ route('hapusAlbum', $albm->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-sm btn-outline-danger mx-1 w-200">Hapus</button>
									</form>
								</div>
							</div>
						</div>
					@endforeach
				@else
					<p>Tidak ada album yang tersedia.</p>
				@endif
    		</div>
    	</div>
    </div>
        
    </main> 
@endsection


