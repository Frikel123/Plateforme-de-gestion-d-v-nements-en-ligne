<div class="main-sidebar sidebar-style-3 " style="">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index-2.html" class="d-flex align-items-center ml-4">
                <img src='{{ asset('images/logo.png') }}' width="40" height="40" style="background: white;">
                <span class="ml-2">gestion d'enevements </span></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">LA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Accueil</li>
            <li class="dropdown ">
                <a href="{{ route('dashboard') }}" class="nav-link "><i class="fas fa-fire"></i><span>Accueil</span></a>
            </li>
            <li class="menu-header">Eevent</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-chalkboard-teacher"></i>
                    <span>Evevent</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link" href="{{ route('Events.index') }}">Liste des
                        Evevent</a></li>
                    <li>
                        <a class="nav-link beep beep-sidebar" href="{{ route('Events.create') }}">
                        Ajouter
                            Events</a></li>
                </ul>
            </li>

            <li class="menu-header">EventCategory</li>
            <li class="dropdown ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-user-graduate"></i> <span>EventCategory</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link"
                         href="{{ route('EventCategory.index') }}"
                         >
                         Liste des Category </a>
                    </li>
                    <li>
                        <a class="nav-link beep beep-sidebar" href="{{ route('EventCategory.create') }}">
                            Ajouter
                            Category </a></li>
                </ul>
            </li>
            

            <li class="menu-header">Payments</li>
            <li class="dropdown ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-user-shield"></i><span>Payments</span></a>
                <ul class="dropdown-menu">
                    <li class=" "><a class="nav-link" 
                        href="{{ route('payment.index') }}"
                        >Liste des
                        Payments</a>
                    </li>
                     {{-- <li><a class="nav-link beep beep-sidebar" href="{{ route('payments.create') }}">Ajouter 
                             Utilisateur</a></li>  --}}
                </ul>
            </li>
        </ul><br>
        <div class="mb-4 p-3 hide-sidebar-mini">
            
            <form 
            action="{{ route('user.logout') }}"
             method="POST" class="mb-0">
                @csrf
                <button class="btn btn-primary btn-lg btn-block btn-icon-split"  style="background-color: white; border-color: #fff; color: #ff2727;" type="submit"><i
                    class="fas fa-power-off" ></i>
                    Logout</button>
            </form>
        </div>
    </aside>
</div>
{{-- <a class="btn btn-primary btn-lg btn-block btn-icon-split"   href="{{ route('user.logout') }}"
                style="background-color: white; border-color: #fff; color: #ff2727;"><i class="fas fa-power-off" ></i>
                Logout</a> --}}
