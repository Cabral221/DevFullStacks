
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">


                    <li class="nav-item active">
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
                      {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </li> --}}
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                      </li>








                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
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
                        <li class="dropdown nav-item">
                          <a id="navbarDropdown" href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="glyphicon glyphicon-bell"><i class="fa fa-bell" aria-hidden="true"></i></span>
                            <span class="badge badge-success">{{ Auth::user()->unreadNotifications->count() }}</span>
                          </a>
                          <ul class="dropdown-menu list-group dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @foreach (Auth::user()->unreadNotifications as $notification)
                                {{-- <li>{{ ($notification->type)->toText($notification->data) }}</li> --}}
                                <a href="{{ route('notifications.show',['id'=>$notification->id]) }}" class="dropdown-item">
                                <li>{{ ($notification->type)::toText($notification->data) }}</li>
                                </a>
                            @endforeach
                          </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">Tableau de bord</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Deconnexion') }}
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