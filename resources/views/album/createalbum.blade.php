@extends('album.partials.master')

@section('content')
<div class="container mt-3 mb-5">
    <div class="row">
      <div class="col-md-8 offset-md-3 mt-5 mx-auto">
        <h2 class="text-center mb-4">Create New Album</h2>
        <form action="{{ route('createAlbum') }}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-6 mb-3 h-100">
              <label for="image" class="form-label">Pilih Gambar:</label>
              <input type="file" class="form-control" id="image" name="photo" accept="image/*" required>
              <img id="imagePreview" src="#" alt="Priview Gambar" style="display: none; max-height: 190px;">
              @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="title" class="form-label">Nama Album</label>
                <input type="text" class="form-control" id="title" name="nama_album" required>
                @error('nama_album')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="desc" rows="3" required></textarea>
                @error('desc')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary  w-100">Create Album</button>
        </form>
      </div>
    </div>
  </div>

<script>
    const inputImage = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    inputImage.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "#";
            imagePreview.style.display = 'none';
        }
    });
</script>
@endsection