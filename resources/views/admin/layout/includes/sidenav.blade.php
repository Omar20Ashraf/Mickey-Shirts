{{-- Side Navigation --}}
<div class="col-md-2">
    <div class="sidebar content-box" style="display: block;">
        <ul class="nav">
            <!-- Main menu -->
            <li class="current"><a href="{{route('admin.home')}}"><i class="glyphicon glyphicon-home"></i>
                    Dashboard</a></li>

            {{-- Start Products Menu --}}
            <li class="submenu">
                <a href="#">
                    <i class="glyphicon glyphicon-list"></i>
                        Home Products
                    <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li>
                        <a href="{{route('product.create')}}">Add Product</a>
                    </li>

                    <li>
                        <a href="{{route('product.index')}}">Show Products</a>
                    </li>
                </ul>
            </li>
            {{-- End Products Menu --}}

            {{-- Start Shirts Page Products Menu --}}
            <li class="submenu">
                <a href="#">
                    <i class="glyphicon glyphicon-list"></i>
                        Shirts Products
                    <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li>
                        <a href="{{route('shirts.create')}}">Add Product</a>
                    </li>

                    <li>
                        <a href="{{route('shirts.index')}}">Show Products</a>
                    </li>
                </ul>
            </li>
            {{-- End Shirts Page Products Menu --}}

            {{-- Start Categories Menu --}}
            <li class="submenu">
                <a href="#">
                    <i class="glyphicon glyphicon-list"></i> Categories
                    <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li>
                        <a href="{{route('category.index')}}">
                            Show Categories
                        </a>
                    </li>
                </ul>
            </li>
            {{-- End Categories Menu --}}

            {{-- Start Orders Menu --}}
            <li class="submenu">
                <a href="#">
                    <i class="glyphicon glyphicon-list"></i> Orders
                    <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li><a href="{{url('admin/orders/pending')}}">Pending Orders</a></li>
                    <li><a href="{{url('admin/orders/delivered')}}">Delivered Orders</a></li>
                    <li><a href="{{url('admin/orders')}}">All Orders</a></li>
                </ul>
            </li>
            {{-- End Orders Menu --}}            
        </ul>
    </div>
</div> <!-- ADMIN SIDE NAV-->