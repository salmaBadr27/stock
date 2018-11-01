
<div class="sidebar-collapse">
<ul class="nav" id="main-menu">
    <li class="text-center">
        <li>
            <a class="active-menu"  href="{{URL::to('/dashboard')}}"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
        </li>
          
        <li>
            <a href="#"><i class="fa fa-sitemap fa-2x"></i>Orders<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{URL::to('/add-order')}}">New Order</a>
                    <li>
                        <a href="{{URL::to('/all-orders')}}">All Orders</a>
                    </li>
                </li>
                    </ul>
                </li>
         
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Purchases<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">New Purchase</a>
                            <li>
                                <a href="#">All Purchases</a>
                            </li>
                        </li>
                            </ul>
                        </li>				
        
                           
        <li>
            <a href="#"><i class="fa fa-sitemap fa-2x"></i>Items<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{URL::to('/add-item')}}">Add item</a>
                </li>
                <li>
                    <a href="{{URL::to('/all-item')}}">All items</a>
                </li>
               
                    </ul>
                   
                </li>
                <li>
                        <a href="#"><i class="fa fa-sitemap fa-2x"></i>Categories<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL::to('/add-category')}}">Add Category</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/all-category')}}">All Categories</a>
                            </li>
                           
                                </ul>
                               
                            </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Clients<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{URL::to('/add-client')}}">Add Client</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/all-client')}}">All Clients</a>
                        </li>
                       
                            </ul>
                           
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-2x"></i>Suppliers<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('/add-supplier')}}">Add Supplier</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/all-supplier')}}">All Suppliers</a>
                                </li>
                               
                                    </ul>
                                   
                                </li>

            </ul>
          </li>  
   
    </ul>
</div>

