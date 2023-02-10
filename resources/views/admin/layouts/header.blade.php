<header class="header header-sticky">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="{{ url('admin/vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
            </svg>
        </button>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md"><img class="avatar-img" src="{{ url('admin/assets/img/avatars/8.jpg')}}" alt="user@email.com"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">

                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Settings</div>
                    </div><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="{{ url('admin/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg> Profile</a><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="{{ url('admin/vendors/@coreui/icons/svg/free.svg#cil-settings')}}"></use>
                        </svg> Settings</a><a class="dropdown-item" href="admin/logout">
                        <svg class="icon me-2">
                            <use xlink:href="{{ url('admin/vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
                        </svg> Logout</a>
                </div>
            </li>
        </ul>
    </div>
    
</header>