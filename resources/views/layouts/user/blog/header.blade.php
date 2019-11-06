<nav class="navbar navbar-default navbar-fixed-top fadeInDown" data-wow-delay="0.5s">
    <div class="top-bar smoothie hidden-xs">
        <div class="container">
            <div class="clearfix">
                <ul class="list-inline social-links wow pull-left">
                    <li>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-dribbble"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="https://github.com/Cabral221/DevFullStacks"><i class="fab fa-github"></i></a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/abdourahmane-diop/"><i class="fab fa-linkedin"></i></a>
                    </li>
                </ul>

                <div class="pull-right text-right">
                    <ul class="list-inline">
                        <li>
                            <div><i class="far fa-envelope"></i> cabraldiop18@gmail.com</div>
                        </li>
                        <li>
                            <div class="meta-item"><i class="fas fa-mobile"></i> +221 77 159 85 41</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand smoothie logo logo-light" href="{{ route('home') }}"><img src="{{ asset('user/assets/img/logo.png')}}" alt="logo"></a>
                    <a class="navbar-brand smoothie logo logo-dark" href="{{ route('home') }}"><img src="{{ asset('user/assets/img/logo_reverse.png')}}" alt="logo"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-navigation">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                        </li>      
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('forum.index') }}">Forum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('e-learning.index') }}">E-Learning</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('S"inscrire') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    <span class="badge badge-success">{{ Auth::user()->unreadNotifications->count() }}</span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach (Auth::user()->unreadNotifications as $notification)
                                        <li>
                                            <a href="{{ route('notifications.show',['id'=>$notification->id]) }}" class="dropdown-item">
                                            {{ ($notification->type)::toText($notification->data) }}
                                            </a>
                                        </li>
                                    @endforeach                                
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position: relative; padding-left: 50px;">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 32px;height:32px;postion:absolute; top:10px; left:10px;border-radius:50%;">  
                                {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('home') }}"><i class="fa fa-btn fa-user" aria-hidden="true"></i> Tableau de bord</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Deconnexion') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"     style="display: none;">
                                            @csrf
                                        </form>
                                    </li>                                     
                                </ul>
                            </li>
                        @endguest
                        
                        <li><a href="#search"><i class="pe-7s-search"></i></a></li>
                        <li><a href="javascript:void(0);" class="side-menu-trigger hidden-xs"><i class="fa fa-bars"></i></a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>