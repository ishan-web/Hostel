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

            <li class="menu-item">
              <a href="{{url('feed')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Add Feedback</div>
              </a>
      
            </li>

            <li class="menu-item">
              <a href="{{url('stuDetails')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Student Details</div>
              </a>
      
            </li>
           

          </ul>
        </aside>