@extends('template.base')

@section('content')
<div class="container">
    
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-weight-bold mt-4 mb-4">{{ $title }}</h2>
        <a href="{{ url('/admin/produk/add') }}" class="btn btn-success">Tambah</a>
    </div>

    <div class="table-responsive mb-4" style="@if(count($products) === 0) height:50vh; @endif">
        
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $startNumber++ }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->presetPrice() }}</td>
                        <td class="text-center">
                            <a href="{{ url('/admin/produk/'.$product->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ url('/admin/produk/del/'.$product->id) }}" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-5">
        {{ $products->links() }}
    </div>
</div>
@endsection