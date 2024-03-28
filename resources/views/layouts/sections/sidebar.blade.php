<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 170vh">
    {{-- Naslov aplikacije --}}
    <a href="/kalendar" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <i class="fa-brands fa-squarespace fa-2xl" style="color: #4eb3ac; margin-left: -35px"></i>
        <span class="fs-4">&nbsp;&nbsp;E-Apartmani</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        {{-- Kalendar --}}
        <li class="nav-item mb-2">
            <a href="/kalendar" class="nav-link" aria-current="page">
                <span style="color: 
                    <?php echo $_SERVER['REQUEST_URI'] == '/kalendar' ? '#4eb3ac' : 'white'; ?>;"><i class="fa-regular fa-calendar fa-lg"
                        style=" margin-right: 15px"></i>Kalendar
                </span>
            </a>
        </li>
        {{-- Rezervacije --}}
        <li class="nav-item mb-2">
            <a href="/rezervacije" class="nav-link" aria-current="page">
                <span style="color: 
                    <?php echo $_SERVER['REQUEST_URI'] == '/rezervacije' ? '#4eb3ac' : 'white'; ?>;"><i class="fa-solid fa-registered fa-lg" style=" margin-right: 13px"></i>Rezervacije
                </span>
            </a>
        </li>

        {{-- Apartmani --}}
        <li class="nav-item mb-2">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapseApartments" role="button"
                aria-expanded="false" aria-controls="collapseApartments">
                <span style="color: 
                <?php echo $_SERVER['REQUEST_URI'] == '/apartmani' ? '#4eb3ac' : 'white'; ?>;"><i class="fa-solid fa-house "
                        style=" margin-right: 10px;"></i> Apartmani</span>
            </a>
            <div class="collapse" id="collapseApartments">
                <div class="card card-body bg-dark">
                    <a href="#" class="nav-link" aria-current="page">
                        <span style="color: 
                            <?php echo $_SERVER['REQUEST_URI'] == '/lista-apartmana' ? '#4eb3ac' : 'white'; ?>;">Lista Apartmana
                        </span>
                    </a>
                    <a href="#" class="nav-link" aria-current="page">
                        <span style="color: 
                            <?php echo $_SERVER['REQUEST_URI'] == '/cenovnik' ? '#4eb3ac' : 'white'; ?>;">Cenovnik
                        </span>
                    </a>
                </div>
            </div>
        </li>

        {{-- Finansije --}}
        <li class="nav-item mb-2">
            <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#collapseFinansije" href="#collapseFinansije"
                role="button" aria-expanded="false" aria-controls="collapseFinansije">
                <span style="color: 
                <?php echo $_SERVER['REQUEST_URI'] == '/lista-prihoda' || $_SERVER['REQUEST_URI'] == '/lista-rashoda' ? '#4eb3ac' : 'white'; ?>;"><i class="fa-regular fa-credit-card fa-sm"
                        style="margin-right: 12px;"></i> Finansije</span>
            </a>
            <div class="collapse" id="collapseFinansije">
                <div class="card card-body bg-dark">
                    <a href="" class="nav-link" aria-current="page">
                        <span style="color: 
                            <?php echo $_SERVER['REQUEST_URI'] == '/lista-prihoda' ? '#4eb3ac' : 'white'; ?>;">Lista Prihoda
                        </span>
                    </a>
                    <a href="" class="nav-link" aria-current="page">
                        <span style="color: 
                            <?php echo $_SERVER['REQUEST_URI'] == '/lista-rashoda' ? '#4eb3ac' : 'white'; ?>;">Lista Rashoda
                        </span>
                    </a>
                </div>
            </div>
        </li>

        {{-- Parking --}}
        <li class="nav-item mb-2">
            <a href="/parking" class="nav-link" aria-current="page">
                <span style="color: 
                    <?php echo $_SERVER['REQUEST_URI'] == '/parking' ? '#4eb3ac' : 'white'; ?>;"><i
                        class="fa-solid fa-square-parking fa-lg" style="margin-right: 13px;"></i>Kalendar
                </span>
            </a>
        </li>

        {{-- @dd(session('user')->role) --}}
        @if (session('user')->role == 'SUPERADMIN')
            <hr>
            <li class="nav-item mb-2">
                <a href="/administracija-korisnika" class="nav-link" aria-current="page">
                    <span style="color: 
                    <?php echo $_SERVER['REQUEST_URI'] == '/administracija-korisnika' ? '#4eb3ac' : 'white'; ?>;"><i
                            class="fa-solid fa-address-card fa-lg" style="margin-right: 13px;"></i>Administracija korisnika
                    </span>
                </a>
            </li>
        @endif
    </ul>
    <hr>
</div>
