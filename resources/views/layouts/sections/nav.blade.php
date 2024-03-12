<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="row d-flex ms-auto align-items-center">
            {{-- Notifikacije --}}
            <div class="col-4">
                {{-- <button class="navbar-toggler " type="button" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}
                <div class="d-flex">
                    <div class="dropdown me-1">
                        <a class="" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,70">
                            <i class="fa-regular fa-bell fa-lg" style="color: #4eb3ac;"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end scrollable" style="width: 370px;">
                            <li class="text-center mt-1"><strong>Notifikacije</strong></li>
                            <hr>
                            <li class="d-grid gap-2 col-6 mx-auto mb-4" style="width: 90%;"><a href="#"
                                    type="button" class="btn btn-primary">Sve notifikacije</a></li>
                            <li class="dropdown-item" onclick="event.stopPropagation()">
                                <div class="row">
                                    <div class="col-10">
                                        <label for="flexCheckDefault">Obeležite sve notifikacije kao pročitane</label>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <li class="dropdown-item" onclick="event.stopPropagation()">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="dropdown-content">
                                            Ovde treba da stoji sadrzaj porukeasd asdasdasdasdasdasdasd assafafaffa
                                            afasfasf
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item" onclick="event.stopPropagation()">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="dropdown-content">
                                            Ovde treba da stoji sadrzaj porukeasd asdasdasdasdasdasdasd assafafaffa
                                            afasfasf
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item" onclick="event.stopPropagation()">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="dropdown-content">
                                            Ovde treba da stoji sadrzaj porukeasd asdasdasdasdasdasdasd assafafaffa
                                            afasfasf
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item" onclick="event.stopPropagation()">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="dropdown-content">
                                            Ovde treba da stoji sadrzaj porukeasd asdasdasdasdasdasdasd assafafaffa
                                            afasfasf
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item" onclick="event.stopPropagation()">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="dropdown-content">
                                            Ovde treba da stoji sadrzaj porukeasd asdasdasdasdasdasdasd assafafaffa
                                            afasfasf
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="arrow-up"></div>
                    </div>
                </div>
            </div>
            {{-- Korisnik --}}
            <div class="col-6">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                        class="rounded-circle me-2">
                    <strong>Savo</strong>
                </a>
            </div>
            <div class="col-2"></div>
        </div>
        {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="apartmentDD" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div> --}}
    </div>
</nav>
<style>
    .dropdown-content {
        max-width: 90%;
        /* Adjust this value as needed */
        word-wrap: break-word;
        white-space: normal;
    }

    .form-check {
        margin: 0;
        /* Remove default margin */
    }

    .scrollable {
        max-height: 400px;
        /* Promenite ovo prema potrebi */
        overflow-y: auto;
    }
</style>
