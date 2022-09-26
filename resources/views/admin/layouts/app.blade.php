<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

     <!-- Bootstrap CSS-->
     <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper mh-100">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        <li>
                            <a href="{{ route('admin.user.list') }}">
                                <i class="fa fa-users"></i>User
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('category.list') }}">
                                <i class="fa-light fa-hashtag"></i>Category
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pizza.list') }}">
                                <i class="fas fa-circle text-warning"></i>Products
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('order.list') }}" class="text-info">
                                <i class="fas fa-list "></i>Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contact.list') }}">
                                <i class="fa-regular fa-address-book"></i>Contact
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div>
                                <span class="text-dark font-weight-bold">AdminDashboard</span>
                            </div>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (auth()->user()->image)
                                                <a href="">
                                                    <img src="{{ asset('storage/'. auth()->user()->image ) }}" alt="">
                                                </a>
                                            @else
                                            <a href="#">
                                                {{-- <img src="{{ asset('image/users/user_profile_default_img.png') }}" alt=""> --}}
                                                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{auth()->user()->name}}&rounded=true" alt="{{auth()->user()->name}}" />
                                            </a>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{explode(' ', trim(auth()->user()->name))[0]}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    @if (auth()->user()->image)
                                                        <a href="">
                                                            <img src="{{ asset('storage/'. auth()->user()->image ) }}" alt="">
                                                        </a>
                                                    @else
                                                    <a href="#">
                                                        <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{auth()->user()->name}}&rounded=true"alt="{{auth()->user()->name}}" />
                                                    </a>
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{auth()->user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{auth()->user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin.accountdetails') }}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin.list') }}">
                                                        <i class="zmdi zmdi-account"></i>Admin List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin.changepassword') }}">
                                                        <i class="fa fa-key"></i>Change Password
                                                    </a>
                                                </div>
                                            </div>
                                            <form action="{{ route('logout') }}" method="POST" class="w-fu">@csrf
                                                <div class="d-flex justify-content-center mb-2">
                                                    <button type="submit" class=" btn-dark col-10 block p-2 text-white">
                                                        <i class="zmdi zmdi-power"></i>Logout
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <div class="">
                {{$slot}}
            </div>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>



      <!-- Jquery JS-->
      <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
      <!-- Bootstrap JS-->
      <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
      <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
      <!-- Vendor JS       -->
      <script src="{{ asset('admin/vendor/slick/slick.min.js') }}">
      </script>
      <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
      <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
      <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
      </script>
      <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
      <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}">
      </script>
      <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
      <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
      <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
      <script src="{{ asset('admin/vendor/select2/select2.min.js') }}">
      </script>

      <!-- Main JS-->
      <script src="{{ asset('admin/js/main.js') }}"></script>
      @stack('scripts')
</body>

</html>
<!-- end document-->
