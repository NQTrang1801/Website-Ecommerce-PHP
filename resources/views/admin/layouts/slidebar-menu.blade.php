<div class="sidebar-menu">
    <div class="sidebarMenuScroll">
        <ul>
            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-stickies"></i>
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
                            <a href="#">Imagess</a>
                        </li>
                        <li>
                            <a href="#">Variantss</a>
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
        </ul>
    </div>
</div>