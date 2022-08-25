<?php $url = url()->current();?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li <?php if(preg_match("/dashboard/i", $url)){?> class="active"<?php }?> ><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        @if(Session::get('adminType')['categories_access'] == 1)
        <li <?php if(preg_match('/categor/i', $url)){?> style="display: block;"<?php } ?>class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/category/i', $url)){?> style="display: block"<?php }?>>
                <li <?php if(preg_match("/add-category/i", $url)){?> class="active"<?php }?>><a href="{{ route('addcategory.page') }}">Add Category</a></li>
                <li <?php if(preg_match("/view-category/i", $url)){?> class="active"<?php }?>><a href="{{ route('viewcategory.page') }}">View Categories</a></li>
            </ul>
        </li>
        @endif
        @if(Session::get('adminType')['products_access'] == 1)
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/product/i', $url)){?> style="display: block"<?php }?> >
                <li <?php if(preg_match("/add-product/i", $url)){?> class="active"<?php }?>><a href="{{ route('addproduct.page') }}">Add Product</a></li>
                <li <?php if(preg_match("/view-products/i", $url)){?> class="active"<?php }?>><a href="{{ route('viewproduct.page') }}">View Products</a></li>
            </ul>
        </li>
        @endif
        @if(Session::get('adminType')['orders_access'] == 1)
        <?php
        $userurl = basename($url);?>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/order/i', $url)){?> style="display: block"<?php }?>>
                <li <?php if($userurl == "view-orders"){?> class="active"<?php }?>><a href="{{ url('/admin/view-orders') }}">View Orders</a></li>
                <li <?php if($userurl == "view-orders-chart"){?> class="active"<?php }?>><a href="{{ url('/admin/view-orders-chart') }}">View Orders Chart</a></li>
            </ul>
        </li>
        @endif
        @if(Session::get('adminType')['users_access'] == 1)
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Users</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/Users/i', $url)){?> style="display: block"<?php }?>>
                <li <?php if($userurl == "view-users"){?> class="active"<?php }?>><a href="{{ route('viewUsers') }}">View Users</a></li>
                <li <?php if($userurl == "view-users-charts"){?> class="active"<?php }?>><a href="{{ url('/admin/view-users-charts') }}">View Users Chart</a></li>
                <li <?php if($userurl == "view-users-country-charts"){?> class="active"<?php }?>><a href="{{ url('/admin/view-users-country-charts') }}">View Users Country Chart</a></li>

            </ul>
        </li>
        @endif
        @if(Session::get('adminType')['type'] == 'Admin')
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admin/Sub Admin</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/Admins/i', $url)){?> style="display: block"<?php }?>>
                <li <?php if($userurl == "add-admins"){?> class="active"<?php }?>><a href="{{ url('admin/add-admins') }}">Add Admins</a></li>
                <li <?php if($userurl == "view-admins"){?> class="active"<?php }?>><a href="{{ url('admin/view-admins') }}">View Admins</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/coupon/i', $url)){?> style="display: block"<?php }?>>
                <li <?php if(preg_match("/add-coupon/i", $url)){?> class="active"<?php }?>><a href="{{ route('addcoupon.page') }}">Add Coupon</a></li>
                <li <?php if(preg_match("/view-coupons/i", $url)){?> class="active"<?php }?>><a href="{{ route('viewcoupon.page') }}">View Coupon</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Pages</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/cms-page/i', $url)){?> style="display: block"<?php }?>>
                <li <?php if(preg_match("/add-cms-page/i", $url)){?> class="active"<?php }?>><a href="{{ url('/admin/add-cms-page') }}">Add Cms Page</a></li>
                <li <?php if(preg_match("/view-cms-page/i", $url)){?> class="active"<?php }?>><a href="{{ url('/admin/view-cms-page') }}">View Cms Page</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/banner/i', $url)){?> style="display: block"<?php }?>>
                <li <?php if(preg_match("/add-banner/i", $url)){?> class="active"<?php }?>><a href="{{ route('addbanner.page') }}">Add Banner</a></li>
                <li <?php if(preg_match("/view-banners/i", $url)){?> class="active"<?php }?>><a href="{{ route('viewbanner.page') }}">View Banner</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Currency</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/currency/i', $url)){?> style="display: block"<?php }?>>
                <li <?php if(preg_match("/add-currency/i", $url)){?> class="active"<?php }?>><a href="{{ url('/admin/add-currency') }}">Add Currency</a></li>
                <li <?php if(preg_match("/view-currency/i", $url)){?> class="active"<?php }?>><a href="{{ url('/admin/view-currency') }}">View Currency</a></li>
            </ul>
        </li>
        @endif
    </ul>
</div>
<!--sidebar-menu-->