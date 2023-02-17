<div class="col hp-flex-none w-auto hp-horizontal-block hp-horizontal-menu">
    <ul class="d-flex flex-wrap align-items-center">
        <li class="px-6">
            <a href="{{route('dashboard.index')}}" class="px-12 py-4 {{request()->routeIs('dashboard.index') ? 'active' : ''}}">
                Dashboard
            </a>
        </li>

        <li class="px-6">
            <a href="{{route('driver.map')}}" class="px-12 py-4 {{request()->routeIs('driver.map') ? 'active' : ''}}">
                Map
            </a>
        </li>

        <li class="px-6">
            <a href="{{route('drivers.index')}}" class="px-12 py-4 {{request()->routeIs('drivers.index') ? 'active' : ''}}">
                Drivers
            </a>
        </li>

        <li class="px-6">
            <a href="{{route('owner.index')}}" class="px-12 py-4 {{request()->routeIs('owner.index') ? 'active' : ''}}">
                Owners
            </a>
        </li>

        <li class="px-6">
            <a href="{{route('vehicles.index')}}" class="px-12 py-4 {{request()->routeIs('vehicles.index') ? 'active' : ''}}">
                Vehicle types
            </a>
        </li>

        <li class="px-6">
            <a href="{{route('equipment.index')}}" class="px-12 py-4 {{request()->routeIs('equipment.index') ? 'active' : ''}}">
                Equipment
            </a>
        </li>

        <li class="px-6">
            <a href="{{route('users.index')}}" class="px-12 py-4 {{request()->routeIs('users.index') ? 'active' : ''}}">
                Users
            </a>
        </li>

    </ul>
</div>