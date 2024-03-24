<template>
    <!-- zaglavlje -->
    <div class="row mt-3 mb-5 d-flex justify-content-end">
        <div class="col-6">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/kalendar">Kalendar</a></li>
                <li class="breadcrumb-item">Rezervacije</li>
            </ol>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newReservationModal"
                @click="newReservationModal"><i class="fa-solid fa-registered"></i>&nbsp;&nbsp;
                Dodajte novu rezervaciju</button>
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
                                aria-label="Odabir apartmana">
                                <option value="0" disabled selected>Odaberite apartman</option>
                                <option v-for="apartment in apartments" :key="apartment.id" :value="apartment.id"
                                    apart-id="apartment.id">
                                    {{ apartment.apartmentName }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guestFirstName" class="form-label">Ime gosta</label>
                            <input type="text" class="form-control" v-model="guestFirstName" id="guestFirstName">
                        </div>
                        <div class="col-md-6">
                            <label for="guestLastName" class="form-label">Prezime gosta</label>
                            <input type="text" class="form-control" v-model="guestLastName" id="guestLastName">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dateStart" class="form-label">Datum dolaska</label><br>
                            <datepicker format="dd.MM.yyyy." v-model="dateStart" id="dateStart"
                                style="min-width: 300px"></datepicker>
                        </div>
                        <div class="col-md-6">
                            <label for="dateEnd" class="form-label">Datum odlaska</label><br>
                            <datepicker format="dd.MM.yyyy." v-model="dateEnd" id="dateEnd">
                            </datepicker>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullPrice" class="form-label">Cena boravka</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-euro-sign fa-sm"></i></span>
                                <input type="text" class="form-control" id="fullPrice" v-model="fullPrice">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="taxPrice" class="form-label">Cena takse</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-euro-sign fa-sm"></i></span>
                                <input type="text" class="form-control" id="taxPrice" v-model="taxPrice">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guestNumber" class="form-label">Broj gostiju</label>
                            <input type="text" class="form-control" v-model="guestNumber" id="guestNumber">
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
                                id="reservationType">
                                <option selected>Odaberite izvor rezervacije</option>
                                <option value="airbnb">Airbnb</option>
                                <option value="booking">Booking</option>
                                <option value="private">Privatno</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="guestPaid" class="form-label">Gost platio</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="guestPaid"
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
            reservationType: null,
            guestPaid: 0,
            guestDescription: null,
        };
    },
    mounted() {
        this.reservationsTable()
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
                    { targets: 5, orderable: true },
                    { targets: 6, orderable: false, width: "5%" },

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
                        data: "akcije",
                        render: function (data, type, row) {
                            var actionsHtml = '<div class="dropdown justify-content-center">' +
                                '<a type="button" class="" data-bs-toggle="dropdown"><i class="fa-solid fa-list fa-sm" style="color: #4eb3ac;"></i></a>' +
                                '<div class="dropdown-menu bg-dark text-center">';

                            actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#reservationInfoModal" id="infoAction" class="dropdown-item" data-entry-id="' +
                                row.id +
                                '" style="color: #4eb3ac;"><i class="fa-solid fa-eye fa-sm" style="margin-right: 5px"></i>Pregled</a>';

                            actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#editReservationModal" id="editAction" class="dropdown-item" data-entry-id="' +
                                row.id +
                                '" style="color: #4eb3ac;"><i class="fa-regular fa-pen-to-square fa-sm" style="margin-right: 5px"></i>Izmeni</a>';

                            actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#deleteReservationModal" id="deleteAction" class=" deleteAction dropdown-item" data-entry-id="' +
                                row.id +
                                '" style="color: #4eb3ac;"><i class="fa-solid fa-trash-can fa-sm" style="margin-right: 5px"></i> Obriši</a>';

                            // Additional action based on checkRole
                            if (row.checkRole === 0) {
                                actionsHtml += '<a type="button" class="dropdown-item" id="allowAction" style="color: #4eb3ac;"><i class="fa-solid fa-check fa-sm" style="margin-right: 5px"></i>Odobri</a>';
                            }

                            actionsHtml += "</div>" + "</div>";

                            return actionsHtml;
                        },
                    },
                ],
                rowCallback: function(row, data) {
                    if (data.checkRole === 0) {
                        $(row).addClass("light-pink-bg");
                    }
                },
            });
        },

        addNewreservation() {
            let th = this;
            let newReservationModal = $('#newReservationModal');

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



        // deleteUser() {
        //     let th = this;
        //     let deleteUserModal = $('#deleteUserModal');
        //     axios
        //         .post("/administracija-korisnika/deleteUser", { id: th.userRowID })
        //         .then((response) => {
        //             $("#deleteAction").prop("disabled", true);
        //             th.usersTable();
        //             $("#deleteUser").prop("disabled", false);
        //             deleteUserModal.modal("hide");
        //             Swal.fire({
        //                 icon: "success",
        //                 text: "Uspešno obrisano.",
        //                 timer: 5000,
        //                 confirmButton: "confirmationBtn",
        //                 confirmButtonColor: "#4eb3ac"

        //             });
        //         })
        //         .catch((error) => {
        //             $("#deleteUser").prop("disabled", false);
        //             Swal.fire({
        //                 icon: "warning",
        //                 text: "Greška prilikom brisanja korisnika!",
        //                 confirmButton: "confirmationBtn",
        //                 confirmButtonColor: "#4eb3ac"
        //             });
        //             console.log(error);
        //         });
        // },

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

.light-pink-bg {
    background-color: #fce4ec; /* Light pink color */
}

.light-pink-bg td {
    background-color: #fce4ec;
    color: black !important;
}

</style>