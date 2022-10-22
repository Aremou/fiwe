<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        <div class="text-center">
            <a href="/" class="logo"><img src="{{ asset('dashboard/images/logo.jpeg') }}" height="20" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="/" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <strong>Tableau de bord </strong>
                    </a>
                </li>
                <li>
                    <a class="waves-effect text-uppercase text-white" style="{{background_color_1()}}">
                        <strong>Centres D'intérêts </strong>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart-plus"></i>
                        <strong>Centres D'intérêts </strong> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('root_create_interest_centers') }}">Ajouter un CI</a></li>
                        <li><a href="{{ route('root_interest_centers') }}">Liste des CI</a></li>
                        <li><a href="{{ route('interest-center-categories.index') }}">Catégorie CI</a></li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect text-uppercase text-white" style="{{background_color_1()}}">
                        <strong>Exp Touristiques </strong>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart-plus"></i>
                        <strong>Exp Touristiques</strong> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('root_create_interest_centers') }}">Ajouter une exp</a></li>
                        <li><a href="{{ route('root_interest_centers') }}">Liste des exp</a></li>
                    </ul>
                </li>

                <li>
                    <a class="waves-effect text-uppercase text-white" style="{{background_color_1()}}">
                        <strong>utilisateur </strong>
                    </a>
                </li>
                <li class="">
                    <a href="" class="waves-effect"><i class="fa fa-users"></i><strong>
                            Liste des users</strong></a>
                </li>

                <li class="">
                    <a href="{{ route('profile.show') }}" class="waves-effect"><i class="fa fa-user-circle"></i><strong>
                            Mon profile</strong></a>
                </li>
                <li>
                    <a class="waves-effect text-uppercase text-white" style="{{background_color_1()}}">
                        <strong>A Propos </strong>
                    </a>
                </li>
                <li class="">
                    <a href="" class="waves-effect" data-toggle="modal" data-target="#apropos"><i class="fa fa-question"></i><strong>
                            A propos </strong></a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
