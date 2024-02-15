<nav class="navbar navbar-dark">
  <div class="container-fluid">
    <div class="d-flex">
      <button class="btn btn-outline-light d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
        <i class="bx bx-menu"></i>
      </button>
      <span class="navbar-brand mt-2 mx-2"><img src="{{ asset("assets/image/logo/logo-text-white.png") }}" alt="Logo" width="200"></span>
    </div>
    <div class="dropdown">
      <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        @if (auth()->check())
        {{ auth()->user()->username }}
        @endif
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="{{ route('signout') }}">Signout</a></li>
        <form id="signout-form" action="{{ route('signout') }}" method="POST">
          @csrf
          @method('DELETE')
        </form>
      </ul>
    </div>
  </div>
</nav>

<div class="sidebar">
</div>
