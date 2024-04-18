@extends('upload.partials.master')

@section('content')
<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-3 mt-5 mx-auto">
            <h2 class="text-center mb-4">Upload Your image Gallery</h2>
            <form action="{{ route('uploadFoto') }}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="row">
                    <div class="col-md-6 mb-3 h-100">
                        <label for="image" class="form-label">Pilih Gambar:</label>
                        <input type="file" class="form-control" id="image" name="file_foto" accept="image/*" required>
                        <img id="imagePreview" src="#" alt="Priview Gambar" style="display: none; max-height: 190px;">
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label">Pilih Album</label>
                            <select name="album" id="album" class="form-control">
                                <option value="" disabled selected>-- Silakan Pilih Album --</option>
                                @foreach($album as $id => $title)
                                    <option value="{{ $id }}">{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="album_id" id="album_id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul:</label>
                            <input type="text" class="form-control" id="title" name="judul_foto" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi:</label>
                            <textarea class="form-control" id="description" name="desc" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary  w-100">Upload</button>
            </form>
        </div>
    </div>
</div>

<script>
    const selectAlbum = document.getElementById('album');

    selectAlbum.addEventListener('change', function() {
        document.getElementById('album_id').value = this.value;
    });

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