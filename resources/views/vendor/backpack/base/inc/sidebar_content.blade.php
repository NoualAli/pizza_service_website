<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<!-- Users, Roles, Permissions -->
{{-- @hasallroles(backpack_user()->getRoleNames(), 'web') --}}
@hasrole('root')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}">
                    <i class="nav-icon la la-user"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}">
                    <i class="nav-icon la la-id-badge"></i>
                    <span>Roles</span>
                </a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}">
                    <i class="nav-icon la la-key"></i>
                    <span>Permissions</span>
                </a>
            </li>
        </ul>
    </li>
@endrole

@hasanyrole('root|restaurer')
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('restaurant') }}'>
            <i class="nav-icon las la-store-alt"></i>
            Restaurants
        </a>
    </li>

    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('menu') }}'>
            <i class="nav-icon las la-th-list"></i>
            Menus
        </a>
    </li>

    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('product') }}'>
            <i class="nav-icon las la-boxes"></i>
            Products
        </a>
    </li>
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('ingredient') }}'>
            <i class="nav-icon las la-pepper-hot"></i>
            Ingredients
        </a>
    </li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'>
            <i class="nav-icon las la-tags"></i>
            Categories
        </a>
    </li>
@endrole
