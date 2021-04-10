<nav x-data="{ open: false }" style="background: rgba(243, 244, 246, 0.4);" class=" border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center mt-3">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- <div :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="inline-flex items-center mt-6 px-1 pt-1 border-b-2 border-indigo-400 leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out bg-gray-900 font-semibold p-2 text-white text-center rounded h-10">
                        {{ __('Dashboard') }}
                    </div> --}}
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="p-1 m-1 bg-green-400 capsule" onclick="toggleMode(this)" aria-checked="false">
                    <span class="hellow" role="checkbox" aria-checked="false" aria-label="Toggle dark mode" tabindex="0">
                        <div class="profile-color-modes-toggle-track"></div>
                        <div class="profile-color-modes-toggle-thumb">
                        <svg style="fill: #ffdf5d !important;margin: 7px 0 0 7px;" aria-hidden="true" width="14" height="13" viewBox="0 0 14 13" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.52208 7.71754C7.5782 7.71754 10.0557 5.24006 10.0557 2.18394C10.0557 1.93498 10.0392 1.68986 10.0074 1.44961C9.95801 1.07727 10.3495 0.771159 10.6474 0.99992C12.1153 2.12716 13.0615 3.89999 13.0615 5.89383C13.0615 9.29958 10.3006 12.0605 6.89485 12.0605C3.95334 12.0605 1.49286 10.001 0.876728 7.24527C0.794841 6.87902 1.23668 6.65289 1.55321 6.85451C2.41106 7.40095 3.4296 7.71754 4.52208 7.71754Z"></path>
                        </svg>
                        </div>
                    </span>
                </div>
                <style>
                    .capsule {
                        border: 2px solid rgb(82, 72, 72);
                        background: rgb(81, 81, 81);
                        width: 40px  !important;
                        height: 22px  !important;
                        border-radius: 10px;
                    }
                    .capsule:focus {
                        border: none !important;
                    }
                    .profile-color-modes-toggle-thumb:focus {
                        border: none !important;
                    }
                    .profile-color-modes-toggle-thumb {
                        width: 28px;
                        height: 28px;
                        border-radius: 50%;
                        background-color: #2f363d;
                        transition: transform .3s cubic-bezier(.4,.03,0,1);
                        cursor: pointer;
                        transform: translate(-10px, -15px);
                    }
                    svg {
                        margin: 7px 0 0 7px;
                        transform: translate(0px, 7px);

                    }
                    body {
                        line-height: 1.5 !important;
                    }
                </style>
                <script>
                    function toggleMode(event) {
                        
                        if(event.getAttribute('aria-checked') == 'false') {
                            
                            document.querySelector('body > div').style.background = 'rgba(13, 17, 23, 0.4)';
                            document.querySelector('body > div').style.color = 'rgb(243, 244, 246) !important';
                            document.querySelector('nav').style.background = 'rgba(13, 17, 23, 0.4)';
                            document.querySelector('nav').style.color = 'rgba(255, 255, 255, 0.4) !important';
                            
                            document.querySelector('.capsule').style.background = 'rgb(27, 32, 127)';
                            document.querySelector('.capsule').style.border = '2px solid #0d1117';
                            document.querySelector('.profile-color-modes-toggle-thumb').style.background = '#6e40c9';
                            document.querySelector('.profile-color-modes-toggle-thumb').style.transform = 'translate(10px, -15px)';
                            document.querySelector('.chatarea_user').style.background = 'rgba(13, 17, 23, 0.4)';
                            document.querySelector('.chatarea_msg').style.background = 'rgba(13, 17, 23, 0.4)';
                            document.querySelector('.chatarea_txt').style.background = 'rgba(13, 17, 23, 0.4)';
                            
                            
                            event.setAttribute('aria-checked', 'true');
                            // document.querySelector('canvas').remove();

                            // VANTA.NET({
                            //     el: "#body",
                            //     mouseControls: true,
                            //     touchControls: true,
                            //     gyroControls: false,
                            //     minHeight: 200.00,
                            //     minWidth: 200.00,
                            //     scale: 1.00,
                            //     scaleMobile: 1.00,
                            //     color: 0xff00ff,
                            //     backgroundColor: 0x0000000,
                            //     points: 20.00,
                            //     maxDistance: 28.00,
                            //     spacing: 20.00
                            // })


                        } else {
                            
                            document.querySelector('body > div').style.background = 'rgb(243,244,246, 0.4)';
                            document.querySelector('body > div').style.color = 'black !important';
                            document.querySelector('nav').style.background = 'rgb(243,244,246, 0.4)';
                            document.querySelector('nav').style.color = 'rgba(0, 0, 0, 0.4) !important';

                            document.querySelector('.capsule').style.background = 'rgb(113 111 116)';
                            document.querySelector('.capsule').style.border = '2px solid rgb(81, 81, 81)';
                            document.querySelector('.profile-color-modes-toggle-thumb').style.background = '#24292e';
                            document.querySelector('.profile-color-modes-toggle-thumb').style.transform = 'translate(-10px, -15px)';
                            document.querySelector('.chatarea_user').style.background = 'rgb(243,244,246, 0.4)';
                            document.querySelector('.chatarea_msg').style.background = 'rgb(243,244,246, 0.4)';
                            document.querySelector('.chatarea_txt').style.background = 'rgba(243,244,246, 0.4)';

                            event.setAttribute('aria-checked', 'false');

                            // document.querySelector('canvas').remove();
                            // VANTA.NET({
                            //     el: "#body",
                            //     mouseControls: true,
                            //     touchControls: true,
                            //     gyroControls: false,
                            //     minHeight: 200.00,
                            //     minWidth: 200.00,
                            //     scale: 1.00,
                            //     scaleMobile: 1.00,
                            //     color: 0xff00ff,
                            //     backgroundColor: 0x0ffffff,
                            //     points: 20.00,
                            //     maxDistance: 28.00,
                            //     spacing: 20.00
                            // })
                        }
                    }
                </script>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
