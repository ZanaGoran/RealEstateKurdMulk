<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Your Page Title</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <style>
        #header {
            height: 90px;
            transition: all 0.5s;
            z-index: 997;
            background: rgba(52, 59, 64, 0.9);
        }

        #header #logo {
            font-size: 32px;
            margin: 0;
            line-height: 1;
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #fff;
        }

        #header.header-transparent {
            background: transparent;
        }

        #header.header-scrolled {
            background: rgba(52, 59, 64, 0.9);
            height: 70px;
            transition: all 0.5s;
        }

        .navbar ul {
            text-decoration: none;
            margin: 0;
            padding: 0;
            display: flex;
            list-style: none;
            align-items: center;
        }

        .navbar li {
            text-decoration: none;
            position: relative;
            white-space: nowrap;
            padding: 10px 0 10px 24px;
        }

        .navbar a,
        .navbar a:focus {
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: "Poppins", sans-serif;
            color: #fff;
            font-size: 14px;
            padding: 0 4px;
            white-space: nowrap;
            transition: 0.3s;
            letter-spacing: 0.4px;
            position: relative;
            text-transform: uppercase;
        }

        .navbar a i,
        .navbar a:focus i {
            font-size: 12px;
            line-height: 0;
            margin-left: 5px;
        }

        .navbar>ul>li>a:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -6px;
            left: 0;
            background-color: #3399ff;
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out 0s;
        }

        .navbar a:hover:before,
        .navbar li:hover>a:before,
        .navbar .active:before {
            visibility: visible;
            transform: scaleX(1);
        }

        .navbar a:hover,
        .navbar .active,
        .navbar .active:focus,
        .navbar li:hover>a {
            color: #fff;
        }

        .navbar .dropdown ul {
            display: block;
            position: absolute;
            left: 24px;
            top: calc(100% + 30px);
            margin: 0;
            padding: 10px 0;
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            background: #3399ff;
            box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
            transition: 0.3s;
            
        }

        .navbar .dropdown ul li {
            min-width: 200px;
        }

        .navbar .dropdown ul a {
            padding: 10px 20px;
            font-size: 14px;
            text-transform: none;
            color: #666666;
        }

        .navbar .dropdown ul a i {
            font-size: 12px;
        }

        .navbar .dropdown ul a:hover,
        .navbar .dropdown ul .active:hover,
        .navbar .dropdown ul li:hover>a {
            color: #2dc997;
        }

        .navbar .dropdown:hover>ul {
            opacity: 1;
            top: 100%;
            visibility: visible;
        }

        .navbar .dropdown .dropdown ul {
            top: 0;
            left: calc(100% - 30px);
            visibility: hidden;
        }

        .navbar .dropdown .dropdown:hover>ul {
            opacity: 1;
            top: 0;
            left: 100%;
            visibility: visible;
        }

        @media (max-width: 1366px) {
            .navbar .dropdown .dropdown ul {
                left: -90%;
            }

            .navbar .dropdown .dropdown:hover>ul {
                left: -100%;
            }
        }

        .mobile-nav-toggle {
            color: #000;
            font-size: 28px;
            cursor: pointer;
            display: none;
            line-height: 0;
            transition: 0.5s;
        }

        @media (max-width: 991px) {
            .mobile-nav-toggle {
                display: block;
            }

            .navbar ul {
                display: none;
            }

            .navbar-mobile {
                position: fixed;
                overflow: hidden;
                top: 0;
                right: 0;
                left: 0;
                bottom: 0;
                background: rgba(77, 77, 77, 0.9);
                transition: 0.3s;
                z-index: 999;
            }

            .navbar-mobile .mobile-nav-toggle {
                position: absolute;
                top: 15px;
                right: 15px;
                display: block;
            }

            .navbar-mobile ul.show {
                display: flex;
                flex-direction: column;
            }

            .navbar-mobile a,
            .navbar-mobile a:focus {
                padding: 10px 20px;
                font-size: 15px;
                color: #666666;
            }

            .navbar-mobile a:hover,
            .navbar-mobile .active,
            .navbar-mobile li:hover>a {
                color: #2dc997;
            }

            .navbar-mobile .dropdown ul {
                position: static;
                display: none;
                margin: 10px 20px;
                padding: 10px 0;
                z-index: 99;
                opacity: 1;
                visibility: visible;
                background: #fff;
                box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
            }

            .navbar-mobile .dropdown ul li {
                min-width: 200px;
            }

            .navbar-mobile .dropdown ul a {
                padding: 10px 20px;
            }

            .navbar-mobile .dropdown ul a i {
                font-size: 12px;
            }

            .navbar-mobile .dropdown ul a:hover,
            .navbar-mobile .dropdown ul .active:hover,
            .navbar-mobile .dropdown ul li:hover>a {
                color: #2dc997;
            }

            .navbar-mobile .dropdown>.dropdown-active {
                display: block;
                border: none;
            }
        }

        .user-initial-circle {
            border: none;
            border-radius: 25px;
            width: 30px;
            height: 30px;
            background-color: #3399ff; /* Circle background color */
            color:white; /* Text color */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            transition: .3s;
        }
        .user-initial-circle:hover{
            box-shadow: 0 0 40px #3399ff;
        }
        .dropdown-menu{
            border-radius: 20px;
            border: none;
            color: #fff;
        }
        .btn-get-started{
            border: none;
            color: #fff;
        }
        .dropdown-menu button{
            color: #fff;
            background: none;
            border: #000;
            border-width: 1px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration-line: underline;
            transition: 0.2s;
        }
        .dropdown-menu button:hover{
          font-size: 15px;
        }
    </style>
</head>

<body>
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex justify-content-between align-items-center">
            <div id="logo">
                Kurdistan Real Estate
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto{{ request()->routeIs('newindex') ? ' active' : '' }}" href="{{ route('newindex') }}">Home</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('about-us') }}">about us</a></li>
                  
                    <li>  <a class="cta-btn align-middle" href="{{ route('list') }}">properties</a></li>

                 
                    <li class="dropdown">
                        <a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown">
                                <a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="{{ route('contact-us') }}">contact</a></li>

        <li>
    @auth
        <div class="dropdown">
            <a href="#" class="btn-get-started" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-initial-circle">
                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                </div>
            </a>

            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li>UserName: <strong>{{ auth()->user()->username }}</strong></li>
                <li>Email: <small>{{ auth()->user()->email }}</small></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    @else
        <a href="{{ route('login') }}" class="btn-get-started">Login</a>
    @endauth
</li>


                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    <script>
        const mobileNavToggle = document.querySelector(".mobile-nav-toggle");
        const navbarMobile = document.querySelector(".navbar ul");

        mobileNavToggle.addEventListener("click", function () {
            navbarMobile.classList.toggle("mobile-nav-show");
        });
    </script>
</body>

</html>

