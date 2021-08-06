<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-briefcase"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Akawo Bekee</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if(Auth::guard("vendor")->check())
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route("vendor-dashboard")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Plans
        </div>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Plans</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--<h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item" href="{{route("create-plan")}}">Create Plans</a>
                <a class="collapse-item" href="{{route("all-plans")}}">View Plans</a>
                {{--<a class="collapse-item" href="cards.html">Cards</a>--}}
            </div>
        </div>
    </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Wallet
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWallet"
               aria-expanded="true" aria-controls="collapseWallet">
                <i class="fas fa-fw fa-cog"></i>
                <span>Wallet</span>
            </a>
            <div id="collapseWallet" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    {{--<h6 class="collapse-header">Custom Components:</h6>--}}
                    <a class="collapse-item" href="{{route("vendor-wallet")}}">Edit Account details</a>
                    <a class="collapse-item" href="{{route("vendor-withdraw")}}">Withdraw</a>
                    {{--<a class="collapse-item" href="cards.html">Cards</a>--}}
                </div>
            </div>
        </li>
    @endif
    @if(Auth::guard("web")->check())
    <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{route("dashboard")}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Vendors
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
               aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-fw fa-cog"></i>
                <span>Vendors</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route("vendor-list")}}">Search Vendors</a>

                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Plans
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Plans</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    {{--<h6 class="collapse-header">Custom Components:</h6>--}}
                    <a class="collapse-item" href="{{route("my-plans")}}">My Plans</a>

                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Wallet
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWallet"
               aria-expanded="true" aria-controls="collapseWallet">
                <i class="fas fa-fw fa-cog"></i>
                <span>Wallet</span>
            </a>
            <div id="collapseWallet" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route("fund-wallet")}}">Fund Wallet</a>
                    <a class="collapse-item" href="{{route("edit-account")}}">Account Details</a>
                    <a class="collapse-item" href="{{route("user-withdraw")}}">Withdraw</a>
                </div>
            </div>
        </li>
@endif

    {{--<li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Create plans</span></a>
    </li>--}}


    {{--<!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Users
    </div>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>
--}}
    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{route("logout")}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Logout</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
