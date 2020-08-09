<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>@yield('title')</title>

   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>

   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

   <!-- Styles -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

   <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->                         <!-- default theme -->
   <link href="{{ asset('css/themes/darkly/bootstrap.css') }}" rel="stylesheet">              <!-- darkly theme -->
   <!-- <link href="{{ asset('css/themes/litera/bootstrap.css') }}" rel="stylesheet"> -->     <!-- litera theme -->
   <!-- <link href="{{ asset('css/themes/lumen/bootstrap.css') }}" rel="stylesheet"> -->      <!-- lumen theme -->
   <!-- <link href="{{ asset('css/themes/materia/bootstrap.css') }}" rel="stylesheet"> -->    <!-- materia theme -->
   <!-- <link href="{{ asset('css/themes/superhero/bootstrap.css') }}" rel="stylesheet"> -->  <!-- superhero theme -->

   <!-- Tab icon -->
   <link rel="icon" href="{{asset('./images/icon/ms-icon-310x310.png')}}">

</head>
<body>
   <div id="app">
      <nav class="sticky-top navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
         <div class="container">
               
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
               <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

               <!-- Left Side Of Navbar -->
               <ul class="navbar-nav mr-auto">

                  @if (!Auth::guest())
                     <li class="nav-item">
                        <a class="nav-link" href="/filemanager" role="button" target="_blank" v-pre>
                           <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
                              <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                           </svg>   
                           Mijn Bestanden
                        </a>
                     </li>
                  @endif

               </ul>

               <!-- Right Side Of Navbar -->
               <ul class="navbar-nav ml-auto">
                  
                  <!-- Authentication Links -->
                  @guest
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                     </li>
                     @if (Route::has('register'))
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('register') }}">Registreren</a>
                        </li>
                     @endif
                  @else
                     <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            </svg>
                           {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                           <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                           </a>

                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                           </form>
                        </div>
                     </li>
                  @endguest
               </ul>
            </div>
         </div>
      </nav>

      <!-- page content is injected here -->
      <main role="main" class="flex-shrink-0">
         @yield('content')
      </main>
   </div>
   <style>
        /* 
        * This website uses bootstrap
        * for ducumentation on how to use it, refer to the link below
        * https://getbootstrap.com/docs/4.5/components
        */

        ::-webkit-scrollbar {
            display: none;
        }

        body {
            background-attachment: fixed;
            font-family: Arial, Helvetica, sans-serif, sans-serif;
        }

        a:hover {
            color: inherit;
        }

        .my-card {
            transition: all 0.1s ease-in-out;
        }
        .my-card:hover {
            transform: scale(1.05);
        }

        .avatar {
            vertical-align: middle;
            width: 1.5em;
            height: 1.5em;
            border-radius: 50%;
        }

        .status {
            font-size: 30px;
            margin: 2px 2px 0 0;
            display: inline-block;
            vertical-align: middle;
            line-height: 10px;
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        .nounderline {
            text-decoration: none !important
        }
   </style>
   <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });


        function confirmation(forid){
            if(confirm('Weet je het zeker?')){
                document.getElementById(forid).submit();
            } else {
                return false;
            }
        }

        
        function toggleOpen(e) {
            $(e.target)
                .prev('.card-header')
                .find(".expand-icon")
                .text("remove_circle");
        }
        function toggleClose(e) {
            $(e.target)
                .prev('.card-header')
                .find(".expand-icon")
                .text("add_circle");
        }
        $('.panel-group').on('hidden.bs.collapse', toggleClose);
        $('.panel-group').on('shown.bs.collapse', toggleOpen);
   </script>
</body>
</html>
