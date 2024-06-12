import { NotificationContext, useNotifications } from '@/Contexts/NotificationContext';
import { InertiaLink } from '@inertiajs/inertia-react';
import React, { useContext, useEffect, useState } from 'react'
import { Link } from '@inertiajs/react'
import SearchBar from '@/Components/SearchBar';

function MiniSideBar({user, setMiniSideBar, searchClicked}) {

    let { notifications } = useNotifications();

  return (
    <div className='flex'> 
        <nav class={`w-22 h-screen ${ !searchClicked && 'border-r-[1px] border-[#202020]' } w-[4vw]`} >
            <div class="h-full d-flex flex-column items-center justify-around m-auto p-1">
                <div>
                    <Link class="text-white" href="/">
                        <svg aria-label="Instagram" class="" fill="white" height="28" role="img" viewBox="0 0 24 24" width="28"><title>Instagram</title><path d="M12 2.982c2.937 0 3.285.011 4.445.064a6.087 6.087 0 0 1 2.042.379 3.408 3.408 0 0 1 1.265.823 3.408 3.408 0 0 1 .823 1.265 6.087 6.087 0 0 1 .379 2.042c.053 1.16.064 1.508.064 4.445s-.011 3.285-.064 4.445a6.087 6.087 0 0 1-.379 2.042 3.643 3.643 0 0 1-2.088 2.088 6.087 6.087 0 0 1-2.042.379c-1.16.053-1.508.064-4.445.064s-3.285-.011-4.445-.064a6.087 6.087 0 0 1-2.043-.379 3.408 3.408 0 0 1-1.264-.823 3.408 3.408 0 0 1-.823-1.265 6.087 6.087 0 0 1-.379-2.042c-.053-1.16-.064-1.508-.064-4.445s.011-3.285.064-4.445a6.087 6.087 0 0 1 .379-2.042 3.408 3.408 0 0 1 .823-1.265 3.408 3.408 0 0 1 1.265-.823 6.087 6.087 0 0 1 2.042-.379c1.16-.053 1.508-.064 4.445-.064M12 1c-2.987 0-3.362.013-4.535.066a8.074 8.074 0 0 0-2.67.511 5.392 5.392 0 0 0-1.949 1.27 5.392 5.392 0 0 0-1.269 1.948 8.074 8.074 0 0 0-.51 2.67C1.012 8.638 1 9.013 1 12s.013 3.362.066 4.535a8.074 8.074 0 0 0 .511 2.67 5.392 5.392 0 0 0 1.27 1.949 5.392 5.392 0 0 0 1.948 1.269 8.074 8.074 0 0 0 2.67.51C8.638 22.988 9.013 23 12 23s3.362-.013 4.535-.066a8.074 8.074 0 0 0 2.67-.511 5.625 5.625 0 0 0 3.218-3.218 8.074 8.074 0 0 0 .51-2.67C22.988 15.362 23 14.987 23 12s-.013-3.362-.066-4.535a8.074 8.074 0 0 0-.511-2.67 5.392 5.392 0 0 0-1.27-1.949 5.392 5.392 0 0 0-1.948-1.269 8.074 8.074 0 0 0-2.67-.51C15.362 1.012 14.987 1 12 1Zm0 5.351A5.649 5.649 0 1 0 17.649 12 5.649 5.649 0 0 0 12 6.351Zm0 9.316A3.667 3.667 0 1 1 15.667 12 3.667 3.667 0 0 1 12 15.667Zm5.872-10.859a1.32 1.32 0 1 0 1.32 1.32 1.32 1.32 0 0 0-1.32-1.32Z"></path></svg>
                    </Link>
                </div>
                <div id='icons' class="d-flex flex-column gap-8 pl-0">
                    <Link href="/" class="text-decoration-none text-white">
                        <div class="d-flex gap-3 align-items-center">
                            <svg aria-label="Home" fill="currentColor" height="28" role="img" viewBox="0 0 24 24" width="28"><title>Home</title><path d="M9.005 16.545a2.997 2.997 0 0 1 2.997-2.997A2.997 2.997 0 0 1 15 16.545V22h7V11.543L12 2 2 11.543V22h7.005Z" fill="none" stroke="currentColor" strokeLinejoin="round" stroke-width="2"></path></svg>
                        </div>
                    </Link>

                    <div onClick={()=> setMiniSideBar(false)} class="d-flex gap-3 align-items-center text-white hover:cursor-pointer">
                            <svg aria-label="Search" class="" fill="currentColor" height="28" role="img" viewBox="0 0 24 24" width="28"><title>Search</title><path d="M19 10.5A8.5 8.5 0 1 1 10.5 2a8.5 8.5 0 0 1 8.5 8.5Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="16.511" x2="22" y1="16.511" y2="22"></line></svg>
                    </div>

                    <Link href="" class="text-decoration-none text-white">
                        <div class="d-flex gap-3 align-items-center">
                            <svg aria-label="New post" fill="currentColor" height="28" role="img" viewBox="0 0 24 24" width="28"><title>New post</title><path d="M2 12v3.45c0 2.849.698 4.005 1.606 4.944.94.909 2.098 1.608 4.946 1.608h6.896c2.848 0 4.006-.7 4.946-1.608C21.302 19.455 22 18.3 22 15.45V8.552c0-2.849-.698-4.006-1.606-4.945C19.454 2.7 18.296 2 15.448 2H8.552c-2.848 0-4.006.699-4.946 1.607C2.698 4.547 2 5.703 2 8.552Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="6.545" x2="17.455" y1="12.001" y2="12.001"></line><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12.003" x2="12.003" y1="6.545" y2="17.455"></line></svg>
                        </div>
                    </Link>
                    <Link href="/inbox" class="text-decoration-none text-white">
                        <div class="d-flex gap-3 align-items-center">
                            <svg aria-label="Messenger" fill="currentColor" height="28" role="img" viewBox="0 0 24 24" width="28"><title>Messenger</title><path d="M12.003 2.001a9.705 9.705 0 1 1 0 19.4 10.876 10.876 0 0 1-2.895-.384.798.798 0 0 0-.533.04l-1.984.876a.801.801 0 0 1-1.123-.708l-.054-1.78a.806.806 0 0 0-.27-.569 9.49 9.49 0 0 1-3.14-7.175 9.65 9.65 0 0 1 10-9.7Z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="1.739"></path><path d="M17.79 10.132a.659.659 0 0 0-.962-.873l-2.556 2.05a.63.63 0 0 1-.758.002L11.06 9.47a1.576 1.576 0 0 0-2.277.42l-2.567 3.98a.659.659 0 0 0 .961.875l2.556-2.049a.63.63 0 0 1 .759-.002l2.452 1.84a1.576 1.576 0 0 0 2.278-.42Z" fill-rule="evenodd"></path></svg>
                            { notifications.length > 0  ? (<p id="notification" className='bg-red-800 rounded-2xl p-1'> {notifications.length} </p>) : null }
                        </div>
                    </Link>
                    <Link href="" class="text-decoration-none text-white">
                        <div class="d-flex gap-3 align-items-center">
                            <svg aria-label="Notifications" class="" fill="currentColor" height="28" role="img" viewBox="0 0 24 24" width="28"><title>Notifications</title><path d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z"></path></svg>
                        </div>
                    </Link>

                    {/* -- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> -- */}

                    <Link href={`/profile/${ user.id }`} class="text-decoration-none text-white">
                        <div class="d-flex gap-3 align-items-center">
                            <img className="w-[28px] rounded-[40%] rounded-circle" src={`/storage/${user.profile?.image}`} alt="user-profile-image" />
                        </div>
                    </Link>
                    <Link class="text-decoration-none text-white">
                        <div class="d-flex gap-3 align-items-center">
                            <svg aria-label="Settings" class="" fill="currentColor" height="28" role="img" viewBox="0 0 24 24" width="28"><title>Settings</title><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="3" x2="21" y1="4" y2="4"></line><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="3" x2="21" y1="12" y2="12"></line><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="3" x2="21" y1="20" y2="20"></line></svg>
                        </div>
                    </Link>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {/* <!-- Left Side Of Navbar --> */}
                    <ul class="navbar-nav me-auto">

                    </ul>

                    {/* <!-- Right Side Of Navbar --> */}
                    <ul class="navbar-nav ms-auto">
                        {/* <!-- Authentication Links --> */}
                        {/* @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li style="width:100%;" class="nav-item dropdown">
                                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a> --}}
                                <div id="navbarDropdown" class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <svg width="35" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Menu</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Menu"> <rect id="Rectangle" fill-rule="nonzero" x="0" y="0" width="24" height="24"> </rect> <line x1="5" y1="7" x2="19" y2="7" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> <line x1="5" y1="17" x2="19" y2="17" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> <line x1="5" y1="12" x2="19" y2="12" id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </line> </g> </g> </g></svg>
                                </div>
                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest */}
                    </ul>
                </div>
            </div>
        </nav>
        {searchClicked && <SearchBar />}
    </div>
  )
}

export default MiniSideBar