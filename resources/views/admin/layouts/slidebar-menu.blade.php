<div class="sidebar-menu">
    <div class="sidebarMenuScroll">
        <ul>
            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-clipboard"></i>
                    <span class="menu-text">Order management</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('orders.news')}}">New orders</a>
                        </li>
                        <li>
                            <a href="{{ route('orders.transit')}}">Approved orders</a>
                        </li>
                        <li>
                            <a href="{{ route('orders.confirmed')}}"> Completed Order</a>
                        </li>
                        <li>
                            <a href="{{ route('orders.Cancelled')}}">Cancelled Order</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-stickies"></i>
                    <span class="menu-text">Report</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                    </ul>
                </div>
            </li>
            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-handbag"></i>
                    <span class="menu-text">Product</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('categories.index') }}">Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('sub-categories.index') }}">Sub Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li>
                            <a href="{{ route('variantss.index') }}">Variantss</a>
                        </li>
                        <li>
                            <a href="{{ route('promotions.index') }}">Promotion</a>
                        </li>
                        <li>
                            <a href="{{ route('sizes.index') }}">Sizes</a>
                        </li>
                        <li>
                            <a href="{{ route('colors.index') }}">Colors</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">User</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('users.indexStaff') }}">Staff</a>
                        </li>
                        <li>
                            <a href="{{ route('users.indexCustomer') }}">Customers</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>