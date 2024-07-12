<template>
    <!-- zaglavlje -->
    <div class="row mt-3 mb-5 d-flex justify-content-end">
        <div class="col-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/kalendar">Kalendar</a></li>
                <li class="breadcrumb-item">Rezervacije</li>
            </ol>
        </div>
        <div v-if="permissionAddReservations === 1" class="col-8 d-flex justify-content-end">
            <div>
											<!--begin::Menu toggle-->
											<a href="#" class="btn btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" @click="resFilters">
											<i class="ki-duotone ki-filter fs-3 text-muted me-1">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>Filteri</a>
											<!--end::Menu toggle-->
											<!--begin::Menu 1-->
											<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_6606384e560f7" style="">
												<!--begin::Header-->
												<div class="px-7 py-5">
													<div class="fs-5 text-gray-900 fw-bold">Odabir filtera</div>
												</div>
												<!--end::Header-->
												<!--begin::Menu separator-->
												<div class="separator border-gray-200"></div>
												<!--end::Menu separator-->
												<!--begin::Form-->
												<div class="px-7 py-5">
													<!--begin::Input group-->
													<div class="mb-10">
														<!--begin::Label-->
														<label class="form-label fw-semibold">Apartman:</label>
														<!--end::Label-->
														<!--begin::Input-->
														<div>
															<select class="form-select" data-control="select2" data-placeholder="Select an option" v-model="filterApartments" id="apartDD"
                                                                aria-label="Odabir apartmana" :class="{ 'is-invalid': errors.selectedApartment }">
                                                                <option value="" selected>Odaberite apartman</option>
                                                                <option v-for="apartment in apartments" :key="apartment.id" :value="apartment.id"
                                                                    apart-id="apartment.id">
                                                                    {{ apartment.apartmentName }}
                                                                </option>
                                                            </select>
                                                        </div>
														<!--end::Input-->
													</div>
                                                    <div class="mb-10">
														<!--begin::Label-->
														<label class="form-label fw-semibold">Izvor rezervacije:</label>
														<!--end::Label-->
														<!--begin::Input-->
														<div>
															<select class="form-select" aria-label="Default select example" v-model="filterResType"
                                                                id="reservationType" :class="{ 'is-invalid': errors.reservationType }">
                                                                <option value="" selected>Odaberite izvor rezervacije</option>
                                                                <option value="airbnb">Airbnb</option>
                                                                <option value="booking">Booking</option>
                                                                <option value="private">Privatno</option>
                                                            </select>
                                                        </div>
														<!--end::Input-->
													</div>
                                                    <div class="mb-10">
														<!--begin::Label-->
														<label class="form-label fw-semibold">Status rezervacije:</label>
														<!--end::Label-->
														<!--begin::Input-->
														<div>
															<select class="form-select" aria-label="Default select example" v-model="filterResStatus"
                                                                id="reservationType" :class="{ 'is-invalid': errors.reservationType }">
                                                                <option value="" selected>Odaberite status</option>
                                                                <option value="0">Zahtevi za rezervaciju</option>
                                                                <option value="1">Odobrene rezervacije</option>
                                                            </select>
                                                        </div>
														<!--end::Input-->
													</div>
													<!--end::Input group-->
													<!--begin::Actions-->
													<div class="d-flex justify-content-end">
														<button type="reset" class="btn btn-sm btn-light btn-danger me-2" @click.stop="resetFilters">Poništi</button>
														<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true" @click="getFilteredData">Filtriraj</button>
													</div>
													<!--end::Actions-->
												</div>
												<!--end::Form-->
											</div>
											<!--end::Menu 1-->
										</div>&nbsp;
            <button type="button" id="btnLegenda" class="btn btn-warning" data-bs-toggle="modal"
            data-bs-target="#modalLegend"><i class="fa-solid fa-info fa-sm"></i>
            Legenda</button>&nbsp;
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newReservationModal"
                @click="newReservationModal"><i class="fa-solid fa-registered fs-3"></i>&nbsp;&nbsp;
                Dodajte novu rezervaciju</button>
        </div>
        <div v-else class="col-8 d-flex justify-content-end">
            <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
											<i class="ki-duotone ki-filter fs-6 text-muted me-1">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>Filter</a>&nbsp;
            <button type="button" id="btnLegenda" class="btn btn-warning" data-bs-toggle="modal"
            data-bs-target="#modalLegend"><i class="fa-solid fa-info fa-sm"></i>
            Legenda</button>&nbsp;
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newReservationModal"
                @click="newReservationModal"><i class="fa-solid fa-registered fs-3"></i>&nbsp;&nbsp;
                Dodajte zahtev za rezervaciju</button>
        </div>
    </div>
    <!-- zaglavlje kraj -->

    <!-- legenda rezervacije pocetak -->
    <div class="modal fade" tabindex="-1" id="modalLegend">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Legenda</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <i class="fa-solid fa-circle mt-3 mb-3" style="color: #fce4ec;"></i><label>&nbsp;Redovi obojeni u roze su rezervacije koje čekaju odobravanje</label><br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div>
    <!-- legenda rezervacije kraj -->

    <!-- Tabela korisnika -->
    <div class="card card-flush shadow-sm">
        <div class="card-body py-5">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7" width="100%"
                    id="reservationsTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Apartman</th>
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
                            <th scope="col">Apartman</th>
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
                            <select class="form-select" data-control="select2" data-placeholder="Select an option" v-model="selectedApartment" id="apartDD"
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
                            <datepicker format="dd.MM.yyyy." disableDates v-model="dateStart" id="dateStart"
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
                                <input type="number" class="form-control" id="fullPrice" v-model="fullPrice" placeholder="Unseite cenu boravka" :class="{ 'is-invalid': errors.fullPrice }">
                                <span class="input-group-text">.00</span>
                                <span v-if="errors.fullPrice" class="invalid-feedback">{{ fullPriceErrorMessage
                                }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="taxPrice" class="form-label">Cena takse</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-euro-sign fa-sm"></i></span>
                                <input type="number" class="form-control" id="taxPrice" v-model="taxPrice" placeholder="Unesite cenu takse" :class="{ 'is-invalid': errors.taxPrice }">
                                <span class="input-group-text">.00</span>
                                <span v-if="errors.taxPrice" class="invalid-feedback">{{ taxPriceErrorMessage
                                }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div v-if="selectedApartment !== 0">
                                <div v-for="apartment in apartments" :key="apartment.id">
                                    <div v-if="apartment.id === selectedApartment">
                                    <label for="guestNumber" class="form-label">Broj gostiju ( maksimalno {{apartment.apartmentCapacity}} )</label>  
                                        <div class="form-outline">
                                            <input min="1" :max="apartment.apartmentCapacity" type="number" class="form-control" v-model="guestNumber" id="guestNumber" placeholder="Unesite broj gostiju" :class="{ 'is-invalid': errors.guestNumber }" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <label for="guestNumber" class="form-label">Broj gostiju</label>  
                                <div class="form-outline">
                                    <input min="1" max="0" type="number" class="form-control" v-model="guestNumber" id="guestNumber" placeholder="Morete odabrati apartman da omogućite unos" disabled readonly :class="{ 'is-invalid': errors.guestNumber }" />
                                    <span v-if="errors.guestNumber" class="invalid-feedback">{{ guestNumberErrorMessage
                                    }}</span>
                                </div>
                            </div>   
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
                            <div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                <input class="form-check-input " type="checkbox" value="" checked id="guestPaid"
                                    v-model="guestPaid"/>
                                <label class="form-check-label" for="guestPaid">
                                    Success color
                                </label>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="addNewreservation"
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="deleteReservation"
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
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="apartDD" class="form-label">Naziv apartmana</label>
                                <select class="form-select" data-control="select2" data-placeholder="Select an option" v-model="editSelectedApartment" id="apartDD"
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
                                <input type="text" class="form-control" v-model="editGuestFirstName" id="guestFirstName" placeholder="Unesite ime gosta"
                                    :class="{ 'is-invalid': errors.guestFirstName }">
                                <span v-if="errors.guestFirstName" class="invalid-feedback">{{ guestFirstNameErrorMessage
                                    }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="guestLastName" class="form-label">Prezime gosta</label>
                                <input type="text" class="form-control" v-model="editGuestLastName" id="guestLastName" placeholder="Unesite prezime gosta" :class="{ 'is-invalid': errors.guestLastName }">
                                <span v-if="errors.guestLastName" class="invalid-feedback">{{ guestLastNameErrorMessage
                                    }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="dateStart" class="form-label">Datum dolaska</label><br>
                                <datepicker format="dd.MM.yyyy." v-model="editDateStart" id="dateStart" :disabledDates="disabledDates"
                                    style="min-width: 300px" :class="{ 'is-invalid': errors.dateStart }"></datepicker>
                                <span v-if="errors.dateStart" class="invalid-feedback">{{ dateStartErrorMessage
                                }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="dateEnd" class="form-label">Datum odlaska</label><br>
                                <datepicker format="dd.MM.yyyy." v-model="editDateEnd" id="dateEnd" :class="{ 'is-invalid': errors.dateEnd }" :disabledDates="disabledDates">
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
                                    <input type="number" class="form-control" id="fullPrice" v-model="editFullPrice" placeholder="Unseite cenu boravka" :class="{ 'is-invalid': errors.fullPrice }">
                                    <span class="input-group-text">.00</span>
                                    <span v-if="errors.fullPrice" class="invalid-feedback">{{ fullPriceErrorMessage
                                    }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="taxPrice" class="form-label">Cena takse</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-euro-sign fa-sm"></i></span>
                                    <input type="number" class="form-control" id="taxPrice" v-model="editTaxPrice" placeholder="Unesite cenu takse" :class="{ 'is-invalid': errors.taxPrice }">
                                    <span class="input-group-text">.00</span>
                                    <span v-if="errors.taxPrice" class="invalid-feedback">{{ taxPriceErrorMessage
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div v-if="selectedApartment !== 0">
                                    <div v-for="apartment in apartments" :key="apartment.id">
                                        <div v-if="apartment.id === selectedApartment">
                                        <label for="guestNumber" class="form-label">Broj gostiju ( maksimalno {{apartment.apartmentCapacity}} )</label>  
                                            <div class="form-outline">
                                                <input min="1" :max="apartment.apartmentCapacity" type="number" class="form-control" v-model="editGuestNumber" id="guestNumber" placeholder="Unesite broj gostiju" :class="{ 'is-invalid': errors.guestNumber }" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <label for="guestNumber" class="form-label">Broj gostiju</label>  
                                    <div class="form-outline">
                                        <input min="1" max="0" type="number" class="form-control" v-model="editGuestNumber" id="guestNumber" placeholder="Morete odabrati apartman da omogućite unos" disabled readonly :class="{ 'is-invalid': errors.guestNumber }" />
                                        <span v-if="errors.guestNumber" class="invalid-feedback">{{ guestNumberErrorMessage
                                        }}</span>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <label for="arrivalTime" class="form-label">Vreme dolaska (opciono)</label><br>
                                <vue-timepicker id="arrivalTime" v-model="editArrivalTime"></vue-timepicker>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="reservationType" class="form-label">Izvor rezervacije</label>
                                <select class="form-select" aria-label="Default select example" v-model="editReservationType"
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
                                <div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                    <input class="form-check-input " type="checkbox" value="" checked id="guestPaid"
                                        v-model="editGuestPaid"/>
                                    <label class="form-check-label" for="guestPaid">
                                        Success color
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="guestDescription" class="form-label">Opis gosta (opciono)</label>
                                <div class="form-floating">
                                    <textarea class="form-control" id="guestDescription" style="height: 120px"
                                        v-model="editGuestDescription"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Odustani</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="editReservation"
                        @click="editReservation">Izmeni</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal za izmenu krej -->

    <!-- Informacije o gostu modal -->
    <!-- <div class="modal" tabindex="-1" id="reservationInfoModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Informacije o rezervaciji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                    <div class="m-1">
                        <label style="font-weight:700;">Apartman:</label>
                        <p style="font-size: 14px;">{{ editSelectedApartment }}</p>
                    </div>
                    <div class="m-1">
                        <label style="font-weight:700;">Ime gosta:</label>
                        <p style="font-size: 14px;">{{ guestFirstName + ' ' + guestLastName }}</p>
                    </div>
                    <div class="m-1">
                        <label style="font-weight:700;">Period boravka:</label>
                        <p style="font-size: 14px;">{{ startDate + ' - ' + endDate }}</p>
                    </div>
                    <div class="m-1">
                        <label style="font-weight:700;">Cena boravka:</label>
                        <p style="font-size: 14px;">{{ fullPrice }}&nbsp;<i class="fa-solid fa-euro-sign fa-sm"></i></p>
                    </div>
                    <div class="m-1">
                        <label style="font-weight:700;">Vreme dolaska:</label>
                        <p style="font-size: 14px;">{{ arrivalTime }}</p>
                    </div>
                    <div class="m-1">
                        <label style="font-weight:700;">Broj gostiju:</label>
                        <p style="font-size: 14px;">{{ guestNumber }}</p>
                    </div>
                    <div class="m-1">
                        <label style="font-weight:700;">Cena takse:</label>
                        <p style="font-size: 14px;">{{ taxPrice }}&nbsp;<i class="fa-solid fa-euro-sign fa-sm"></i></p>
                    </div>
                    </div>
                    <div class="col-6">
                    <div v-if="guestRegistered == 0" class="m-1">
                        <label style="font-weight:700;">Gost prijavljen:</label><br>
                        <i class="fa-solid fa-circle mb-1" style="color: red;"></i><label>&nbsp;Nije
                        prijavljen</label>&nbsp;<span><a type="button" id="guestRegisteredSwitch"
                            @click="guestRegisteredChange"><i class="fa-regular fa-circle-check fa-lg"
                            style="color: green;"></i></a></span>

                    </div>

                    <div v-else class="m-1">
                        <label style="font-weight:700;">Gost prijavljen:</label><br>
                        <i class="fa-solid fa-circle mb-3"
                        style="color: green;"></i><label>&nbsp;Prijavljen</label>&nbsp;<span><a type="button"
                            id="guestRegisteredSwitch" @click="guestRegisteredChange"><i
                            class="fa-regular fa-circle-xmark fa-lg" style="color: red;"></i></a></span>
                    </div>
                    <div v-if="guestPaid == 0" class="m-1">
                        <label style="font-weight:700;">Gost platio:</label><br>
                        <i class="fa-solid fa-circle mb-3" style="color: red;"></i><label>&nbsp;Nije
                        platio</label>&nbsp;<span><a type="button" id="guestPaidChange" @click="guestPaidChange"><i
                            class="fa-regular fa-circle-check fa-lg" style="color: green;"></i></a></span>
                    </div>

                    <div v-else class="m-1">
                        <label style="font-weight:700;">Gost platio:</label><br>
                        <i class="fa-solid fa-circle mb-3" style="color: green;"></i><label>&nbsp;Platio</label>&nbsp;<span><a
                            type="button" id="guestPaidChange" @click="guestPaidChange"><i
                            class="fa-regular fa-circle-xmark fa-lg" style="color: red;"></i></a></span>
                    </div>
                    <div v-if="guestHasCar == 0" class="m-1">
                        <label style="font-weight:700;">Gost dolazi autom:</label><br>
                        <i class="fa-solid fa-circle mb-3" style="color: red;"></i><label>&nbsp;Ne</label>&nbsp;<span><a
                            type="button" id="guestHasCarChange" @click="guestHasCarChange"><i
                            class="fa-regular fa-circle-check fa-lg" style="color: green;"></i></a></span>
                    </div>

                    <div v-else class="m-1">
                        <label style="font-weight:700;">Gost dolazi autom:</label><br>
                        <i class="fa-solid fa-circle mb-3" style="color: green;"></i><label>&nbsp;Da</label>&nbsp;<span><a
                            type="button" id="guestHasCarChange" @click="guestHasCarChange"><i
                            class="fa-regular fa-circle-xmark fa-lg" style="color: red;"></i></a></span>
                    </div>
                    <div v-if="guestDescription == ''" class="m-1">
                        <label style="font-weight:700;">Opis:</label><br>
                        <p>/</p>
                    </div>

                    <div v-else class="m-1">
                        <label style="font-weight:700;">Opis:</label><br>
                        <p style="font-size: 14px;">{{ guestDescription }}</p>
                    </div>
                    <div class="m-1">
                        <label style="font-weight:700;">Datum rezervisanja:</label>
                        <p style="font-size: 14px;">{{ reservationSetDay }}</p>
                    </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- kraj informacija o gostu modal -->

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
    props: ['userRole','canEditReservations','canAddReservations','canAllowReservations','canDeleteReservations'],
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
            permissionEditReservations: this.canEditReservations,
            permissionAddReservations: this.canAddReservations,
            permissionAllowReservations: this.canAllowReservations,
            permissionDeleteReservations: this.canDeleteReservations,

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

            filterApartments: '',
            filterResType: '',
            filterResStatus: '',

            editSelectedApartment: 0,
            editGuestFirstName: null,
            editGuestLastName: null,
            editDateStart: null,
            editDateEnd: null,
            editFullPrice: null,
            editTaxPrice: null,
            editGuestNumber: null,
            editArrivalTime: null,
            editReservationType: 0,
            editGuestPaid: 0,
            editGuestDescription: null,

            disabledDates: [],
        };
    },
    mounted() {
        let th = this;
        this.reservationsTable()

        // allow reservation action
        $(document).on('click', '#allowAction', function (e) {
            th.userRowID = $(this).data("entry-id");
        })

        // delete reservation action
        $(document).on('click', '#deleteAction', function (e) {
            th.userRowID = $(this).data("entry-id");
        })
        this.getApartName();

        // edit reservation action
        $(document).on('click', '#editAction', function (e) {
            th.userRowID = $(this).data("entry-id");
            axios
                .post("/rezervacije/getReservationDataForEdit", { id: th.userRowID })
                .then((response) => {
                    th.editSelectedApartment = response.data.data[0].apart_id;
                    th.editGuestFirstName = response.data.data[0].guestFirstName;
                    th.editGuestLastName = response.data.data[0].guestLastName;
                    th.editDateStart = response.data.data[0].date_start;
                    th.editDateEnd = response.data.data[0].date_end;
                    th.editFullPrice = response.data.data[0].fullPrice;
                    th.editTaxPrice = response.data.data[0].taxPrice;
                    th.editGuestNumber = response.data.data[0].guestNumber;
                    th.editArrivalTime = response.data.data[0].arrivalTime;
                    th.editReservationType = response.data.data[0].reservationType;
                    th.editGuestPaid = response.data.data[0].guestPaid;
                    th.editGuestDescription = response.data.data[0].guestDescription;
                    console.log("RIMTIM",th.editDateEnd);
                }).catch((error) => {
                    Swal.fire({
                        icon: "warning",
                        text: "Greška prilikom uzimanja podataka o rezervaciji!",
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"
                    });
                    console.log(error);
                });
        })
    },

    watch: {
        selectedApartment(newVal) {
      if (newVal !== 0) {
        axios.post('/rezervacije/getDisabledDates', { apartID: newVal })
          .then(response => {
            console.log(response.data);
            // Ensure date conversion is correct
            this.disabledDates = response.data.map(dateString => {
              const date = new Date(dateString);
              if (isNaN(date)) {
                console.error(`Invalid date format: ${dateString}`);
                return null;
              }
              return date;
            }).filter(date => date !== null); // Filter out any invalid dates
            console.log("RIMTIMTAGITIM", this.disabledDates);
          })
          .catch(error => {
            console.error(error);
          });
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
        // edit reservation pocetak
        editReservation(){
            let th = this;
            let editReservationModal = $('#editReservationModal');

            const editData = {
                id: th.userRowID,
                apartID: th.editSelectedApartment,
                firstName: th.editGuestFirstName,
                lastName: th.editGuestLastName,
                dateStart: th.editDateStart,
                dateEnd: th.editDateEnd,
                fullPrice: th.editFullPrice,
                taxPrice: th.editTaxPrice,
                guestNumber: th.editGuestNumber,
                arrivalTime: th.editArrivalTime,
                reservationType: th.editReservationType,
                guestPaid: th.editGuestPaid,
                guestDescription: th.editGuestDescription,
            };
            $("#editReservation").prop("disabled", true);
            axios
                .post("/rezervacije/editReservation", editData, {
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                }).then((response) => {

                    $("#editReservation").prop("disabled", true);

                    Swal.fire({
                        icon: "success",
                        text: "Uspešno izmenjeno.",
                        timer: 5000,
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"

                    });

                    th.reservationsTable();
                    editReservationModal.modal('hide');
                    $("#editReservation").prop("disabled", false);
                }).catch((error) => {
                    
                    $("#editReservation").prop("disabled", false);

                    Swal.fire({
                        icon: "warning",
                        text: "Greška prilikom izmene rezervacije!",
                        confirmButton: "confirmationBtn",
                        confirmButtonColor: "#4eb3ac"
                    });

                    console.error(error);
                });
        },
        // edit reservation kraj
        
        // filters pocetak
        resFilters(){
            this.getApartName();
        },
        resetFilters(){
            this.filterApartments = '';
            this.filterResType = '';
            this.filterResStatus = '';
            this.reservationsTable();
        },
        getFilteredData(){
            console.log('Selected apartment ID:', this.filterApartments);
            console.log('Selected type:', this.filterResType);
            console.log('Selected status:', this.filterResStatus);
            let th = this;
            th.reservationsTable()
        },
        // filters kraj
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
            var permissionEditReservations = this.canEditReservations;
            var permissionDeleteReservations = this.canDeleteReservations;
            var permissionAllowReservations = this.canAllowReservations;
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
                        filterApart: th.filterApartments,
                        filterResStatus: th.filterResStatus,
                        filterResType: th.filterResType
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                columnDefs: [
                    { targets: 0, orderable: true, width: "5%" },
                    { targets: 1, orderable: true },
                    { targets: 2, orderable: true, width: "15%" },
                    { targets: 3, orderable: true, width: "15%" },
                    { targets: 4, orderable: true, width: "10%" },
                    { targets: 5, orderable: true, width: "10%" },
                    { targets: 6, orderable: true, width: "10%" },
                    { targets: 7, orderable: true, width: "15%" },
                    { targets: 8, orderable: false, width: "5%" },

                ],
                columns: [
                    { data: "id" },
                    { data: "apartmentName" },
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
                                '<div class="dropdown-menu text-center">';

                            actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#reservationInfoModal" id="infoAction" class="dropdown-item" data-entry-id="' +
                                row.id +
                                '" ><i class="fa-solid fa-eye fa-sm" style="margin-right: 5px"></i>Pregled</a>';
                            if (permissionEditReservations === 1) {
                                actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#editReservationModal" id="editAction" class="dropdown-item" data-entry-id="' +
                                    row.id +
                                    '" ><i class="fa-regular fa-pen-to-square fa-sm" style="margin-right: 5px"></i>Izmeni</a>';
                            }

                            if (permissionDeleteReservations === 1) {
                                actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#deleteReservationModal" id="deleteAction" class=" deleteAction dropdown-item" data-entry-id="' +
                                    row.id +
                                    '" ><i class="fa-solid fa-trash-can fa-sm" style="margin-right: 5px"></i> Obriši</a>';
                            }

                            // Additional action based on checkRole, checkRole JE POKAZATELJ DA LI JE ODOBRENO ILI NIJE
                            if (permissionAllowReservations === 1 && row.checkRole === 0) {
                                actionsHtml += '<a type="button" data-bs-toggle="modal" data-bs-target="#allowReservationModal" id="allowAction" class="dropdown-item" data-entry-id="' +
                                    row.id +
                                    '" ><i class="fa-solid fa-check fa-sm" style="margin-right: 5px"></i>Odobri</a>';
                            }
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
            var jednocifrenBrRegEx = /^[1-6]{1}$/
            var priceRegEx = /^[0-9]+$/

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
            else if(!priceRegEx.test(this.fullPrice)) {
                this.errors.fullPrice = true;
                this.fullPriceErrorMessage = "Cena mora biti izražena u brojevima.";
            }

            if(this.taxPrice === "" || this.taxPrice === null || this.taxPrice === 0) {
                this.errors.taxPrice = true;
                this.taxPriceErrorMessage = "Morete uneti cenu takse (ne može biti nula)";
            }
            else if(!priceRegEx.test(this.taxPrice)) {
                this.errors.taxPrice = true;
                this.taxPriceErrorMessage = "Boravišna taksa mora biti izražena u brojevima.";
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
                    $("#notificationDropdown").load(location.href + " #notificationDropdown>*", "");
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
    background-color: #fce4ec !important;
    color: rgb(255, 60, 60) !important;
}
.switch-lg {
    transform: scale(1.5);
    /* background-color: red; */
}

</style>