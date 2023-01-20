<ul>
    <li>
        <div class="menu-title">DASHBOARD</div>

        <ul>
            <li>
                <a href="{{route('dashboard.index')}}">
                    <span>
                        <i class="hp-text-color-dark-0 ri-2x ri-dashboard-line"></i>
                        <span>Main page</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('drivers.index')}}">
                    <span>
                        <i class="hp-text-color-dark-0 ri-2x ri-aliens-line"></i>
                        <span>Drivers</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('driver.map')}}">
                    <span>
                        <i class="hp-text-color-dark-0 ri-2x ri-map-pin-2-line"></i>
                        <span>Map</span>
                    </span>
                </a>
            </li>

        </ul>
    </li>


    <li>
        <div class="menu-title">SETTINGS</div>

        <ul>


            <li>
                <a href="{{route('users.index')}}">
                    <span>
                        <i class="hp-text-color-dark-0 ri-2x ri-game-line"></i>
                        <span>Users</span>
                    </span>
                </a>
            </li>

            <li>
                <a href="{{route('vehicles.index')}}">
                    <span>
                        <i class="hp-text-color-dark-0 ri-2x ri-settings-line"></i>
                        <span>Vehicle types</span>
                    </span>
                </a>
            </li>
        </ul>
    </li>

</ul>