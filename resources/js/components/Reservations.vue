<template>
    <!-- zaglavlje -->
    <div class="row mt-3 mb-5 d-flex justify-content-end">
        <div class="col-6">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/kalendar">Kalendar</a></li>
                <li class="breadcrumb-item">Rezervacije</li>
            </ol>
        </div>
        <div v-if="role === 'SUPERADMIN'" class="col-6 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newReservationModal"
                @click="newReservationModal"><i class="fa-solid fa-registered"></i>&nbsp;&nbsp;
                Dodajte novu rezervaciju</button>
        </div>
        <div v-else class="col-6 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newReservationModal"
                @click="newReservationModal"><i class="fa-solid fa-registered"></i>&nbsp;&nbsp;
                Dodajte zahtev za rezervaciju</button>
        </div>
    </div>
    <!-- zaglavlje kraj -->

    <!-- Tabela korisnika -->
    <div class="card mb-4 bg-dark" style="color: #4eb3ac;">
        <div class="card-header d-flex justify-content-center">
            <span><i class="fa-solid fa-table fa-lg"></i> Rezervacije</span>
        </div>
        <div class="card-body">
            <table class="display responsive table table-bordered table-hower table-striped pt-2" width="100%"
                id="reservationsTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <th scope="col">Datum dolaska</th>
                        <th scope="col">Datum odlaska</th>
                        <th scope="col">Cena boravka</th>
                        <th scope="col">Korisnik</th>
                        <th scope="col">Akcije</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <th scope="col">Datum dolaska</th>
                        <th scope="col">Datum odlaska</th>
                        <th scope="col">Cena boravka</th>
                        <th scope="col">Korisnik</th>
                        <th scope="col">Akcije</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- Tabela kraj -->

    <!-- modal za kreiranje nove rezervacije -->
    <div class="modal" tabindex="-1" id="newReservationModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dodajte novu rezervaciju</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="apartDD" class="form-label">Naziv apartmana</label>
                            <select class="form-select" v-model="selectedApartment" id="apartDD"
                                aria-label="Odabir apartmana" :class="{ 'is-invalid': errors.selectedApartment }">
                                <option value="0" disabled selected>Odaberite apartman</option>
                                <option v-for="apartment in apartments" :key="apartment.id" :value="apartment.id"
                                    apart-id="apartment.id">
                                    {{ apartment.apartmentName }}
                                </option>
                            </select>
                            <span v-if="errors.selectedApartment" class="invalid-feedback">{{ apartSelectedErrorMessage
                                }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guestFirstName" class="form-label">Ime gosta</label>
                            <input type="text" class="form-control" v-model="guestFirstName" id="guestFirstName" placeholder="Unesite ime gosta"
                                :class="{ 'is-invalid': errors.guestFirstName }">
                            <span v-if="errors.guestFirstName" class="invalid-feedback">{{ guestFirstNameErrorMessage
                                }}</span>
                        </div>
                        <div class="col-md-6">
                            <label for="guestLastName" class="form-label">Prezime gosta</label>
                            <input type="text" class="form-control" v-model="guestLastName" id="guestLastName" placeholder="Unesite prezime gosta" :class="{ 'is-invalid': errors.guestLastName }">
                            <span v-if="errors.guestLastName" class="invalid-feedback">{{ guestLastNameErrorMessage
                                }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dateStart" class="form-label">Datum dolaska</label><br>
                            <datepicker format="dd.MM.yyyy." v-model="dateStart" id="dateStart"
                                style="min-width: 300px" :class="{ 'is-invalid': errors.dateStart }"></datepicker>
                            <span v-if="errors.dateStart" class="invalid-feedback">{{ dateStartErrorMessage
                            }}</span>
                        </div>
                        <div class="col-md-6">
                            <label for="dateEnd" class="form-label">Datum odlaska</label><br>
                            <datepicker format="dd.MM.yyyy." v-model="dateEnd" id="dateEnd" :class="{ 'is-invalid': errors.dateEnd }">
                            </datepicker>
                            <span v-if="errors.dateEnd" class="invalid-feedback">{{ dateEndErrorMessage
                            }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullPrice" class="form-label">Cena boravka</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-euro-sign fa-sm"></i></span>
                                <input type="text" class="form-control" id="fullPrice" v-model="fullPrice" placeholder="Unseite cenu boravka" :class="{ 'is-invalid': errors.fullPrice }">
                                <span class="input-group-text">.00</span>
                                <span v-if="errors.fullPrice" class="invalid-feedback">{{ fullPriceErrorMessage
                                }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="taxPrice" class="form-label">Cena takse</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-euro-sign fa-sm"></i></span>
                                <input type="text" class="form-control" id="taxPrice" v-model="taxPrice" placeholder="Unesite cenu takse" :class="{ 'is-invalid': errors.taxPrice }">
                                <span class="input-group-text">.00</span>
                                <span v-if="errors.taxPrice" class="invalid-feedback">{{ taxPriceErrorMessage
                                }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guestNumber" class="form-label">Broj gostiju</label>
                            <input type="text" class="form-control" v-model="guestNumber" id="guestNumber" placeholder="Unesite broj gostiju" :class="{ 'is-invalid': errors.guestNumber }">
                            <span v-if="errors.guestNumber" class="invalid-feedback">{{ guestNumberErrorMessage
                            }}</span>
                        </div>
                        <div class="col-md-6">
                            <label for="arrivalTime" class="form-label">Vreme dolaska (opciono)</label><br>
                            <vue-timepicker id="arrivalTime" v-model="arrivalTime"></vue-timepicker>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reservationType" class="form-label">Izvor rezervacije</label>
                            <select class="form-select" aria-label="Default select example" v-model="reservationType"
                                id="reservationType" :class="{ 'is-invalid': errors.reservationType }">
                                <option value="0" disabled selected>Odaberite izvor rezervacije</option>
                                <option value="airbnb">Airbnb</option>
                                <option value="booking">Booking</option>
                                <option value="private">Privatno</option>
                            </select>
                            <span v-if="errors.reservationType" class="invalid-feedback">{{ reservationTypeErrorMessage
                            }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="guestPaid" class="form-label">Gost platio</label>
                            <div class="form-check form-switch" style="margin-left: 5px;">
                                <input class="form-check-input switch-lg" type="checkbox" role="switch" id="guestPaid"
                                    v-model="guestPaid">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guestDescription" class="form-label">Opis gosta (opciono)</label>
                            <div class="form-floating">
                                <textarea class="form-control" id="guestDescription" style="height: 120px"
                                    v-model="guestDescription"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="addNewreservation"
                        @click="addNewreservation">Sačuvaj</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal za kreiranje nove rezervacije krej -->

    <!-- modal za brisanje -->
    <div class="modal" tabindex="-1" id="deleteReservationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Obriši rezervaciju</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>
                        <strong>Da li ste sigurni da želite da obrišete rezervaciju?</strong>
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="deleteReservation"
                        @click="deleteReservation">Obriši</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal za brisanje kraj -->

    <!-- modal za odobravanje rezervacije -->
    <div class="modal" tabindex="-1" id="allowReservationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Odobrite rezervaciju</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>
                        <strong>Da li ste sigurni da želite da odobrite rezervaciju?</strong>
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="allowReservation"
                        @click="allowReservation">Odobri</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal za odobravanje rezervacije -->

    <!-- modal za izmenu -->
    <div class="modal" tabindex="-1" id="editReservationModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Izmeni rezervaciju</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editName" class="form-label">Ime</label>
                            <input type="text" class="form-control" v-model="editName" id="editName">
                        </div>
                        <div class="col-md-6">
                            <label for="editSurname" class="form-label">Prezime</label>
                            <input type="text" class="form-control" v-model="editSurname" id="editSurname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" v-model="editEmail" id="editEmail">
                        </div>
                        <div class="col-md-6">
                            <label for="editRole" class="form-label">Nivo pristupa</label>
                            <select class="form-select" aria-label="Default select example" id="editRole"
                                v-model="editRole">
                                <option value="USER">Korisnik</option>
                                <option value="ADMIN">Administrator</option>
                                <option value="SUPERADMIN">Super administrator</option>
                            </select>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="editReservation"
                        @click="editReservation">Izmeni</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal za izmenu krej -->


</template>

<script>
import axios from 'axios';
import Datepicker from 'vuejs3-datepicker';
import VueTimepicker from 'vue3-timepicker';
import 'vue3-timepicker/dist/VueTimepicker.css'

export default {
    components: {
        Datepicker,
        VueTimepicker
    },
    props: ['userRole'],
    data() {
        return {
            selectedApartment: 0,
            apartments: [],
            guestFirstName: null,
            guestLastName: null,
            dateStart: null,
            dateEnd: null,
            fullPrice: null,
            taxPrice: null,
            guestNumber: null,
            arrivalTime: null,
            reservationType: 0,
            guestPaid: 0,
            guestDescription: null,

            role: this.userRole,

            userRowID: null,

            errors: {},
            apartSelectedErrorMessage: "",
            guestFirstNameErrorMessage: "",
            guestLastNameErrorMessage: "",
            dateStartErrorMessage: "",
            dateEndErrorMessage: "",
            fullPriceErrorMessage: "",
            taxPriceErrorMessage: "",
            guestNumberErrorMessage: "",
            reservationTypeErrorMessage: "",
            guestPaidErrorMessage: "",
        };
    },
    mounted() {
        let th = this;
        console.log(th.role)
        this.reservationsTable()

        // allow reservation action
        $(document).on('click', '#allowAction', function (e) {
            th.userRowID = $(this).data("entry-id");
        })

        // delete reservation action
        $(document).on('click', '#deleteAction', function (e) {
            th.userRowID = $(this).data("entry-id");
        })
    },

    watch: {
        selectedApartment(newVal) {
            if (newVal !== 0) {
                this.errors.selectedApartment = false;
                this.apartSelectedErrorMessage = "";
            }
        },

        guestFirstName(newVal) {
            var tekstRegEx = /^[a-zA-Z]+$/;
            if(newVal !== "" || newVal !== null) {
                this.errors.guestFirstName = false;
                this.guestFirstNameErrorMessage = "";
            }
        }, 

        guestLastName(newVal) {
            if(newVal !== "" || newVal !== null) {
                this.errors.guestLastName = false;
                this.guestLastNameErrorMessage = "";
            }
        },

        dateStart(newVal) {
            if(newVal !== "" || newVal !== null) {
                this.errors.dateStart = false;
                this.dateStartErrorMessage = "";
            }
        },

        dateEnd(newVal) {
            if(newVal !== "" || newVal !== null) {
                this.errors.dateEnd = false;
                this.dateEndErrorMessage = "";
            }
        },

        fullPrice(newVal) {
            if(newVal !== "" || newVal !== null || newVal !== 0) {
                this.errors.fullPrice = false;
                this.fullPriceErrorMessage = "";
            }
        },

        taxPrice(newVal) {
            if(newVal !== "" || newVal !== null || newVal !== 0) {
                this.errors.taxPrice = false;
                this.taxPriceErrorMessage = "";
            }
        }, 

        guestNumber(newVal) {
            if(newVal !== "" || newVal !== null || newVal !== 0) {
                this.errors.guestNumber = false;
                this.guestNumberErrorMessage = "";
            }
        },

        reservationType(newVal) {
            if(newVal !== "" || newVal !== null || newVal !== 0) {
                this.errors.reservationType = false;
                this.reservationTypeErrorMessage = "";
            }
        },
    },

    methods: {
        newReservationModal() {
            this.getApartName();
        },
        async getApartName() {
            let th = this;
            try {

                const response = await axios.post('/kalendar/apartName');
                th.apartments = response.data;

            } catch (error) {
                console.error('Došlo je do greške prilikom dohvatanja naziva apartmana: ', error);
            }
        },
        reservationsTable() {
            var th = this;
            var role = this.userRole;
            $("#reservationsTable").DataTable().clear().draw();
            $("#reservationsTable").DataTable().clear().destroy();
            var reservationsTable = $("#reservationsTable").DataTable({
                oLanguage: {
                    oPaginate: {
                        sNext: "Sledeća",
                        sPrevious: "Prethodna",
                    },
                    sEmptyTable: "Nema podataka.",
                    sLengthMenu: "Prikaz _MENU_ rezervacija",
                    sZeroRecords: "Nema pronađenih unosa!",
                    sInfo: "Prikazano _START_ do _END_ od _TOTAL_ unosa",
                    sInfoEmpty: "Nema unosa",
                    sInfoFiltered: "(filtrirano od _MAX_ unosa)",
                    sSearch: "Pretraga:",
                    sProcessing: "Molimo sačekajte ...",
                },
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: "/rezervacije/reservationsTable",
                    type: "POST",
                    // error: function (xhr, textStatus, errorThrown) {
                    //     if (xhr.status === 401 || xhr.status === 419) {
                    //         window.location.replace("/login");
                    //     }
                    // },
                    data: {

                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                columnDefs: [
                    { targets: 0, orderable: true },
                    { targets: 1, orderable: true },
                    { targets: 2, orderable: true },
                    { targets: 3, orderable: true },
                    { targets: 4, orderable: true },
                    { targets: 5, orderable: true, width: "10%" },
                    { targets: 6, orderable: true },
                    { targets: 7, orderable: false, width: "5%" },

                ],
                columns: [
                    { data: "id" },
                    { data: "guestFirstName" },
                    { data: "guestLastName" },
                    {
                        data: "date_start",
                        render: function (data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                var startDate = new Date(data);
                                var formattedStartDate = ('0' + startDate.getDate()).slice(-2) + '.' + ('0' + (startDate.getMonth() + 1)).slice(-2) + '.' + startDate.getFullYear();
                                return formattedStartDate;
                            }
                            return data;
                        }
                    },
                    {
                        data: "date_end",
                        render: function (data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                var endDate = new Date(data);
                                var formattedEndDate = ('0' + endDate.getDate()).slice(-2) + '.' + ('0' + (endDate.getMonth() + 1)).slice(-2) + '.' + endDate.getFullYear();
                                return formattedEndDate;
                            }
                            return data;
                        }
                    },
                    {
                        data: "fullPrice",
                        render: function (data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return data + ' <i class="fa-solid fa-euro-sign fa-sm"></i>';
                            }
                            return data;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.name + ' ' + row.surname;
                        }
                    },
                    {
                        data: "akcije",
                        render: function (data, type, row) {
                            var actionsHtml = '<div class="dropdown justify-content-center">' +
                                '<a type="button" class="" data-bs-toggle="dropdown"><i class="fa-solid fa-list fa-sm" style="color: #4eb3ac;"></i></a>' +
                                '<div class="dropdown-menu bg-dark text-center">';

                            actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#reservationInfoModal" id="infoAction" class="dropdown-item" data-entry-id="' +
                                row.id +
                                '" style="color: #4eb3ac;"><i class="fa-solid fa-eye fa-sm" style="margin-right: 5px"></i>Pregled</a>';

                            if (role === "SUPERADMIN" || role === "ADMIN") {
                                actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#editReservationModal" id="editAction" class="dropdown-item" data-entry-id="' +
                                    row.id +
                                    '" style="color: #4eb3ac;"><i class="fa-regular fa-pen-to-square fa-sm" style="margin-right: 5px"></i>Izmeni</a>';
                            }
                            else {
                                actionsHtml += "</div>" + "</div>";
                            }

                            if (role === "SUPERADMIN") {
                                actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#deleteReservationModal" id="deleteAction" class=" deleteAction dropdown-item" data-entry-id="' +
                                    row.id +
                                    '" style="color: #4eb3ac;"><i class="fa-solid fa-trash-can fa-sm" style="margin-right: 5px"></i> Obriši</a>';
                            }
                            else {
                                actionsHtml += "</div>" + "</div>";
                            }

                            // Additional action based on checkRole
                            if (row.checkRole === 0 && role === "SUPERADMIN") {
                                actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#allowReservationModal" id="allowAction" class="dropdown-item" data-entry-id="' +
                                    row.id +
                                    '" style="color: #4eb3ac;"><i class="fa-solid fa-check fa-sm" style="margin-right: 5px"></i>Odobri</a>';
                            }

                            actionsHtml += "</div>" + "</div>";

                            return actionsHtml;
                        },
                    },
                ],
                rowCallback: function (row, data) {
                    if (data.checkRole === 0) {
                        $(row).addClass("light-pink-bg");
                    }
                },
            });
        },

        addNewreservation() {
            let th = this;
            let newReservationModal = $('#newReservationModal');
            this.errors = {};
            var tekstRegEx = /^[a-zA-Z]+$/;
            var moneyRegEx = /^[1-9]+(?:[.][0-9]{1,2})?$/;
            var jednocifrenBrRegEx = /^[1-6]{1}$/

            if (this.selectedApartment === 0) {
                this.errors.selectedApartment = true;
                this.apartSelectedErrorMessage = "Morate odabrati apartman za koji pravite rezervaciju.";
            }

            if(this.guestFirstName === "" || this.guestFirstName === null) {
                this.errors.guestFirstName = true;
                this.guestFirstNameErrorMessage = "Morate uneti ime gosta.";
            }
            else if(!tekstRegEx.test(this.guestFirstName)) {
                this.errors.guestFirstName = true;
                this.guestFirstNameErrorMessage = "Ime se može sastojati samo od malih i velikih slova.";
            }

            if(this.guestLastName === "" || this.guestLastName === null) {
                this.errors.guestLastName = true;
                this.guestLastNameErrorMessage = "Morate uneti prezime gosta.";
            }
            else if(!tekstRegEx.test(this.guestLastName)) {
                this.errors.guestLastName = true;
                this.guestLastNameErrorMessage = "Prezime se može sastojati samo od malih i velikih slova.";
            }

            if(this.dateStart === null || this.dateStart === "") {
                this.errors.dateStart = true;
                this.dateStartErrorMessage = "Morete odabreti datum dolaska gosta.";
            }

            if(this.dateEnd === null || this.dateEnd === "") {
                this.errors.dateEnd = true;
                this.dateEndErrorMessage = "Morete odabreti datum odlaska gosta.";
            }

            if(this.fullPrice === null || this.fullPrice === "" || this.fullPrice === 0) {
                this.errors.fullPrice = true;
                this.fullPriceErrorMessage = "Morete uneti cenu boravka (ne može biti nula)";
            }
            else if(!moneyRegEx.test(this.fullPrice)) {
                this.errors.fullPrice = true;
                this.fullPriceErrorMessage = "Cena mora biti izražena u brojevima, i posle ( . ) može imati najviše dve cifre (ne može biti nula).";
            }

            if(this.taxPrice === "" || this.taxPrice === null || this.taxPrice === 0) {
                this.errors.taxPrice = true;
                this.taxPriceErrorMessage = "Morete uneti cenu takse (ne može biti nula)";
            }
            else if(!moneyRegEx.test(this.taxPrice)) {
                this.errors.taxPrice = true;
                this.taxPriceErrorMessage = "Boravišna taksa mora biti izražena u brojevima, i posle ( . ) može imati najviše dve cifre (ne može biti nula).";
            }

            if(this.guestNumber === null || this.guestNumber === "" || this.guestNumber === 0) {
                this.errors.guestNumber = true;
                this.guestNumberErrorMessage = "Morate uneti broj gostiju (ne može biti nula)";
            }
            else if(!jednocifrenBrRegEx.test(this.guestNumber)) {
                this.errors.guestNumber = true;
                this.guestNumberErrorMessage = "Broj gostiju moze biti od 1 od 6";
            }

            if(this.reservationType === null || this.reservationType === "" || this.reservationType === 0) {
                this.errors.reservationType = true;
                this.reservationTypeErrorMessage = "Morate odabrati izvor rezervacije."
            }

            if (Object.keys(this.errors).length > 0) {
                newReservationModal.modal('show');
                return;
            }


            const reservationData = {
                apartID: th.selectedApartment,
                guestFirstName: th.guestFirstName,
                guestLastName: th.guestLastName,
                dateStart: th.dateStart,
                dateEnd: th.dateEnd,
                fullPrice: th.fullPrice,
                taxPrice: th.taxPrice,
                guestNumber: th.guestNumber,
                arrivalTime: th.arrivalTime,
                reservationType: th.reservationType,
                guestPaid: th.guestPaid,
                guestDescription: th.guestDescription
            }

            axios
                .post("/rezervacije/newReservation", reservationData, {
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                }).then((response) => {
                    $("#notificationDropdown").load(location.href + " #notificationDropdown>*", "");
                    $("#addNewreservation").prop("disabled", true);

                    Swal.fire({
                        icon: "success",
                        text: "Uspešno sačuvana rezervacija.",
                        timer: 5000,
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"

                    });

                    th.reservationsTable();
                    newReservationModal.modal('hide');
                    $("#addNewreservation").prop("disabled", false);
                    th.reservationInputClean();

                }).catch((error) => {

                    $("#addNewreservation").prop("disabled", false);

                    Swal.fire({
                        icon: "warning",
                        text: "Greška prilikom čuvanja rezervacije!",
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"
                    });

                    console.error(error);
                });
        },

        allowReservation() {
            let th = this;
            let allowReservationModal = $('#allowReservationModal');
            axios
                .post("/rezervacije/allowReservation", { id: th.userRowID })
                .then((response) => {
                    $("#allowAction").prop("disabled", true);
                    th.reservationsTable();
                    $("#allowReservation").prop("disabled", false);
                    allowReservationModal.modal("hide");
                    Swal.fire({
                        icon: "success",
                        text: "Uspešno odobreno.",
                        timer: 5000,
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"

                    });
                })
                .catch((error) => {
                    $("#allowReservation").prop("disabled", false);
                    Swal.fire({
                        icon: "warning",
                        text: "Greška prilikom odobravanja rezervacije!",
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"
                    });
                    console.log(error);
                });
        },


        deleteReservation() {
            let th = this;
            let deleteReservationModal = $('#deleteReservationModal');
            axios
                .post("/rezervacije/deleteReservation", { id: th.userRowID })
                .then((response) => {
                    $("#deleteReservationAction").prop("disabled", true);
                    th.reservationsTable();
                    $("#deleteReservation").prop("disabled", false);
                    deleteReservationModal.modal("hide");
                    Swal.fire({
                        icon: "success",
                        text: "Uspešno obrisano.",
                        timer: 5000,
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"

                    });
                })
                .catch((error) => {
                    $("#deledeleteReservationteUser").prop("disabled", false);
                    Swal.fire({
                        icon: "warning",
                        text: "Greška prilikom brisanja rezervacije!",
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"
                    });
                    console.log(error);
                });
        },

        // editUser() {
        //     let th = this;
        //     let editModal = $('#editUserModal');

        //     const editData = {
        //         id: th.userRowID,
        //         name: th.editName,
        //         surname: th.editSurname,
        //         email: th.editEmail,
        //         role: th.editRole,
        //     };
        //     $("#editUser").prop("disabled", true);
        //     axios
        //         .post("/administracija-korisnika/editUser", editData, {
        //             headers: {
        //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //             },
        //         }).then((response) => {

        //             $("#editUser").prop("disabled", true);

        //             Swal.fire({
        //                 icon: "success",
        //                 text: "Uspešno izmenjeno.",
        //                 timer: 5000,
        //                 confirmButton: "confirmationBtn",
        //                 confirmButtonColor: "#4eb3ac"

        //             });

        //             th.usersTable();
        //             editModal.modal('hide');
        //             $("#editUser").prop("disabled", false);
        //         }).catch((error) => {

        //             $("#editUser").prop("disabled", false);

        //             Swal.fire({
        //                 icon: "warning",
        //                 text: "Greška prilikom izmene korisnika!",
        //                 confirmButton: "confirmationBtn",
        //                 confirmButtonColor: "#4eb3ac"
        //             });

        //             console.error(error);
        //         });
        // },

        // errosrClean() {
        //     this.errors = {};
        //     this.selectedApartment = 0;
        //     this.apartSelectedErrorMessage = "";
        // },

        reservationInputClean(){
            this.selectedApartment = 0;
            this.guestFirstName = "";
            this.guestLastName = "";
            this.dateStart = null;
            this.dateEnd = null;
            this.guestPaid = 0;
            this.arrivalTime = null;
            this.guestDescription = "";
            this.fullPrice = "";
            this.taxPrice = "";
            this.guestNumber = "";
            this.reservationType = 0;
        }
    }
}
</script>
<style>
.swal2-confirm.confirmationBtn {
    background-color: #4eb3ac !important;
    border-color: #4eb3ac !important;
}

.swal2-confirm.confirmationBtn:hover {
    background-color: #46a3a0 !important;
    border-color: #46a3a0 !important;
}

/* stilizacija datepickera */
:root {
    --vdp-selected-color: #fff;
    --vdp-selected-bg-color: #4eb3ac;
    --vdp-elem-border-radius: 3px;
}

.vuejs3-datepicker__value {
    border: 1px solid;
    border-radius: 5px;
    cursor: pointer;
    display: inline-flex;
    min-width: 370px;
    margin-bottom: 10px;
    padding: 7px 7px;
}

.vue__time-picker-input {
    border: 1px solid;
    border-radius: 5px;
    cursor: pointer;
    display: inline-flex;
    min-width: 370px;
    margin-bottom: 10px;
    padding: 10px 10px;
}

/* stilizacija datepickera kraj */

.light-pink-bg td {
    background-color: #fce4ec;
    color: rgb(255, 60, 60) !important;
}
.switch-lg {
    transform: scale(1.5);
    /* background-color: red; */
}

</style>