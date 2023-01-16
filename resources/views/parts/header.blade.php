<header>
    <div class="row w-100 m-0">
        <div class="col px-0">
            <div class="row w-100 align-items-center justify-content-between position-relative">
                <div class="col w-auto hp-flex-none hp-mobile-sidebar-button me-24 px-0" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                    <button type="button" class="btn btn-text btn-icon-only">
                        <i class="ri-menu-fill hp-text-color-black-80 hp-text-color-dark-30 lh-1" style="font-size: 24px;"></i>
                    </button>
                </div>

                <div class="hp-horizontal-logo-menu d-flex align-items-center w-auto">
                    <div class="col hp-flex-none w-auto hp-horizontal-block">
                        <div class="hp-header-logo d-flex align-items-center">
                            <a href="#" class="position-relative">
                                <img class="hp-logo hp-sidebar-hidden hp-dir-none hp-dark-none" src="{{asset('assets/img/logo-exp.png')}}" alt="logo">
                            </a>
                        </div>
                    </div>

                    <div class="col hp-flex-none w-auto hp-horizontal-block hp-horizontal-menu ps-24">
                        @include('parts.menu')
                    </div>
                </div>


                <div class="col hp-flex-none w-auto pe-0">
                    <div class="row align-items-center justify-content-end">

                        <div class="hover-dropdown-fade w-auto px-0 ms-6 position-relative">
                            <div class="hp-cursor-pointer rounded-4 border hp-border-color-dark-80">
                                <div class="rounded-3 overflow-hidden m-4 d-flex">
                                    <div class="avatar-item hp-bg-info-4 d-flex" style="width: 32px; height: 32px;">
                                        <img src="{{asset('assets/img/user-avatar-4.png')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="hp-header-profile-menu dropdown-fade position-absolute pt-18" style="top: 100%; width: 260px;">
                                <div class="rounded hp-bg-black-0 hp-bg-dark-100 px-18 py-24">
                                    <span class="d-block h5 hp-text-color-black-100 hp-text-color-dark-0 mb-16">Profile Settings</span>

                                    <a href="{{route('user.profile')}}" class="hp-p1-body fw-medium hp-hover-text-color-primary-2">View Profile</a>

                                    <div class="divider mt-12 mb-18"></div>

                                    <div class="row">

                                        <div class="col-12 ">
                                            <a class="hp-p1-body fw-medium"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>