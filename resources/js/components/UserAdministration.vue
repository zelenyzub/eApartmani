<template>
    <!-- zaglavlje -->
    <div class="row mt-3 mb-5 d-flex justify-content-end">
        <div class="col-6">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/kalendar">Kalendar</a></li>
                <li class="breadcrumb-item">Administracija korisnika</li>
            </ol>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a href="/register" type="button" class="btn btn-primary"><i
                    class="fa-solid fa-address-card"></i>&nbsp;&nbsp;
                Registrujte novog korisnika</a>
        </div>
    </div>
    <!-- zaglavlje kraj -->

    <!-- Tabela korisnika -->
    <div class="card card-flush shadow-sm">
        <div class="card-body py-5">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7" width="100%"
                    id="usersTable">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Nivo pristupa</th>
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
                        <th scope="col">E-mail</th>
                        <th scope="col">Nivo pristupa</th>
                        <th scope="col">Akcije</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- Tabela kraj -->

    <!-- modal za brisanje -->
    <div class="modal" tabindex="-1" id="deleteUserModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Obriši korisnika</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>
                        <strong>Da li ste sigurni da želite da obrišete korisnika?</strong>
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="deleteUser"
                        @click="deleteUser">Obriši</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal za brisanje kraj -->

    <!-- modal za izmenu -->
    <div class="modal" tabindex="-1" id="editUserModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Izmeni korisnika</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="editUser"
                        @click="editUser">Izmeni</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal za izmenu krej -->


</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            userRowID: null,
            editName: "",
            editSurname: "",
            editEmail: "",
            editRole: "",
            userPermissionsID: null,
        };
    },
    mounted() {
        let th = this;

        this.usersTable();

        // delete user modal
        $(document).on('click', '#deleteAction', function (e) {
            th.userRowID = $(this).data("entry-id");
        })

        // edit user modal
        $(document).on('click', '#editAction', function (e) {
            th.userRowID = $(this).data("entry-id");
            axios
                .post("/administracija-korisnika/getUserDataForEdit", { id: th.userRowID })
                .then((response) => {
                    th.editName = response.data.data[0].name;
                    th.editSurname = response.data.data[0].surname;
                    th.editEmail = response.data.data[0].email;
                    th.editRole = response.data.data[0].role
                }).catch((error) => {
                    Swal.fire({
                        icon: "warning",
                        text: "Greška prilikom uzimanja podataka korisnika!",
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"
                    });
                    console.log(error);
                });
        })

        //PERMISSION CONTROLL START
        $(document).on('click', '#permissions', function (e) {
            let userPermissionsID = $(this).data("entry-id");

            // Axios request to send userPermissionsID to the specified route
            axios.get(`/administracija-korisnika/permisije/${userPermissionsID}`)
                .then(response => {
                    window.location.href = `/administracija-korisnika/permisije/${userPermissionsID}`;
                })
                .catch(error => {
                    console.error("Greska prilikom otvaranja permisija", error);
                });
        });
        //PERMISSION CONTROLL END
    },

    methods: {
        usersTable() {
            var th = this;
            $("#usersTable").DataTable().clear().draw();
            $("#usersTable").DataTable().clear().destroy();
            var usersTable = $("#usersTable").DataTable({
                oLanguage: {
                    oPaginate: {
                        sNext: "Sledeća",
                        sPrevious: "Prethodna",
                    },
                    sEmptyTable: "Nema podataka.",
                    sLengthMenu: "Prikaz _MENU_ korisnika",
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
                    url: "/administracija-korisnika/getUserData",
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
                    { targets: 5, orderable: false, width: "5%" },

                ],
                columns: [
                    { data: "id" },
                    { data: "name" },
                    { data: "surname" },
                    { data: "email" },
                    {
                        data: "role",
                        render: function (data, type, row) {
                            // Convert role data to human-readable format
                            switch (data) {
                                case "SUPERADMIN":
                                    return "Administrator";
                                case "USER":
                                    return "Korisnik";
                                default:
                                    return data; // Return the original data if it doesn't match any case
                            }
                        }
                    },
                    {
                        data: "akcije",
                        render: function (data, type, row) {
                            return (
                                '<div class="dropdown justify-content-center">' +
                                '<a type="button" class="" data-bs-toggle="dropdown"><i class="fa-solid fa-list fa-sm" style="color: #4eb3ac;"></i></a>' +
                                '<div class="dropdown-menu text-center">' +
                                '<a type="button" data-bs-toggle="modal" data-bs-target="#editUserModal" id="editAction" class="dropdown-item" data-entry-id="' +
                                row.id +
                                '" ><i class="fa-regular fa-pen-to-square fa-sm" style="margin-right: 5px"></i>Izmeni</a>' +
                                '<a type="button" data-bs-toggle="modal" data-bs-target="#deleteUserModal" id="deleteAction" class=" deleteAction dropdown-item" data-entry-id="' +
                                row.id +
                                '" ><i class="fa-solid fa-trash-can fa-sm" style="margin-right: 5px"></i> Obriši</a>' +
                                '<a type="button" id="permissions" class="dropdown-item" data-entry-id="' +
                                row.id +
                                '" ><i class="fa-solid fa-user-shield fa-sm" style="margin-right: 5px"></i>Permisije</a>' +
                                "</div>" +
                                "</div>"
                            );
                        },
                    },
                ],
            });
        },

        deleteUser() {
            let th = this;
            let deleteUserModal = $('#deleteUserModal');
            axios
                .post("/administracija-korisnika/deleteUser", { id: th.userRowID })
                .then((response) => {
                    $("#deleteAction").prop("disabled", true);
                    th.usersTable();
                    $("#deleteUser").prop("disabled", false);
                    deleteUserModal.modal("hide");
                    Swal.fire({
                        icon: "success",
                        text: "Uspešno obrisano.",
                        timer: 5000,
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"

                    });
                })
                .catch((error) => {
                    $("#deleteUser").prop("disabled", false);
                    Swal.fire({
                        icon: "warning",
                        text: "Greška prilikom brisanja korisnika!",
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"
                    });
                    console.log(error);
                });
        },

        editUser() {
            let th = this;
            let editModal = $('#editUserModal');

            const editData = {
                id: th.userRowID,
                name: th.editName,
                surname: th.editSurname,
                email: th.editEmail,
                role: th.editRole,
            };
            $("#editUser").prop("disabled", true);
            axios
                .post("/administracija-korisnika/editUser", editData, {
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                }).then((response) => {

                    $("#editUser").prop("disabled", true);

                    Swal.fire({
                        icon: "success",
                        text: "Uspešno izmenjeno.",
                        timer: 5000,
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"

                    });

                    th.usersTable();
                    editModal.modal('hide');
                    $("#editUser").prop("disabled", false);
                }).catch((error) => {
                    
                    $("#editUser").prop("disabled", false);

                    Swal.fire({
                        icon: "warning",
                        text: "Greška prilikom izmene korisnika!",
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"
                    });

                    console.error(error);
                });
        },
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
</style>