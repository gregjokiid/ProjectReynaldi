 <!-- Offcanvas Menu Begin -->
 <div class="offcanvas-menu-overlay"></div>
 <div class="offcanvas-menu-wrapper">
     <div class="offcanvas__close">+</div>
     <ul class="offcanvas__widget">
         <li><span class="icon_search search-switch"></span></li>
         <li><a href="#"><span class="icon_bag_alt"></span>
             <div class="tip">2</div>
         </a></li>
     </ul>
     <div class="offcanvas__logo">
         <a href="{{ url('/') }}"><img src="{{ asset('ashion') }}/img/logo.png" alt=""></a>
     </div>
     <div id="mobile-menu-wrap"></div>
 </div>
 <!-- Offcanvas Menu End -->

 <!-- Header Section Begin -->
 <header class="header">
     <div class="container-fluid">
         <div class="row">
             <div class="col-xl-3 col-lg-2">
                 <div class="">
                     <h1 class="title-logo">{{ $app_name }}</h1>
                 </div>
             </div>
             <div class="col-xl-6 col-lg-7 text-center">
                 <nav class="header__menu">
                     <ul>
                         <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                         <li class="{{ request()->is('product*') ? 'active' : '' }}"><a href="{{ route('product.index') }}">Shop</a></li>
                         <li class="{{ request()->is('category*') ? 'active' : '' }}"><a href="{{ route('category.index') }}">Category</a></li>
                         <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ route('contact.index') }}">Contact</a></li>
                         @auth
                          <li class="#"><a href="#"><i class="fa fa-angle-down"></i> {{ auth()->user()->name }}</a>
                            <ul class="dropdown">
                                @php($user_id = \Illuminate\Support\Facades\DB::table('model_has_roles')->where('model_id', '=', \Illuminate\Support\Facades\Auth::id())->get())
                                @foreach($user_id as $id)
                                    @if($id->role_id == 1 || $id->role_id == 3 || $id->role_id == 4 || $id->role_id == 5)
                                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <li>
                                                <a href="{{ route('logout')  }}" onclick="event.preventDefault();
                                        this.closest('form').submit();" > Logout
                                                </a>
                                            </li>
                                        </form>
                                    @endif

                                    @if($id->role_id == 2)
                                            <li><a href="{{ route('transaction.index') }}">Riwayat Belanja</a></li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <li>
                                                    <a href="{{ route('logout')  }}" onclick="event.preventDefault();
                                        this.closest('form').submit();" > Logout
                                                    </a>
                                                </li>
                                            </form>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                             @else
                             <li><a href="{{ route('login') }}">Login</a></li>
                         @endauth
                     </ul>
                 </nav>
             </div>
             <div class="col-lg-3">
                 <div class="header__right">
                     <ul class="header__right__widget">
                         <li><span class="icon_search search-switch"></span></li>
                         <li><a href="{{ route('cart.index') }}"><span class="icon_bag_alt"></span>
                             <div class="tip">
                                 {{ $totalCart ?? 0 }}
                             </div>
                         </a></li>
                     </ul>
                 </div>
             </div>
         </div>
         <div class="canvas__open">
             <i class="fa fa-bars"></i>
         </div>
     </div>
 </header>
 <!-- Header Section End -->
