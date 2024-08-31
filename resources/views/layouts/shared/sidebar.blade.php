<div class="app-menu">

    <!-- Sidenav Brand Logo -->
    <a href="{{ route('home') }}" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img src="/images/new.png" class="logo-lg h-6" alt="Light logo">
            <img src="/images/Untitled.jpg" class="logo-sm" alt="Small logo">
        </div>

        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img src="/images/new.png" class="logo-lg" alt="Tes">
            <img src="/images/Untitled.jpg" class="logo-sm" alt="Lah">
        </div>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!--- Menu -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="{{ route('home') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="{{route('vehicles.index')}}" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_layout_grid_line"></i></span>
                    <span class="menu-text"> Data Kendaraan </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('ar') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_clipboard_fill"></i></span>
                    <span class="menu-text"> Ar </span>
                </a>
            </li>
            
        </ul>

    </div>
</div>
<!-- Sidenav Menu End  -->
