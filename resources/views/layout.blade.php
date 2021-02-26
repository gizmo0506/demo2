<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Daya Demo</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

   </head>
   <body>
      

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/js"></script>
      <header>
         <nav class="navbar navbar-expand-lg navbar-light" style="background:#D76D77">
            <a class="navbar-brand" href="/">DEMO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            @guest
                            
            @else
            <li class="nav-item">
                        <a class="nav-link" href="/employees">List</a>
                  </li>
            <li class="nav-item">
                        <a class="nav-link" href="/employees/create">Add</a>
                  </li>
            @endguest
            
            </div>
            <div class="navbar-nav ml-auto">
            @guest
                  @if (Route::has('login'))
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                     </li>
                  @endif
                  
                  @if (Route::has('register'))
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                     </li>
                  @endif
               @else
               <li class="nav-item">
                     <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                     </li>
                     <li class="nav-item">
                     <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                        </form>
                     </li>   
                  
            @endguest
            </div>
            </div>
         </nav>
      </header>
      <div class="container">
         @yield('content')
      </div>
   </body>

</html>