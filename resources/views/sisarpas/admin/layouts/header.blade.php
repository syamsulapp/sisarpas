 <!-- Navbar -->

 <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
     id="layout-navbar">
     <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
         <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
             <i class="bx bx-menu bx-sm"></i>
         </a>
     </div>

     <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
         <!-- Search -->
         <div class="navbar-nav align-items-center">
             <div class="nav-item d-flex align-items-center">
                 <p class="fs-5" style="margin-top: 15px;">Dashboard Admin</p>
             </div>
         </div>
         <!-- /Search -->

         <ul class="navbar-nav flex-row align-items-center ms-auto">
             <!-- Place this tag where you want the button to render. -->

             <!-- User -->
             <li class="nav-item navbar-dropdown dropdown-user dropdown">
                 <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                     <div class="avatar avatar-online">
                         @isset(Auth::guard('admin')->user()->image)
                             <img src="{{ asset('sisarpas/assets/adminImage/' . Auth::guard('admin')->user()->image) }}" alt
                                 class="w-px-40 h-auto rounded-circle" width="512px" height="512px" />
                         @else
                             <img src="{{ asset('sisarpas/assets/admin/assets/img/avatars/user_1144709.png') }}" alt
                                 class="w-px-40 h-auto rounded-circle" />
                         @endisset
                     </div>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end">
                     <li>
                         <a class="dropdown-item" href="#">
                             <div class="d-flex">
                                 <div class="flex-shrink-0 me-3">
                                     <div class="avatar avatar-online">
                                         @isset(Auth::guard('admin')->user()->image)
                                             <img src="{{ asset('sisarpas/assets/adminImage/' . Auth::guard('admin')->user()->image) }}"
                                                 alt class="w-px-40 h-auto rounded-circle" width="512px" height="512px" />
                                         @else
                                             <img src="{{ asset('sisarpas/assets/admin/assets/img/avatars/user_1144709.png') }}"
                                                 alt class="w-px-40 h-auto rounded-circle" />
                                         @endisset
                                     </div>
                                 </div>
                                 <div class="flex-grow-1">
                                     <span class="fw-medium d-block">{{ Auth::guard('admin')->user()->name }}</span>
                                     <small class="text-muted">
                                         @if (Auth::guard('admin')->user()->roles_id == 1)
                                             {{ __('Administrator') }}
                                         @endif
                                     </small>
                                 </div>
                             </div>
                         </a>
                     </li>

                     <li>
                         <div class="dropdown-divider"></div>
                     </li>
                     <li>
                         <form id="logout-admin" action="{{ route('admin.logout') }}" method="POST">
                             @csrf
                             <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                 onclick="event.preventDefault(); document.getElementById('logout-admin').submit();">
                                 <i class="bx bx-power-off me-2"></i>
                                 <span class="align-middle">Log Out</span>
                             </a>
                         </form>

                     </li>
                 </ul>
             </li>
             <!--/ User -->
         </ul>
     </div>
 </nav>

 <!-- / Navbar -->
