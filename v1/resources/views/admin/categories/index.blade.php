@extends('template.base')

@section('content')
<div class="container">
    
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-weight-bold mt-4 mb-4">{{ $title }}</h2>
        <a href="{{ url('/admin/kategori/add') }}" class="btn btn-success">Tambah</a>
    </div>

    <div class="table-responsive mb-4" style="@if(count($categories) === 0) height:50vh; @endif">
        
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $startNumber++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td class="text-center">
                            <a href="{{ url('/admin/kategori/'.$item->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ url('/admin/kategori/del/'.$item->id) }}" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    <div class="mb-5">
        {{ $categories->links() }}
    </div>
    
</div>
@endsection