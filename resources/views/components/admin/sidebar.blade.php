<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-logo demo ">
            <img src="{{ asset('') }}/logo-sm.png" width="100" alt="brand-logo" height="65" />
        </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item 
      @if (request()->routeIs('admin.dashboard'))
          active
      @endif
      ">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <!-- Domain -->

      <li class="menu-item
      @if (request()->routeIs('domains.index'))
          active
      @endif
      ">
        <a href="{{route('domains.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-grid-alt"></i>
          <div data-i18n="Domain">Domain</div>
        </a>
      </li>

      <!-- Datas -->
      <li class="menu-item
      @if (request()->routeIs('get-form-data'))
          active
      @endif
      ">
        <a href="{{route('get-form-data')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Datas</div>
        </a>
      </li>

      <!-- Users -->
      <li class="menu-item
      @if (request()->routeIs('users.index'))
          active
      @endif
      ">
        <a href="{{route('users.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Layouts">Users</div>
        </a>
      </li>


    </ul>
  </aside>