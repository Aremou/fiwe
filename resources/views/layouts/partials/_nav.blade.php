<div class="topbar">

    <div class="topbar-left	d-none d-lg-block bg-white" >
        <div class="text-center h-100" style="border-bottom: 1px solid #FC6307">
            <a href="/" class="logo"><img src="{{ asset('dashboard/images/logo/logo.png') }}" height="85" alt="logo"></a>
        </div>
    </div>

    <nav class="" style="{{ background_color_1() }}">

        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="text-white">{{ Auth::user()->name . '( ' . Auth::user()->role . ' )' }}</span><i class="mdi mdi-account m-d-100 text-muted"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                    <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profil</a>

                    <a class="dropdown-item" href=""><i class="mdi mdi-settings m-r-5 text-muted"></i> Paramètres</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                               this.closest('form').submit();"><i class="mdi mdi-logout m-r-5 text-muted"></i> Se
                            deconnecter</a>
                    </form>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect" style="{{ background_color_1() }}">

                    <i class="ion-navicon"></i>
                </button>
            </li>
        </ul>

        <div class="clearfix"></div>

    </nav>

</div>
