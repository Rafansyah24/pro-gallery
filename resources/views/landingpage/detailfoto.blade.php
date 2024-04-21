@extends('landingpage.partials.master')

@section('content')
    
<section class="bg-gray200 pt-5 pb-5">
    <div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card">
					<div class="row no-gutters">
						<!-- Column for Image -->
						<div class="col-md-6">
							<img src="{{ asset('storage/' . $foto->file_foto) }}" class="card-img" alt="Foto">
						</div>
						<!-- Column for Profile, Username, Like, and Comment -->
						<div class="col-md-6">
							<div class="card-body">
								<!-- Profile Image -->
								<div class="d-flex align-items-center mb-3">
									<img src="{{ asset('/assets/profile/profile_default.jpg')}}" class="rounded-circle mr-2" width="50" height="50" alt="">
									<div class="d-flex align-items-center">
										<a class="author-name font-weight-bold" href="{{ route('profile.profile', ['username' => $userName]) }}">
											{{ $userName }}
										</a>
										<div class="dropdown ml-2">
											<a class="nav-link" href="#" id="reportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<svg style="margin-top:10px;" class="_3DJPT" version="1.1" viewbox="0 0 32 32" width="21" height="21" aria-hidden="false" data-reactid="71">
													<path d="M7 15.5c0 1.9-1.6 3.5-3.5 3.5s-3.5-1.6-3.5-3.5 1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5zm21.5-3.5c-1.9 0-3.5 1.6-3.5 3.5s1.6 3.5 3.5 3.5 3.5-1.6 3.5-3.5-1.6-3.5-3.5-3.5zm-12.5 0c-1.9 0-3.5 1.6-3.5 3.5s1.6 3.5 3.5 3.5 3.5-1.6 3.5-3.5-1.6-3.5-3.5-3.5z" data-reactid="22"></path>
												</svg>
											</a>
											<div class="dropdown-menu dropdown-menu-right shadow-lg" aria-labelledby="reportDropdown">
												<!-- Pilihan jenis pelanggaran -->
												<a class="dropdown-item" href="#" onclick="reportFoto('Spam')">Spam</a>
												<a class="dropdown-item" href="#" onclick="reportFoto('Violent Content')">Violent Content</a>
												<a class="dropdown-item" href="#" onclick="reportFoto('Hate Speech')">Hate Speech</a>
											</div>
										</div>										
									</div>
								</div>
								<!-- Title -->
								<h5 class="card-title">{{ $foto->judul_foto }}</h5>
								<!-- Description -->
								<div class="photo-description mt-3">
									<p>{{ $foto->desc }}</p>
								</div>
								<!-- Like Button -->
								<form id="likeForm" action="{{ route('like') }}" method="POST" class="d-inline">
									@csrf
									<input type="hidden" name="foto_id" value="{{ $foto->id }}">
									<button type="submit" class="btn  btn-primary like-btn p-0" style="outline: none; border: none; background: none;">
										<i class="fa fa-heart mr-1" style="color: {{ $foto->likedByUser() ? '#f00030' : '#ccc' }}; border: 1px solid #ccc; border-radius: 50%; padding: 5px;"></i>
									</button>
								</form>
								<span class="mr-2">{{ $totalLikes }}</span>Likes
								<!-- Comments -->
								<section class="comments-section mt-3">
									<h5 class="card-title">
										Comments 
										<button class="toggle-comments-btn btn btn-sm btn-primary ml-2" onclick="toggleComments()">
											<i class="fa-solid fa-angle-down"></i>
										</button>
									</h5>
									<div class="comment-container" style="display: none;">
										<div class="comment">
											@foreach ($komentar ?? [] as $komen)
											<div class="comment-author d-flex align-items-center mb-2">
												<img src="{{ asset('/assets/profile/profile_default.jpg')}}" alt="Author Image" class="rounded-circle mr-2" width="30" height="30">
												<span class="author-name font-weight-bold">{{ $komen->user->username }}</span>
												<p class="mb-1 ml-2" style="font-size: 16px;">{{ $komen->isi_komentar }}</p>
											</div>
											@endforeach
										</div>
										<!-- Add more comments here -->
									</div>
									<div class="add-comment mt-5">
										<form action="{{ route('storeKomentar') }}" method="POST">
											@csrf
											<input type="hidden" name="foto_id" value="{{ $foto->id }}">
											<textarea class="form-control mb-2" name="isi_komentar" placeholder="Write your comment here..." rows="3"></textarea>
											<button type="submit" class="btn btn-primary btn-sm">Submit</button>  
										</form>                
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
    </section>
        
    </main>

    <script>
        function toggleComments() {
            var comments = document.querySelector('.comment-container'); // Ambil kontainer komentar
            var btnIcon = document.querySelector('.toggle-comments-btn i'); // Ambil ikon tombol
            
            // Toggle tampilan kontainer komentar
            comments.style.display = comments.style.display === 'none' ? 'block' : 'none';
            
            // Ubah ikon tombol sesuai dengan keadaan saat ini
            btnIcon.classList.toggle('fa-caret-down');
            btnIcon.classList.toggle('fa-caret-up');
        }
    </script>
@endsection
