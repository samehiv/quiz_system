<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/categories') }}">Quizzes</a></li>
                    @admin
                        <li><a href="{{url('/questions')}}">Manage Questions</a></li>
                        <li><a href="{{url('/quizzes')}}">Manage Quizzes</a></li>
                    @endadmin
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/change_password') }}">Change Password</a>
                                </li>
                                @admin
                                    <li>
                                        <a href="{{ url('/admins/create') }}">Add Admin</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/') }}" id="reset">Reset All Tables</a>
                                        <form action="{{ url('/') }}" method="POST" style="display: none;">
                                            {{method_field('DELETE')}}
                                            {{csrf_field()}}
                                        </form>
                                    </li>
                                @endadmin
                                <li>
                                    <a href="{{ url('/account') }}" id="delete-account">Delete Your Account</a>
                                    <form action="{{ url('/account') }}" method="POST" style="display: none;">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                    </form>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $('.dropdown').hover(function(){
        $('.dropdown-toggle', this).trigger('click');
    });
    $(document).ready(function() {
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });

        $('#delete-account').on('click',function(e){
            e.preventDefault();
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: "Yes Delete My Account"
                },
                dangerMode: true,
            }).then(() => {
                $(this).siblings('form').submit();
            });
        });

        $('#reset').on('click',function(e){
            e.preventDefault();
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: "Yes rest all table"
                },
                dangerMode: true,
            }).then(() => {
                $(this).siblings('form').submit();
            });
        })
    });



</script>
@yield('script')

</body>
</html>
