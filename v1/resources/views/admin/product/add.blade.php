@extends('template.base')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-weight-bold mt-4 mb-4">{{ $title }}</h2>
        <a href="{{ url('/admin/produk') }}" class="btn btn-danger">Batal</a>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ url('/admin/produk') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @isset($product->id)
                    <input type="hidden" name="id" value="{{ $product->id }}">
                @endisset

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $product->name ?? old('nama') }}" placeholder="Nama Produk" autofocus />
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ $product->price ?? old('harga') }}" placeholder="Harga Produk">
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                @isset($product->category_id)
                                <option value="{{ $product->category_id }}" selected>{{ $product->category }}</option>
                                @endisset
                            </select>
                        </div>
                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">
                            {{ $product->description ?? old('deskripsi') }}
                        </textarea>
                    </div>
                    {{-- @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror --}}
                </div>
                @error('deskripsi')
                <div class="form-group">
                    <div class="invalid-feedback d-block">
                        deskripsi harus diisi
                    </div>
                </div>
                @enderror
                <div class="image-container mb-3">
                    <p class="form-label">Gambar <span class="btn btn-outline-primary btn-sm image-box-link">Pilih Gambar</span></p>
                    <div class="progress d-none mb-3">
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    {{-- wrap input gambar --}}
                    <div id="gambar-wrapper">
                        @isset($productImage)
                            @foreach ($productImage as $pImg)
                                <input type="hidden" name="gambar[]" value="{{ $pImg->path }}">       
                            @endforeach
                        @endisset
                    </div>

                    {{-- format --}}
                    {{-- <input type="hidden" name="gambar[]" value="path gambar"> --}}

                    <input type="file" class="d-none" name="pilih_gambar" id="pilih_gambar" accept="image/png, image/gif, image/jpeg">

                    <div class="image-box d-flex justify-content-start" id="image-box">
                        {{-- <div class="image-box-link">
                            <span class="image-box-link-text text-center">Pilih <br/> Gambar</span>
                        </div>
                        <div class="image-box-item-wrapper" id="image-box-item-wrapper">
                            {{-- <div class="image-box-item">
                                <div class="image-box-item-btn btn-group btn-group-sm" role="group">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-bookmark-check-fill"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-binoculars-fill"></i>
                                    </button>
                                    <span class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </span>
                                </div>
                                <img src="/img/product/atm-machine.png" alt="preview">
                            </div> 
                        </div> --}}

                        @isset($productImage)
                            @foreach ($productImage as $pImg)
                            <div class="image-box-item">
                                <div class="image-box-item-btn btn-group btn-group-sm" role="group">
                                    <span class="btn btn-danger btn-sm" onclick="deleteImage($(this).parent().parent())">
                                        <i class="bi bi-trash-fill"></i>
                                    </span>
                                </div>
                                <img src="{{ url($pImg->path) }}" alt="preview">
                            </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
                @error('gambar')
                <div class="form-group">
                    <div class="invalid-feedback d-block">
                        gambar harus diisi
                    </div>
                </div>
                @enderror
                
                <div class="text-right">
                    <a href="{{ url('/admin/produk') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .image-box {
        gap: 10px;
    }
    .image-box .image-box-item, .image-box .image-box-link{
        width: 120px;        
        border-radius: 10px;
        height: 120px;
        padding: 5px;
        cursor: pointer;
    }

    .image-box .image-box-item {
        border: 1px solid #ddd;
    }

    .image-box .image-box-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .image-box .image-box-item .image-box-item-btn {
        position: absolute;
        opacity: 0;
        transition: .3s all;
    }

    .image-box .image-box-item:hover .image-box-item-btn {
        opacity: 1;
    }

    .image-box .image-box-link {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 14px;
        font-weight: bold;        
        border: 1px dashed var(--blue);
        color: var(--blue);
    }

    /* .image-box-link {
        border-style: dashed;
        border-color: var(--blue);
        color: var(--blue);
    } */

    .image-box-link:hover {
        background-color: var(--blue);
        color: #fff;
        transition: .5s all;
        cursor: pointer;
    }

    .select2-selection.select2-selection--single {
        height: 37px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 35px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 33px;
    }
</style>
@endpush

@push('custom-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js" integrity="sha512-MbhLUiUv8Qel+cWFyUG0fMC8/g9r+GULWRZ0axljv3hJhU6/0B3NoL6xvnJPTYZzNqCQU3+TzRVxhkE531CLKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function deleteImage(e) {
        // image index
        let idx = e.index();

        $.ajax({
            type: 'DELETE',
            url: "{{ url('/admin/image') }}",
            data: { gambar : $(`#gambar-wrapper input:eq(${ idx })`).val() },
            success: function(data) {
                if (data.success) {
                    console.log(data);
                    $(`#gambar-wrapper input:eq(${ idx })`).remove();
                    e.remove();
                }
            }
        });
        
        
        
        
    }

    $(document).ready(function(){
        $('#kategori').select2({
            placeholder: "-- Pilih Kategori Produk --",
            ajax: {
                url: "{{ url('/admin/produk/add') }}",
                dataType : 'json',
                delay : 100,
                processResults : function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache : true
            },
            selectOnClose : true
        });
        
        // inisialisasi tinymce
        tinymce.init({
            selector: 'textarea#deskripsi'
        });

        // trigger click element input pilih_gambar
        $('.image-box-link').click(function(){
            $('#pilih_gambar').trigger('click');
        });        

        // upload gambar
        $('#pilih_gambar').change(function(){
            // console.log($('#pilih_gambar').prop('files')[0]);
            // let pilih_gambar = $('#pilih_gambar').prop('files')[0];
            let form = new FormData($('form')[0]);
            // let image = $('#pilih_gambar').files[0];
            // let image = $('#pilih_gambar').prop('files')[0];
            // form.append('pilih_gambar', pilih_gambar);
            
            $.ajax({
                type: 'POST',
                url: "{{ url('/admin/image') }}",
                data: form,
                processData: false,
                contentType: false,
                beforeSend : function(){
                    // $('#image-box-item-wrapper').empty();
                    $('.progress').removeClass('d-none');
                },
                uploadProgress: function(event, position, total, percentComplete){
                    
                    $('.progress-bar').text(percentComplete + '%');
                    $('.progress-bar').css('width', percentComplete + '%');
                },
                success: function(data) {
                    if (data.errors) {

                    } else if (data.success) {
                        $('.progress-bar').text('Berhasil di Upload');
                        $('.progress-bar').css('width', '100%');
                        $('#image-box').append(data.images);
                        $('#gambar-wrapper').append(data.input_gambar);
                        // $('#image-box').innerHtml ;

                    }
                    setTimeout(function() { 
                        $('.progress').addClass('d-none');
                    }, 500);
                    
                }
            });

        });

        // if ($('.image-box-item-btn')) {
        //     $('.image-box-item-btn .btn-danger').click(function(){
        //         console.log($(this));
        //     })
        // }

        // $('.image-box-item-btn').on('click', function(){
        //     console.log($(this));
        // })
    });

    // $(document).change(function(){
    //     $('.image-box-item-btn .btn-danger').click(function(){
    //             console.log($(this));
    //         })
    // });
</script>
@endpush