@extends('dashboard.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Data Table Foto</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                    
                                @php
                                $no = 1;
                                @endphp
                                @foreach($dfoto as $itemfoto)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $itemfoto->judul_foto }}</td>
                                    <td>{{ $itemfoto->desc }}</td>
                                    <td><img src="{{ asset('storage/' . $itemfoto->file_foto) }}" alt="{{ $itemfoto->judul_foto }}" style="max-width: 50px; max-height:50px;"></td>
                                    <td>
                                        <a href="" type="button" class="btn btn-warning">Edit</a>
                                        <a href="" type="button" class="btn btn-danger">Hapus</a>
                                    </td>
                                    <!-- Add more table data if needed -->
                                </tr>
                                @endforeach
                            
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

