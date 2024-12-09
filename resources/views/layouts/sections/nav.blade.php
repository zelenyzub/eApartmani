<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark" style="height: 60px;">
    <div class="container-fluid">
        <div class="row d-flex ms-auto align-items-center">
            {{-- Notifikacije --}}
            <div class="col-4">
                {{-- <button class="navbar-toggler " type="button" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}
                <div class="d-flex">
                    <div class="dropdown me-1" id="notificationDropdown">
                        <a class="" href="#" data-bs-toggle="dropdown" aria-expanded="false"
                            data-bs-offset="0,70">
                            @if ($user->unreadNotifications->count() > 0)
                                <span
                                    class="position-absolute xs top-0 start-100 translate-middle badge rounded-pill text-bg-danger"
                                    style="font-size: 10px;">
                                    {{ $user->unreadNotifications->count() }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                            <i class="fa-regular fa-bell fa-lg" style="color: #4eb3ac;"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end scrollable"
                            style="width: 370px; top: calc(100% + 17px);">
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
                                                id="select-all-checkbox">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            @forelse ($user->unreadNotifications as $key => $notification)
                                {{-- @dd(session('user')->id, $notification->notifiable_id) --}}
                                @if (session('user')->id === $notification->notifiable_id)
                                    <li class="dropdown-item mb-3" onclick="event.stopPropagation()">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="dropdown-content">
                                                    <p style="font-size: 13px">{{ $notification->data['message'] }} <a
                                                            class="link-opacity-25-hover"
                                                            href={{ $notification->data['notificationPath'] }}>Rezervacije</a>
                                                    </p>

                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="{{ $key }}" data-id="{{ $notification->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @empty
                                <a class="dropdown-item mb-3">Nema notifikacija</a>
                            @endforelse
                        </ul>
                        <div class="arrow-up"></div>
                    </div>
                </div>
            </div>
            {{-- Korisnik --}}
            <div class="col-4" style="margin-right: 30px">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user fa-lg" style="color: #4eb3ac;"></i>&nbsp;&nbsp;
                    <strong>{{ substr(session('user')->name, 0, 1) . '' . substr(session('user')->surname, 0, 1) }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end scrollable" style="width: 270px;">
                    {{-- Ovde treba prikazati role korisnika --}}
                    @if (session('user')->role == 'SUPERADMIN')
                        <li class="text-center mt-1"><strong>Super administrator</strong></li>
                    @elseif (session('user')->role == 'ADMIN')
                        <li class="text-center mt-1"><strong>Administrator</strong></li>
                    @else
                        <li class="text-center mt-1"><strong>Korisnik</strong></li>
                    @endif
                    <hr>
                    @if (session('user')->role == 'SUPERADMIN')
                        <li class="d-grid gap-2 col-6 mx-auto mb-2" style="width: 90%;"><a href="/register"
                                type="button" class="dropdown-item"><i class="fa-solid fa-address-card"
                                    style="color: #4eb3ac;"></i>&nbsp;&nbsp;Registrujte novog korisnika</a></li>
                    @endif
                    <li class="d-grid gap-2 col-6 mx-auto mb-2" style="width: 90%;"><a href="#" type="button"
                            class="dropdown-item"><i class="fa-solid fa-gear"
                                style="color: #4eb3ac;"></i>&nbsp;&nbsp;Korisnička podešavanja</a></li>
                    <li class="d-grid gap-2 col-6 mx-auto mb-2" style="width: 90%;"><a href="#" type="button"
                            class="dropdown-item" id="logoutBtn"><i class="fa-solid fa-arrow-right-from-bracket"
                                style="color: #4eb3ac;"></i>&nbsp;&nbsp;Odjavi se</a></li>
                    <hr>
                </ul>
            </div>
            <div class="col-4"></div>
        </div>
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
<script>
    // JavaScript kod za selektovanje svih checkboxova kada se selektuje "Obeležite sve notifikacije kao pročitane"
    document.getElementById("select-all-checkbox").addEventListener("change", function() {
        var checkboxes = document.querySelectorAll('.dropdown-menu input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = event.target.checked;
        });
    });

    //Logout funkcija
    document.getElementById("logoutBtn").addEventListener("click", function(event) {
        event.preventDefault();

        axios.post('/logout', {}, {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            if (response.request.responseURL !== window.location.href) {
                window.location.href = response.request.responseURL;
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    });

    // oznaci sve notifikacije kao procitene
    document.getElementById("select-all-checkbox").addEventListener("change", function() {
        var checkboxes = document.querySelectorAll('.dropdown-menu input[type="checkbox"]');
        var notificationsAll = []
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = event.target.checked;
            var notificationId = checkbox.getAttribute('data-id');
            notificationsAll.push(notificationId);
        });
        axios.post('/getAllCheckedNotifications', {
                notificationsAll: notificationsAll
            })
            .then(function(response) {

            })
            .catch(function(error) {
                console.error(error);
            });
    });

    // oznaci pojedinacno kao procitano notifikacije
    document.addEventListener("DOMContentLoaded", function() {
        var checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('click', function() {
                var checkboxId = checkbox.getAttribute('id');
                var notificationId = checkbox.getAttribute('data-id');

                if (checkbox.checked) {
                    axios.post('/getCheckedNotifications', {
                            checkboxId: checkboxId,
                            notificationId: notificationId
                        })
                        .then(function(response) {})
                        .catch(function(error) {
                            console.error('Error:', error);
                        });
                }
            });
        });

    });

    
</script>
