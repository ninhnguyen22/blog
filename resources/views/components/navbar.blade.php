<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand" target="_blank" href="https://mdbootstrap.com/docs/standard/">
           {{-- <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="16" alt=""
                 loading="lazy"
                 style="margin-top: -3px;"/>--}}
            <a class="nav-link" aria-current="page" href="/">{{ $navbar->getBrand() }}</a>
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
                aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($navbar->getNavItems() as $navItem)
                    @if(!$navItem->getIsDropdown())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $navItem->getHref() }}"
                               rel="nofollow"
                               target="_blank">{{ $navItem->getName() }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-mdb-toggle="dropdown"
                                aria-expanded="false"
                            >
                                {{ $navItem->getName() }}
                            </a>
                            <!-- Dropdown menu -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {{--<li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider"/>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </li>--}}
                                @foreach($navItem->getDropdowns() as $dropdown)
                                    <li><a class="dropdown-item" href="#">{{ $dropdown['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                @endif

            @endForeach
            <!-- Navbar dropdown -->
            </ul>

            <ul class="navbar-nav d-flex flex-row">
                <!-- Icons -->
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA"
                       rel="nofollow"
                       target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </li>
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://www.facebook.com/mdbootstrap" rel="nofollow" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://twitter.com/MDBootstrap" rel="nofollow" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://github.com/mdbootstrap/mdb-ui-kit" rel="nofollow"
                       target="_blank">
                        <i class="fab fa-github"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
