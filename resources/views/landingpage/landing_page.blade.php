@extends('landingpage.partials.master')

@section('content')
<section class="mt-4 mb-5">
        <div class="container-fluid ml-4">
    	<div class="row">
    		<nav class="navbar navbar-expand-lg navbar-light bg-white pl-1 mb-3 mt-4">
    			<ul class="navbar-nav">
    				<li class="nav-item">
    				<h4 class="nav-link">Get the inspiration you need and increase your creativity.</h4>
    			</ul>
    		</nav>
    	</div>
    </div>
    <div class="container-fluid">
    	<div class="row">
    		<div class="card-columns">
				@foreach ($photos as $photo)
				<div class="card card-pin">
    				<img class="card-img" src="{{asset('storage/' . $photo->file_foto)}}" alt="Card image">
    				<div class="overlay">
    					<h2 class="card-title title">{{$photo->judul_foto}}</h2>
						<p style="color: white; font-size: 18px; text-align: center;">{{$photo->desc}}</p>
    					<div class="more">
							<a href="{{route('showFoto' , ['id' => $photo->id])}}" class="mr-2"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> More </a>
							<form id="likeForm" action="{{ route('like') }}" method="POST" class="d-inline">
								@csrf
								<input type="hidden" name="foto_id" value="{{ $photo->id }}">
								<button type="submit" class="btn  btn-primary like-btn p-0" style="outline: none; border: none; background: none;">
									<i class="fa fa-heart mr-1" style="color: {{ $photo->likedByUser() ? '#f00030' : '#ccc' }}; border: 1px solid #ccc; border-radius: 50%; padding: 5px;"></i>
								</button>
							</form>
    					</div>
    				</div>
    			</div>
				@endforeach
    		</div>
    	</div>
    </div>
    </section>
    </main>
@endsection

