    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo" >
              <a href="{{url('/dashboard')}}"><img src="{{ asset('images/Dhuwani.png') }}" alt="logo" style="width:60%; height: auto;"></a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
              </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item @if(Session::get('topmenu')=='home') {{'active'}} @endif">
              <a href="{{url('/dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Vehicle</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{url('vehicles')}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-table"></i>
                    <div data-i18n="Tables">Vehicle Setup</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="tables-vehicle-list.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-table"></i>
                    <div data-i18n="Tables">Vehicle List</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Room -->
            <li class="menu-item">
              <a href="{{url('room')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Room</div>
              </a>
      
            </li>

            <li class="menu-item">
              <a href="{{url('type')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Room Type</div>
              </a>
      
            </li>

            <li class="menu-item">
              <a href="{{url('allocate')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Allocate Room</div>
              </a>
      
            </li>


            <li class="menu-item @if(Session::get('topmenu')=='auth') {{'open'}} @endif">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Authorization</div>
              </a>
              <ul class="menu-sub">
                  <li class="menu-item @if(Session::get('menu')=='user') {{'active'}} @endif">
                    <a href="{{url('users')}}" class="menu-link" >
                      <div data-i18n="Basic">Users</div>
                    </a>
                  </li>   
                  <li class="menu-item @if(Session::get('menu')=='roles') {{'active'}} @endif">
                    <a href="{{url('roles')}}" class="menu-link" >
                      <div data-i18n="Basic">Roles</div>
                    </a>
                  </li>
                  <li class="menu-item @if(Session::get('menu')=='permission') {{'active'}} @endif">
                    <a href="{{url('permission')}}" class="menu-link" >
                      <div data-i18n="Basic">Permissions</div>
                    </a>
                  </li> 
                <li class="menu-item @if(Session::get('menu')=='permission_group') {{'active'}} @endif">
                  <a href="{{url('percategory')}}" class="menu-link">
                    <div data-i18n="Basic">Permission Category</div>
                  </a>
                </li>
                
              </ul>
            </li>
            <!-- Components -->
           

          </ul>
        </aside>