@extends('template.base')

@section('content')
<div class="container">
    <h2 class="font-weight-bold mt-4 mb-4">{{ $title }}</h2>

    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Produk</h4>
                </div>
                <div class="card-body">
                    <p class="display-4">{{ $productCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kategori</h4>
                </div>
                <div class="card-body">
                    <p class="display-4">{{ $productCategoryCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

