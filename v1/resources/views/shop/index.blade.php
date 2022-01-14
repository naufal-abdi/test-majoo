@extends('template.base')


@section('content')
<div class="container-fluid">
    <h2 class="font-weight-bold mt-4 mb-4">{{ $title }}</h2>

    <div class="row mb-4">
        @foreach ($products as $item)
        <div class="col-md-3 mb-3">
            <div class="card h-100 pt-2 pb-4">
                <div class="card-body">
                    <div class="product-image d-flex justify-content-center mb-2">
                        <img src="{{ !is_null($item->path) ? asset($item->path) : asset('img/image.png') }}" alt="Product Image">
                    </div>
                    <hr>
                    <p class="card-title text-center font-weight-bold">{{ $item->name }}</p>
                    <p class="price text-center font-weight-bold mt-2"><sup>Rp</sup> {{ $item->presetPrice() }}</p>
                    <p class="description mt-3">{!! $item->description !!}</p>
                </div>
                <div class="action-btn d-flex justify-content-center">
                    <a href="" class="btn btn-success" title="Beli Produk Ini">Beli</a>
                </div>
            </div>
        </div>
        @endforeach

        
    </div>    
    <div class="mb-5">
        {{ $products->links() }}
    </div>
</div>
@endsection

@push('custom-css')
<style>
    .product-image {
        width: 100%;
        height: 200px;
        padding: 0 10px 0 10px;
    }
    .product-image img {
        width: 100%;
        height: 100%;
    }
</style>
@endpush