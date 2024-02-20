<div class="sidebar">
  <div class="logo-details">
    <i class="icon"><img src="{{ asset('assets/image/Logo/logo-white.png') }}" alt="" width="30" class="img-fluid"></i>
    <div class="logo_name">EARTHMOVER</div>
    <i class="bx bx-menu" id="btn"></i>
  </div>
  <ul class="nav-list ps-0">
    <li>
      @if(auth()->check() && auth()->user()->roleId === 1)
      <a href="{{ url('admin/dashboard') }}">
      @elseif(auth()->check() && auth()->user()->roleId === 2)
          <a href="{{ url('cashier/dashboard') }}">
      @endif
        <i class="bx bx-grid-alt"></i>
        <span class="links_name">Dashboard</span>
      </a>
      <span class="tooltip">Dashboard</span>
    </li> 
    <li>
      @if(auth()->check() && auth()->user()->roleId === 1)
      <a href="{{ url('admin/products') }}">
      @endif
      @if(auth()->check() && auth()->user()->roleId === 2)
      <a href="{{ url('cashier/products') }}">
      @endif
        <i class="bx bx-box"></i>
        <span class="links_name">Products</span>
      </a>
      <span class="tooltip">Products</span>
    </li>
    <li>
      @if(auth()->check() && auth()->user()->roleId === 1)
      <a href="{{ url('admin/customers') }}">
      @endif
      @if(auth()->check() && auth()->user()->roleId === 2)
      <a href="{{ url('cashier/customers') }}">
      @endif
        <i class="bx bx-group"></i>
        <span class="links_name">Customers</span>
      </a>
      <span class="tooltip">Customers</span>
    </li>
    <li>
      @if(auth()->check() && auth()->user()->roleId === 1)
      <a href="{{ url('admin/orders') }}">
      @endif
      @if(auth()->check() && auth()->user()->roleId === 2)
      <a href="{{ url('cashier/orders') }}">
      @endif
        <i class="bx bx-cart"></i>
        <span class="links_name">Orders</span>
      </a>
      <span class="tooltip">Orders</span>
    </li> 
    <li>
      @if(auth()->check() && auth()->user()->roleId === 1)
      <a href="{{ url('admin/transactions') }}">
      @endif
      @if(auth()->check() && auth()->user()->roleId === 2)
      <a href="{{ url('cashier/transactions') }}">
      @endif
        <i class="bx bx-wallet"></i>
        <span class="links_name">Transactions</span>
      </a>
      <span class="tooltip">Transactions</span>
    </li>
    @if(auth()->check() && auth()->user()->roleId === 1)
    <li>
      <a href="{{ url('admin/categories') }}">
        <i class="bx bx-purchase-tag-alt"></i>
        <span class="links_name">Categories</span>
      </a>
      <span class="tooltip">Categories</span>
    </li>
    <li>
      <a href="{{ url('admin/suppliers') }}">
        <i class="bx bx-store-alt"></i>
        <span class="links_name">Suppliers</span>
      </a>
      <span class="tooltip">Suppliers</span>
    </li>
    
    <li>
      <a href="{{ url('admin/users') }}">
        <i class="bx bx-group"></i>
        <span class="links_name">Users</span>
      </a>
      <span class="tooltip">Users</span>
    </li>
    @endif
    <li class="profile">
      <div class="profile-details">
          @php
              $user = auth()->user();
              $profileImage = $user->image ? asset('storage/' . $user->image) : asset('assets/image/Icon/profile-icon.jpg');
          @endphp
          <img src="{{ $profileImage }}" alt="profileImg" />
          <div class="name_job">
              @if (auth()->check())
                  <div class="name">{{ $user->username }}</div>
                  <div class="job">{{ $user->role->role }}</div>
              @endif
          </div>
      </div>
      <a href=""><i class="bx bx-cog" id="setting"></i></a>
      <a href="{{ route('signout') }}"><i class="bx bx-log-out" id="log_out"></i></a>
  </li>
  
  </ul>
</div>

@push('scripts')
<script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");
    closeBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("open");
      menuBtnChange();
  });
    searchBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("open");
      menuBtnChange(); 
  });

  function menuBtnChange() {
    if(sidebar.classList.contains("open")){
      closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
  }else {
    closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const ps = new PerfectScrollbar('.sidebar .nav-list', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
    });
  }); 

</script>
@endpush