@extends('landingpage.partials.master')

@section('content')
    
<section class="bg-gray200 pt-5 pb-5">
    <div class="container">
    	<div class="row justify-content-center">
    		<div class="col-md-7">
    			<article class="card">
    			<img id="foto_{{ $foto->id }}" class="card-img-top mb-2" src="{{ asset('storage/' . $foto->file_foto) }}" alt="Card image">
    			<div class="card-body">
                    <img src="{{ $userProfileImage ? asset($userProfileImage) : asset('images/profile_default.jpg') }}" class="rounded-circle mr-3 mb-2" width="30" height="30" alt="">
					<a class="author-name font-weight-bold" href="{{ route('profile.profile', ['id' => $user->id]) }}">
						{{ $userName }}
					</a>
					
    				<h1 class="card-title display-4"> {{ $foto->judul_foto }} </h1>
                    <div class="photo-description">
                        <p>{{ $foto->desc }}</p>
                    </div>
                    <!-- LIKE -->
					<form id="likeForm" action="{{ route('like') }}" method="POST" class="d-inline">
						@csrf
						<input type="hidden" name="foto_id" value="{{ $foto->id }}">
						@if ($foto->likedByUser())
						<button type="submit" class="btn btn-md btn-primary footer-action-icons" style="outline: none;"><i class="fa fa-thumbs-up" style="color: #f00030;"></i> Like </button>
						@else
						<button type="submit" class="btn btn-md btn-primary footer-action-icons" style="outline: none;"><i class="fa fa-thumbs-up" style="color: #ccc;"></i> Like </button>
						@endif
					</form>
						<span class="ml-2 mr-2">{{ $totalLikes }}</span>Likes
                    <!-- -->
    			</div>
    			</article>
    		</div>
    	</div>
    </div>

    <div class="container-fluid mt-5">
    	<section class="comments-section">
			<h2 class="section-title mb-4">Comments</h2>
			<div class="comment-container">
				<div class="comment">
                    @foreach ($komentar ?? [] as $komen)
                    <div class="comment-author">
						<img src="{{ asset('/assets/profile/profile_default.jpg')}}" alt="Author Image" class="rounded-circle mr-2" style="50px" height="50px">
                        
						<span class="author-name font-weight-bold">{{ $komen->user->username }}</span>
					</div>
					<div class="comment-content">
						<p class="mb-3 mt-2">{{ $komen->isi_komentar }}</p>
					</div>
                    @endforeach
				</div>
				<!-- Add more comments here -->
			</div>
			<div class="add-comment">
                <form action="{{ route('storeKomentar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="foto_id" value="{{ $foto->id }}">
				    <textarea class="form-control mb-2" name="isi_komentar" placeholder="Write your comment here..." rows="3"></textarea>
				    <button type="submit" class="btn btn-primary btn-sm mt-2 w-100">Submit</button>  
                </form>                
			</div>
		</section>
		
    </div>
    </section>
        
    </main>
@endsection