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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles and load theme -->
        <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
        @guest
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">        
        @else
            @if (isset(Auth::user()->theme))
                @if (strval(Auth::user()->theme) == 'default')
                    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
                @else
                    <link href="{{ asset('css/themes/'.strval(Auth::user()->theme).'/bootstrap.css') }}" rel="stylesheet">
                @endif
            @else
                <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            @endif
        @endguest
        

        <!-- Tab icon -->
        <link rel="icon" href="{{asset('./images/icon/ms-icon-310x310.png')}}">

        <!-- set language -->
        {{App::setLocale('nl')}}

        <script>
            
            // adds an alert message before submitting a form
            // ex: 
            // <form id="my-form"> 
            //     <div class="btn btn-primary" onclick="confirmation('my-form')"></div>
            // </form>
            function confirmation(forid){
                let submit = confirm('Weet je het zeker?');
                console.log(submit)
                if(submit){
                    document.getElementById(forid).submit();
                } else {
                    return false;
                }
            }


            // for the properties input in 'add_vehicle'
            $(document).ready(function() {
                var max_fields      = 10; //maximum input boxes allowed
                var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment

                        //add new input box
                        $(wrapper).append(
                            '<div class="input-group">'+
                                '<input placeholder="Eigenschap" class="form-control col" type="text" name="prop[]"/>'+
                                '<input placeholder="Waarde" class="col form-control" type="text" name="val[]"/>'+
                                '<div class="input-group-prepend">'+
                                    '<div class="btn btn-danger remove_field">-</div>'+
                                '</div>'+
                            '</div>');
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
                })
            });
            
            // loads a theme temporary for preview purposes. 
            function loadtheme(theme) {

                // if "current-theme" exists, remove it
                if(document.getElementById("current-theme")){
                    document.getElementById("current-theme").outerHTML = "";
                }

                // load selected theme
                if (theme == 'default') {
                    document.getElementsByTagName("head")[0].insertAdjacentHTML("beforeend",
                    "<link id=\"current-theme\" rel=\"stylesheet\" href=\"" + @json(asset('css/app.css')) + "\" />");
                } else {
                    document.getElementsByTagName("head")[0].insertAdjacentHTML("beforeend",
                    "<link id=\"current-theme\" rel=\"stylesheet\" href=\"" + @json(asset('css/themes/tobereplaced/bootstrap.css')).replace("tobereplaced", theme) + "\" />");
                }
                
                // reloads css. obviously...
                reloadcss();
            }

            // ...
            function reloadcss() {
                let links = document.getElementsByTagName("link");
                for (let cl in links){
                    let link = links[cl];
                    if (link.rel === "stylesheet"){
                        link.href += "";
                    }
                }
            }
        </script>
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
                transition: all 0.4s ease-in-out;
            }
            .my-card:hover {
                transform: scale(1.05);

            }

            .my-card:hover img {
                opacity: .5;

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

            #more  {
                display:  none;
            }

            #preview {
                text-align: center;
                display: grid;
                grid-template-columns: repeat(14, 1fr);
            }

            /* style of the individual charakter */
            .previewchar {
                background-color: #000;
                border: 2px solid #222;
                color: white;
                font-weight: bold;
                font-family: 'Roboto', sans-serif, monospace;
            }

            /* style of the icon */
            #icon {
                grid-column: 1/9;
            }

            /* the gap between the time and icon */
            #gap {
                grid-column: 9/11;
                background-color: #222;
            }

            /* */
            #hours {
                grid-column: 11/13;
            }
        </style>
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
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Inloggen</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Registreren</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        </svg>
                                        {{ Auth::user()->username }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user_settings') }}">
                                            Instellingen
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Uitloggen
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            @guest
                                <!---->
                            @else
                                <!-- notifications button in navbar -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mx-1 badge badge-pill badge-danger">1</span> meldingen <span class="caret"></span>
                                    </a>

                                    <!-- notification list -->
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <div class="dropdown-item container">
                                            <div class="row">
                                                <div class="card">
                                                    <div class="card-header">Mijn meldingen</div>
                                                    <div class="card-body">
                                                        nog niet geimplementeerd
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- page content is injected here -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
