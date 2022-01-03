<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>{{@$title}}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->
    <link href="{{asset('css\plugin.min.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{asset('css\styles.css')}}">

    <link href="{{asset('toastr/toastr.css')}}" rel="stylesheet" type="text/css">

     @if(!empty($css_files) && is_array($css_files) && count($css_files) > 0)

            @foreach ($css_files as $key => $value)

                    <link href="{{asset('')}}{{$value}}" rel="stylesheet" type="text/css">

        @endforeach
     @endif

    <!-- endinject -->
    <script type="text/javascript">
        siteUrl = '{{url('')}}';
        assetUrl = '{{asset('')}}';
    </script>
    <style type="text/css">
        .ck.ck-editor__editable_inline>:last-child{
            height: 150px;
        }
    </style>
    <!-- endinject -->
<!-- 
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png"> -->
</head>

<body class="layout-light side-menu overlayScroll">
    <div class="mobile-search"></div>

    <div class="mobile-author-actions"></div>
    <header class="header-top">
        <nav class="navbar navbar-light">
            <div class="navbar-left">
                <a href="" class="sidebar-toggle">
                <img class="svg" src="{{asset('svg/bars.svg')}}" alt="img"> </a>
                <a class="navbar-brand" href="#"><!-- <img class="svg dark" src="img/svg/logo_dark.svg" alt="svg"><img class="light" src="img/logo_white.png" alt="img"> -->Block Chain</a>
                <!-- <form action="/" class="search-form">
                    <span data-feather="search"></span>
                    <input class="form-control mr-sm-2 box-shadow-none" type="search" placeholder="Search..." aria-label="Search">
                </form -->
                
            </div>
            <!-- ends: navbar-left -->

            <div class="navbar-right">
                <ul class="navbar-right__menu">
                   <!--  <li class="nav-search d-none">
                        <a href="#" class="search-toggle">
                            <i class="la la-search"></i>
                            <i class="la la-times"></i>
                        </a>
                        <form action="/" class="search-form-topMenu">
                            <span class="search-icon" data-feather="search"></span>
                            <input class="form-control mr-sm-2 box-shadow-none" type="search" placeholder="Search...rfewrtger" aria-label="Search">
                        </form>
                    </li> -->
                  
                    <!-- ends: .nav-flag-select -->
                    <li class="nav-author">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle"><img src="{{asset('uploads')."/".session('profile')}}" alt="" class="rounded-circle"></a>
                            <div class="dropdown-wrapper">
                                <div class="nav-author__info">
                                    <div class="author-img">
                                        <img src="{{asset('uploads')."/".session('profile')}}" alt="" class="rounded-circle">
                                    </div>
                                    <div>
                                        <span>{{ucwords(session('user_data')->name)}}</span>
                                        <h6>{{ucwords(session('user_type'))}}</h6>
                                       
                                    </div>
                                </div>
                                <div class="nav-author__options">
                                    
                                    {{-- <ul>
                                        <li>
                                            <a href="{{url('adminprofile').'/'.session('user_data')->id}}">
                                                <span data-feather="user"></span> Profile</a>
                                        </li>
                                        
                                    </ul> --}}

                                    <a href="{{url('logout')}}" class="nav-author__signout">
                                        <span data-feather="log-out"></span> Sign Out</a>
                                </div>
                            </div>
                            <!-- ends: .dropdown-wrapper -->
                        </div>
                    </li>
                    <!-- ends: .nav-author -->
                </ul>
            </div>
            <!-- ends: .navbar-right -->
        </nav>
    </header>
    <main class="main-content">

        <aside class="sidebar">
            <div class="sidebar__menu-group">
                <ul class="sidebar_nav">
                    <li class="menu-title">
                        <span>Main menu</span>
                    </li>
                    <li>
                        <a href="{{url('dashboard')}}" class="">
                            <span data-feather="home" class="nav-icon"></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>

                    
                    <li>
                        <a href="{{url('manage-category')}}" class="">
                            <span data-feather="grid" class="nav-icon"></span>
                            <span class="menu-text">Manage Category</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        @php echo (@$content) @endphp

        <footer class="footer-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-copyright">
                            <p>2021 @<a href="https://www.akestech.com" target="_blank">Akestech Infotech</a>
                            </p>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="footer-menu text-right">
                            <ul>
                                <li>
                                    <a href="#">About</a>
                                </li>
                                <li>
                                    <a href="#">Team</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                       
                    </div> -->
                </div>
            </div>
        </footer>
    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
   
    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>

    <!-- inject:js-->

     <script src="{{asset('js\plugins.min.js')}}"></script>

    <script src="{{asset('js\script.min.js')}}"></script>

    <script src="{{asset('')}}toastr/toastr.min.js"></script>

     @if(!empty($js_files) && is_array($js_files) && count($js_files) > 0)

            @foreach ($js_files as $key => $value) 

                <script type="text/javascript" src="{{asset('')}}{{$value}}"></script>

            @endforeach
        
    @endif
    <!-- endinject-->

</body>
@php echo (@$footer) @endphp

</html>