
<div class="wrapper">
<nav class="main-header navbar navbar-expand-md navbar-primary navbar-dark">
    <div class="container">
      <a href="{{url('/doshome')}}" class="navbar-brand">
        <img src="{{asset('dist/img/user.png')}}" class="brand-image img-circle elevation-3"
             style="opacity: .8">
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
     

       
        <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                       <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nama }} <span class="caret"></span>
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
                    </ul>
      </div>

    </div>
  </nav>

            @yield('content')