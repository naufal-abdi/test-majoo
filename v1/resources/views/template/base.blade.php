<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <title>{{ $title }}</title>
    
    @stack('custom-css')
    <style>
        .navbar-brand {
            font-size: 30px;
        }

        .alert {
            position: fixed;
            top: 5rem;
            right: 1rem;
        }

        .pagination {
          justify-content: end;
        }

        footer {
            border-top: 1px solid #ddd;
        }

        @media screen and (max-width: 992px) {
            .navbar-brand {
                font-size: 24px;
            }
        }
    
        @media screen and (max-width: 600px) {
            .navbar-brand {
                font-size: 18px;
            }
        }
    </style>
  </head>
  <body>
      @php
          $isLogin = true;
      @endphp
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Majoo Teknologi Indonesia</a>

        
            <div class="ml-auto">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      @auth
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/produk') }}"><i class="bi bi-box-seam"></i> Produk</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/kategori') }}"><i class="bi bi-tags"></i> Kategori</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/logout') }}"><i class="bi bi-box-arrow-up-right"></i> Logout</a>
                      </li>
                      @endauth
                      @guest
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}"><i class="bi bi-box-arrow-in-up-right"></i> Login</a>
                      </li>
                      @endguest
                    </ul>
                  </div>
            </div>
        
    </nav>

    

    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
      <i class="bi bi-check2-square"></i> {{ Session::get('success') }}
    </div>
    @elseif (Session::has('error'))
    <div class="alert alert-danger" role="alert">
      <i class="bi bi-x-square"></i> {{ Session::get('error') }}
    </div>
    @endif

    @yield('content')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <footer class="bg-light p-3">
        <p class="text-secondary text-center mb-0">Test Case - Full Stack Engineer - Naufal Abdi <br/>PT. Majoo Teknologi Indonesia <br/> Made with ❤️ using Bootstrap 4</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      $(function(){ 
          setTimeout(function(){
              $(".alert").alert('close');
          }, 4000); 
      });
  </script>
  @stack('custom-script')
  </body>
</html>