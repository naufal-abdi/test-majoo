@extends('template.base')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card card-login">
                    <div class="card-header">
                        <h2 class="card-title text-center">Login Admin</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/login') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" autofocus/>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"/>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                  </div>
                                @enderror
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                  Remember me
                                </label>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-success" title="Login Akun Admin">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-css')
<style>
    .card-login {
        margin: 4rem 0;
    }
</style>

@endpush