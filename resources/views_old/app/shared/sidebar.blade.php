 <!-- partial:partials/_sidebar.html -->
 @php
$ses_um_full_name = Session::get('user')['um_full_name'];
$ses_um_id = Session::get('user')['um_id'];
$ses_um_user_type = Session::get('user')['um_user_type'];
@endphp
 <nav class="sidebar sidebar-offcanvas boxShadow" id="sidebar">

    <ul class="nav">
      {{-- @if ($ses_um_user_type == 'A') --}}
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.index')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li> --}}
      {{-- @endif --}}
      {{-- @if ($ses_um_user_type == 'MA')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.meetingadminindex')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Meeting Admin Dashboard</span>
        </a>
      </li>
      @endif
      @if ($ses_um_user_type == 'U')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.userindex')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">User Dashboard</span>
        </a>
      </li>
      @endif --}}
      
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Manage User</span>
        </a>
      </li>
             {{-- @if ($ses_um_user_type == 'A') --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('department.index')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Manage Product</span>
        </a>
      </li>
      {{-- @endif --}}
      {{-- @if ($ses_um_user_type == 'A')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('section.index')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Manage Section</span>
        </a>
      </li>
      @endif --}}

      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('meeting.index')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Manage Meeting</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.faq')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">FAQ'S</span>
        </a>
      </li> --}}
{{--     
      <li class="nav-item">
        <a class="nav-link" href="{{ route('agenda.index')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Manage Agenda</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('agendatask.index')}}">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Manage Agenda Task</span>
        </a>
      </li> --}}
      {{-- <li class="nav-item">
     
        <a class="nav-link" data-toggle="collapse" href="#user-basic" aria-expanded="false" aria-controls="user-basic">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">User Master</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="user-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="">User List</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('user.create')}}">Add User</a></li>
          </ul>
        </div>
      </li> --}}
{{-- 
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#department-basic" aria-expanded="false" aria-controls="department-basic">
          <i class="mdi mdi-airplay menu-icon"></i>
          <span class="menu-title">Department Master</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="department-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('department.index')}}">Department List</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('department.create')}}">Add Department</a></li>
          </ul>
        </div>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#section-basic" aria-expanded="false" aria-controls="section-basic">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Section Master</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="section-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('section.index')}}">Section List</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('section.create')}}">Add Section</a></li>
          </ul>
        </div>
      </li> --}}

      {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#meeting-basic" aria-expanded="false" aria-controls="meeting-basic">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Meeting Master</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="meeting-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('meeting.index')}}">Meeting List</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('meeting.create')}}">Add Meeting</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('meetingschedule.index')}}">schedule Meeting List</a></li>
          </ul>
        </div>
      </li> --}}

      {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#agenda-basic" aria-expanded="false" aria-controls="agenda-basic">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Agneda Master</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="agenda-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('agenda.index')}}">Agenda List</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('agenda.create')}}">Add Agenda</a></li>
          </ul>
        </div>
      </li> --}}

      
      {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#agendatask-basic" aria-expanded="false" aria-controls="agendatask-basic">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Agneda Task Master</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="agendatask-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('agenda.index')}}">Agenda List</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('agendatask.create')}}">Add Agenda Task</a></li>
          </ul>
        </div>
      </li> --}}


   
      {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-invert-colors menu-icon"></i>
          <span class="menu-title">UI Elements</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/accordions.html">Accordions</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/badges.html">Badges</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/breadcrumbs.html">Breadcrumbs</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/modals.html">Modals</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/progress.html">Progress bar</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/pagination.html">Pagination</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tabs.html">Tabs</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tooltips.html">Tooltips</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/popups.html">Popups</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/notifications.html">Notifications</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
          <i class="mdi mdi-flask-outline menu-icon"></i>
          <span class="menu-title">Advanced UI</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-advanced">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dragula.html">Dragula</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/clipboard.html">Clipboard</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/context-menu.html">Context menu</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/slider.html">Sliders</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/carousel.html">Carousel</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/colcade.html">Colcade</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/loaders.html">Loaders</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="mdi mdi-clipboard-text-outline menu-icon"></i>
          <span class="menu-title">Form elements</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>                
            <li class="nav-item"><a class="nav-link" href="pages/forms/advanced_elements.html">Advanced Elements</a></li>
            <li class="nav-item"><a class="nav-link" href="pages/forms/validation.html">Validation</a></li>
            <li class="nav-item"><a class="nav-link" href="pages/forms/wizard.html">Wizard</a></li>
            <li class="nav-item"><a class="nav-link" href="pages/forms/text_editor.html">Text editors</a></li>
            <li class="nav-item"><a class="nav-link" href="pages/forms/code_editor.html">Code editors</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="mdi mdi-chart-donut menu-icon"></i>
          <span class="menu-title">Charts</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/charts/morris.html">Morris</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/charts/flot-chart.html">Flot</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/charts/google-charts.html">Google charts</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/charts/sparkline.html">Sparkline js</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/charts/c3.html">C3 charts</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/charts/chartist.html">Chartists</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/charts/justGage.html">JustGage</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Tables</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/tables/data-table.html">Data table</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/tables/js-grid.html">Js-grid</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/tables/sortable-table.html">Sortable table</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="mdi mdi-emoticon-outline menu-icon"></i>
          <span class="menu-title">Icons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/icons/flag-icons.html">Flag icons</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/icons/simple-line-icon.html">Simple line icons</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/icons/themify.html">Themify icons</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
          <i class="mdi mdi-map-outline menu-icon"></i>
          <span class="menu-title">Maps</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="maps">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/maps/mapael.html">Mapael</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/maps/vector-map.html">Vector Map</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/maps/google-maps.html">Google Map</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
          <i class="mdi mdi-file-outline menu-icon"></i>
          <span class="menu-title">General Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="general-pages">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/profile.html"> Profile </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/faq.html"> FAQ </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/faq-2.html"> FAQ 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/news-grid.html"> News grid </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/timeline.html"> Timeline </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/search-results.html"> Search Results </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/portfolio.html"> Portfolio </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/invoice.html"> Invoice </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/pricing-table.html"> Pricing Table </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/orders.html"> Orders </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> Error 404 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Error 500 </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#apps" aria-expanded="false" aria-controls="apps">
          <i class="mdi mdi-cube-outline menu-icon"></i>
          <span class="menu-title">Apps</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="apps">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/apps/email.html"> Email </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/apps/calendar.html"> Calendar </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/apps/todo.html"> Todo List </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/apps/gallery.html"> Gallery </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/documentation/documentation.html">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>  --}}
    </ul>
  </nav>
  <!-- partial -->