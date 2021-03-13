<header>
    <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
      <div class="container">

        {{-- Left menu --}}
        <div class="menu-nav">
          {{-- Logo --}}
         <div class="logo-header">
           <a class="navbar-brand" href="{{ url('/') }}">
               <img src="{{ asset('img/deliveboo-logo.svg') }}" alt="logo deliveboo">
           </a>
         </div>
        </div>


        {{-- Right menu --}}
        <div class="menu-nav">

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                    <button type="button" name="button" class="nav-button">

                      <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-home"></i>
                        {{ __('Login') }}
                      </a>
                    </button>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                        <button type="button" name="button" class="nav-button">
                          <a class="nav-link" href="{{ route('register') }}">
                            <i class="far fa-clipboard"></i>
                            {{ __('Registrati') }}
                          </a>
                        </button>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                          data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" v-pre>
                          {{ Auth::user()->restaurant_name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            {{ __('Dashboard') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                      </div>
                  </li>
              @endguest
          </ul>
                
        </div>
      </div>
  </nav>
</header>
