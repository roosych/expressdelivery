<div class="offcanvas offcanvas-start hp-mobile-sidebar bg-black-20 hp-bg-dark-90" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel" style="width: 256px;">
    <div class="offcanvas-header justify-content-between align-items-center ms-16 me-8 mt-16 p-0">
        <div class="w-auto px-0">
            <div class="hp-header-logo d-flex align-items-center">
                <a href="#" class="position-relative">
                    <img class="hp-logo hp-sidebar-hidden hp-dir-none hp-dark-none" src="{{asset('assets/img/logo-exp.png')}}" alt="logo">
                </a>
            </div>
        </div>

        <div class="w-auto px-0 hp-sidebar-collapse-button hp-sidebar-hidden" data-bs-dismiss="offcanvas" aria-label="Close">
            <button type="button" class="btn btn-text btn-icon-only bg-transparent">
                <i class="ri-close-fill lh-1 hp-text-color-black-80" style="font-size: 24px;"></i>
            </button>
        </div>
    </div>

    <div class="hp-sidebar hp-bg-color-black-20 hp-bg-color-dark-90 border-end border-black-40 hp-border-color-dark-80">
        <div class="hp-sidebar-container">
            <div class="hp-sidebar-header-menu">
                <div class="row justify-content-between align-items-end mx-0">
                    <div class="w-auto px-0 hp-sidebar-collapse-button hp-sidebar-visible">
                        <div class="hp-cursor-pointer">
                            <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.91102 1.73796L0.868979 4.78L0 3.91102L3.91102 0L7.82204 3.91102L6.95306 4.78L3.91102 1.73796Z" fill="#B2BEC3"></path>
                                <path d="M3.91125 12.0433L6.95329 9.00125L7.82227 9.87023L3.91125 13.7812L0.000224113 9.87023L0.869203 9.00125L3.91125 12.0433Z" fill="#B2BEC3"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="w-auto px-0">
                        <div class="hp-header-logo d-flex align-items-center">
                            <a href="{{route('dashboard.index')}}" class="position-relative">
                                <img class="hp-logo hp-sidebar-hidden hp-dir-none hp-dark-none" src="{{asset('assets/img/logo-exp.png')}}" alt="logo">
                            </a>
                        </div>
                    </div>

                    <div class="w-auto px-0 hp-sidebar-collapse-button hp-sidebar-hidden">
                        <div class="hp-cursor-pointer mb-4">
                            <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.91102 1.73796L0.868979 4.78L0 3.91102L3.91102 0L7.82204 3.91102L6.95306 4.78L3.91102 1.73796Z" fill="#B2BEC3"></path>
                                <path d="M3.91125 12.0433L6.95329 9.00125L7.82227 9.87023L3.91125 13.7812L0.000224113 9.87023L0.869203 9.00125L3.91125 12.0433Z" fill="#B2BEC3"></path>
                            </svg>
                        </div>
                    </div>
                </div>


                @include('parts.menu')


            </div>

            <div class="row justify-content-between align-items-center hp-sidebar-footer mx-0 hp-bg-color-dark-90">
                <div class="divider border-black-40 hp-border-color-dark-70 hp-sidebar-hidden mt-0 px-0"></div>

                <div class="col">
                    <div class="row align-items-center">
                        <div class="w-auto px-0">
                            <div class="avatar-item bg-primary-4 d-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px;">
                                <img src="{{asset('assets/img/user-avatar-4.png')}}" height="100%" class="hp-img-cover">
                            </div>
                        </div>

                        <div class="w-auto ms-8 px-0 hp-sidebar-hidden mt-4">
                            <span class="d-block hp-text-color-black-100 hp-text-color-dark-0 hp-p1-body lh-1">{{auth()->user()->name}}</span>
                            <a href="{{route('user.profile')}}" class="hp-badge-text fw-normal hp-text-color-dark-30">View Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col hp-flex-none w-auto px-0 hp-sidebar-hidden">
                    <a href="#">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="remix-icon hp-text-color-black-100 hp-text-color-dark-0" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path d="M3.34 17a10.018 10.018 0 0 1-.978-2.326 3 3 0 0 0 .002-5.347A9.99 9.99 0 0 1 4.865 4.99a3 3 0 0 0 4.631-2.674 9.99 9.99 0 0 1 5.007.002 3 3 0 0 0 4.632 2.672c.579.59 1.093 1.261 1.525 2.01.433.749.757 1.53.978 2.326a3 3 0 0 0-.002 5.347 9.99 9.99 0 0 1-2.501 4.337 3 3 0 0 0-4.631 2.674 9.99 9.99 0 0 1-5.007-.002 3 3 0 0 0-4.632-2.672A10.018 10.018 0 0 1 3.34 17zm5.66.196a4.993 4.993 0 0 1 2.25 2.77c.499.047 1 .048 1.499.001A4.993 4.993 0 0 1 15 17.197a4.993 4.993 0 0 1 3.525-.565c.29-.408.54-.843.748-1.298A4.993 4.993 0 0 1 18 12c0-1.26.47-2.437 1.273-3.334a8.126 8.126 0 0 0-.75-1.298A4.993 4.993 0 0 1 15 6.804a4.993 4.993 0 0 1-2.25-2.77c-.499-.047-1-.048-1.499-.001A4.993 4.993 0 0 1 9 6.803a4.993 4.993 0 0 1-3.525.565 7.99 7.99 0 0 0-.748 1.298A4.993 4.993 0 0 1 6 12c0 1.26-.47 2.437-1.273 3.334a8.126 8.126 0 0 0 .75 1.298A4.993 4.993 0 0 1 9 17.196zM12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
