<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">Kiat Teknik</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">KT</a>
      </div>
      <ul class="sidebar-menu">
          @php($user_id = \Illuminate\Support\Facades\DB::table('model_has_roles')->where('model_id', '=', \Illuminate\Support\Facades\Auth::id())->get())
          @foreach($user_id as $id)
              @if($id->role_id == 1)
                  <li class="menu-header">Menu Admin</li>
                  <li><a class="nav-link" href="{{ route('master.purchaseOrder.index') }}"><i class="fas fa-warehouse"></i> <span>Purchase Order</span></a></li>
                  <li><a class="nav-link" href="{{ route('feature.order.index',0) }}"><i class="fas fa-shopping-cart"></i> <span>Menunggu Pembayaran</span></a></li>
                  <li><a class="nav-link" href="{{ route('feature.order.index',1) }}"><i class="fas fa-shopping-cart"></i> <span>Mengkonfirmasi Pembayaran</span></a></li>
                  <li><a class="nav-link" href="{{ route('feature.order.index',2) }}"><i class="fas fa-shopping-cart"></i> <span>Pembayaran Selesai</span></a></li>
                  <li><a class="nav-link" href="{{ route('feature.order.index',3) }}"><i class="fas fa-shopping-cart"></i> <span>Pesanan Selesai</span></a></li>
                  <li><a class="nav-link" href="{{ route('feature.order.index',4) }}"><i class="fas fa-shopping-cart"></i> <span>Pesanan Dibatalkan</span></a></li>
              @endif

              @if($id->role_id == 3)
                      <li class="menu-header">Menu Purchasing</li>
                      <li><a class="nav-link" href="{{ route('master.deliveryOrder.index') }}"><i class="fas fa-boxes"></i> <span>Delivery Order</span></a></li>
              @endif

              @if($id->role_id == 4)
                      <li class="menu-header">Menu Cashier</li>
                      <li><a class="nav-link" href="{{ route('feature.order.index',6) }}"><i class="fas fa-shopping-cart"></i> <span>Menunggu Pembayaran</span></a></li>
                      <li><a class="nav-link" href="{{ route('feature.order.index',5) }}"><i class="fas fa-shopping-cart"></i> <span>Pesanan Selesai</span></a></li>
              @endif

              @if($id->role_id == 5)
                      <li class="menu-header">Menu Owner</li>
                      <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span> {{ __('menu.dashboard') }}</span></a></li>
                      <li><a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-users"></i> <span>User</span></a></li>
                      <li><a class="nav-link" href="{{ route('master.purchaseOrder.index') }}"><i class="fas fa-warehouse"></i> <span>Purchase Order</span></a></li>
                      <li><a class="nav-link" href="{{ route('master.deliveryOrder.index') }}"><i class="fas fa-boxes"></i> <span>Delivery Order</span></a></li>
                      <li class="nav-item dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-table"></i><span>Master</span></a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="{{ route('master.category.index') }}">{{ __('menu.category') }}</a></li>
                              <li><a class="nav-link" href="{{ route('master.product.index') }}">{{ __('menu.product') }}</a></li>
                              <li><a class="nav-link" href="{{ route('master.supplier.index') }}">Supplier</a></li>
                          </ul>
                      </li>
                      <li class="nav-item dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i><span>{{ __('menu.order') }}</span></a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="{{ route('feature.order.index') }}">{{ __('menu.order_all') }}</a></li>
                              <li><a class="nav-link" href="{{ route('feature.order.index',0) }}">Menunggu Pembayaran</a></li>
                              <li><a class="nav-link" href="{{ route('feature.order.index',1) }}">Mengkonfirmasi Pembayaran</a></li>
                              <li><a class="nav-link" href="{{ route('feature.order.index',2) }}">Pembayaran Selesai</a></li>
                              <li><a class="nav-link" href="{{ route('feature.order.index',3) }}">Pesanan Selesai</a></li>
                              <li><a class="nav-link" href="{{ route('feature.order.index',6) }}">Menunggu Pembayaran - Offline</a></li>
                              <li><a class="nav-link" href="{{ route('feature.order.index',5) }}">Pesanan Selesai - Offline</a></li>
                              <li><a class="nav-link" href="{{ route('feature.order.index',4) }}">Pesanan Dibatalkan</a></li>
                          </ul>
                      </li>
                      <li class="nav-item dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>{{ __('menu.setting') }}</span></a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="{{ route('setting.web') }}">{{ __('menu.setting_web') }}</a></li>
                              <li><a class="nav-link" href="{{ route('setting.shipping') }}">{{ __('menu.setting_address') }}</a></li>
                          </ul>
                      </li>
              @endif
          @endforeach
        </ul>
    </aside>
  </div>
