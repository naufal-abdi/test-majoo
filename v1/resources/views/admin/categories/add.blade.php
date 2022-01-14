@extends('template.base')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-weight-bold mt-4 mb-4">{{ $title }}</h2>
        <a href="{{ url('/admin/kategori') }}" class="btn btn-danger">Batal</a>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ url('/admin/kategori') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @isset($category->id)
                <input type="hidden" name="id" value="{{ $category->id }}">
                @endisset

                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Kategori" value="{{ $category->name ?? old('nama') }}" autofocus />
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ $category->description ?? old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>               
                
                <div class="text-right">
                    <a href="{{ url('/admin/kategori') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
