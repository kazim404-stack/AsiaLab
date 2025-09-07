   <header class="navbar-expand-md">
       <div class="collapse navbar-collapse" id="navbar-menu">
           <div class="navbar">
               <div class="container-xl">
                   <ul class="navbar-nav">
                       <li class="nav-item {{ setActive(['dashboard']) }}">
                           <a class="nav-link" href="{{ route('dashboard') }}">
                               <span
                                   class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                       viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                       stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                       <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                       <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                   </svg>
                               </span>
                               <span class="nav-link-title">
                                   Home
                               </span>
                           </a>
                       </li>
                       <li class="nav-item dropdown {{ setActive(['admin.sliders.*', 'admin.slider-images.*']) }}">
                           <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                               <span
                                   class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                       viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                       stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                       <path d="M12 12l8 -4.5" />
                                       <path d="M12 12l0 9" />
                                       <path d="M12 12l-8 -4.5" />
                                       <path d="M16 5.25l-8 4.5" />
                                   </svg>
                               </span>
                               <span class="nav-link-title">
                                   Slider
                               </span>
                           </a>
                           <div class="dropdown-menu">
                               <div class="dropdown-menu-columns">
                                   <div class="dropdown-menu-column">
                                       <a class="dropdown-item" href="{{ route('admin.sliders.index') }}">
                                           Slider
                                       </a>
                                       <a class="dropdown-item" href="{{ route('admin.slider-images.index') }}">
                                           Slider image
                                       </a>
                                   </div>

                               </div>
                           </div>
                       </li>
                       <li
                           class="nav-item dropdown {{ setActive(['admin.general-settings.*', 'admin.contacts.*', 'admin.phones.*']) }}">
                           <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                               <span
                                   class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                       viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                       stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                       <path d="M12 12l8 -4.5" />
                                       <path d="M12 12l0 9" />
                                       <path d="M12 12l-8 -4.5" />
                                       <path d="M16 5.25l-8 4.5" />
                                   </svg>
                               </span>
                               <span class="nav-link-title">
                                   General Setting
                               </span>
                           </a>
                           <div class="dropdown-menu">
                               <div class="dropdown-menu-columns">
                                   <div class="dropdown-menu-column">
                                       <a class="dropdown-item" href="{{ route('admin.general-settings.index') }}">
                                           General Setting
                                       </a>
                                       <a class="dropdown-item" href="{{ route('admin.provinces.index') }}">
                                           Province
                                       </a>
                                       <a class="dropdown-item" href="{{ route('admin.contacts.index') }}">
                                           Contact
                                       </a>
                                       <a class="dropdown-item" href="{{ route('admin.phones.index') }}">
                                           Phone
                                       </a>
                                   </div>

                               </div>
                           </div>
                       </li>
                       <li class="nav-item {{ setActive(['admin.about.*']) }}">
                           <a class="nav-link" href="{{ route('admin.about.index') }}">
                               <span
                                   class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                       viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                       stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M9 11l3 3l8 -8" />
                                       <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                   </svg>
                               </span>
                               <span class="nav-link-title">
                                   About Us
                               </span>
                           </a>
                       </li>
                       <li
                           class="nav-item dropdown {{ setActive(['admin.categories.*', 'admin.methods.*', 'admin.machines.*', 'admin.tests.*']) }}">
                           <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                               data-bs-auto-close="outside" role="button" aria-expanded="false">
                               <span
                                   class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                       height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                       fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                       <path d="M12 12l8 -4.5" />
                                       <path d="M12 12l0 9" />
                                       <path d="M12 12l-8 -4.5" />
                                       <path d="M16 5.25l-8 4.5" />
                                   </svg>
                               </span>
                               <span class="nav-link-title">
                                   Catalog
                               </span>
                           </a>
                           <div class="dropdown-menu">
                               <div class="dropdown-menu-columns">
                                   <div class="dropdown-menu-column">
                                       <a class="dropdown-item" href="{{ route('admin.categories.index') }}">
                                           Cateogry
                                       </a>
                                       <a class="dropdown-item" href="{{ route('admin.tests.index') }}">
                                           Test
                                       </a>

                                   </div>

                               </div>
                           </div>
                       </li>
                       <li class="nav-item {{ setActive(['admin.key-values.*']) }}">
                           <a class="nav-link" href="{{ route('admin.key-values.index') }}">
                               <span
                                   class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                       height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                       fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M9 11l3 3l8 -8" />
                                       <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                   </svg>
                               </span>
                               <span class="nav-link-title">
                                   KeyValue
                               </span>
                           </a>
                       </li>
                       <li class="nav-item {{ setActive(['admin.testimonails.*']) }}">
                           <a class="nav-link" href="{{ route('admin.testimonails.index') }}">
                               <span
                                   class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                       height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                       fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M9 11l3 3l8 -8" />
                                       <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                   </svg>
                               </span>
                               <span class="nav-link-title">
                                   Testimonail
                               </span>
                           </a>
                       </li>
                       <li class="nav-item {{ setActive(['admin.faqs.*']) }}">
                           <a class="nav-link" href="{{ route('admin.faqs.index') }}">
                               <span
                                   class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                       height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                       fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M9 11l3 3l8 -8" />
                                       <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                   </svg>
                               </span>
                               <span class="nav-link-title">
                                   Faqs
                               </span>
                           </a>
                       </li>
                   </ul>

               </div>
           </div>
       </div>
   </header>
