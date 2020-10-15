<!-- Authentication Links -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('usuario.login') }}">{{ __('Usuario Login') }}</a>
</li>

<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->mail }} 
        <span class="caret"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('usuario.logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('usuario.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
