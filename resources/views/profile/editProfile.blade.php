@extends('profile.partials.master')

@section('content')
<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-3 mt-3 mx-auto">
            <h2 class="text-center mb-4">Edit Profile Users</h2>
            <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3 h-100">
                        <label for="image" class="form-label">Pilih Gambar:</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        <img id="imagePreview" src="#" alt="Priview Gambar" style="display: none; max-height: 190px;">
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="full_name" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
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