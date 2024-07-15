<template>
  <!-- zaglavlje -->
  <div class="row mt-3 mb-5">
    <div class="col-4">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/kalendar">Kalendar</a></li>
        <li class="breadcrumb-item">Permisije</li>
      </ol>
    </div>
  </div>
  <!-- zaglavlje kraj -->

  <div class="d-flex flex-column flex-xl-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
      <!--begin::Card-->
      <div class="card mb-5 mb-xl-8">
        <!--begin::Card body-->
        <div class="card-body pt-15">
          <!--begin::Summary-->
          <div class="d-flex flex-center flex-column mb-5">
            <!--begin::Avatar-->
            <div class="symbol symbol-100px symbol-circle mb-7">
              <img
                :src="'assets/media/avatars/' + permissionsData[0].image"
                alt="image"
              />
            </div>
            <!--end::Avatar-->
            <!--begin::Name-->
            <a
              href="#"
              class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1"
              >{{
                this.permissionsData[0].name +
                " " +
                this.permissionsData[0].surname
              }}</a
            >
            <!--end::Name-->
            <!--begin::Position-->
            <div class="fs-5 fw-semibold text-muted mb-6">
              {{
                this.permissionsData[0].role == "USER"
                  ? "Korisnik"
                  : "Administrator"
              }}
            </div>
            <!--end::Position-->
          </div>
          <!--end::Summary-->
          <!--begin::Details toggle-->
          <div class="d-flex flex-stack fs-4 py-3">
            <div
              class="fw-bold rotate collapsible"
              data-bs-toggle="collapse"
              href="#kt_customer_view_details"
              role="button"
              aria-expanded="false"
              aria-controls="kt_customer_view_details"
            >
              Detalji korisnika
            </div>
            <span
              data-bs-toggle="tooltip"
              data-bs-trigger="hover"
              data-bs-original-title="Edit customer details"
              data-kt-initialized="1"
            >
            </span>
          </div>
          <!--end::Details toggle-->
          <div class="separator separator-dashed my-3"></div>
          <!--begin::Details content-->
          <div id="kt_customer_view_details" class="collapse show">
            <div class="py-5 fs-6">
              <!--begin::Details item-->
              <div class="fw-bold mt-5">ID Korisnika</div>
              <div class="text-gray-600">
                {{ "ID-" + this.permissionsData[0].id }}
              </div>
              <!--begin::Details item-->
              <!--begin::Details item-->
              <div class="fw-bold mt-5">Email Adresa</div>
              <div class="text-gray-600">
                <a href="#" class="text-gray-600 text-hover-primary">{{
                  this.permissionsData[0].email
                }}</a>
              </div>
            </div>
          </div>
          <!--end::Details content-->
        </div>
        <!--end::Card body-->
      </div>
      <!--end::Card-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
      <!--begin:::Tab content-->
      <div class="tab-content" id="myTabContent">
        <!--begin:::Tab pane-->
        <div
          class="tab-pane fade show active"
          id="kt_customer_view_overview_tab"
          role="tabpanel"
        >
          <!--begin::Card-->
          <div class="card pt-4 mb-6 mb-xl-9">
            <!--begin::Card header-->
            <div class="card-header border-0">
              <!--begin::Card title-->
              <div class="card-title">
                <h2>Permisije korisnika</h2>
              </div>
              <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0 pb-5">
              <!--begin::Accordion-->
              <div
                class="accordion accordion-icon-collapse"
                id="kt_accordion_3"
              >
                <!--begin::Item-->
                <div class="mb-5">
                  <!--begin::Header-->
                  <div
                    class="accordion-header py-3 d-flex"
                    data-bs-toggle="collapse"
                    data-bs-target="#kt_accordion_3_item_1"
                  >
                    <span class="accordion-icon">
                      <i
                        class="ki-duotone ki-plus-square fs-3 accordion-icon-off"
                        ><span class="path1"></span><span class="path2"></span
                        ><span class="path3"></span
                      ></i>
                      <i
                        class="ki-duotone ki-minus-square fs-3 accordion-icon-on"
                        ><span class="path1"></span><span class="path2"></span
                      ></i>
                    </span>
                    <h3 class="fs-4 fw-semibold mb-0 ms-4">
                      Permisije Kalendara
                    </h3>
                  </div>
                  <!--end::Header-->

                  <!--begin::Body-->
                  <div
                    id="kt_accordion_3_item_1"
                    class="fs-6 collapse show ps-10"
                    data-bs-parent="#kt_accordion_3"
                  >
                    Trenutno nema permisija za kalendar
                  </div>
                  <!--end::Body-->
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="mb-5">
                  <!--begin::Header-->
                  <div
                    class="accordion-header py-3 d-flex collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#kt_accordion_3_item_2"
                  >
                    <span class="accordion-icon">
                      <i
                        class="ki-duotone ki-plus-square fs-3 accordion-icon-off"
                        ><span class="path1"></span><span class="path2"></span
                        ><span class="path3"></span
                      ></i>
                      <i
                        class="ki-duotone ki-minus-square fs-3 accordion-icon-on"
                        ><span class="path1"></span><span class="path2"></span
                      ></i>
                    </span>
                    <h3 class="fs-4 fw-semibold mb-0 ms-4">
                      Permisije Rezervacija
                    </h3>
                  </div>
                  <!--end::Header-->

                  <!--begin::Body-->
                  <div
                    id="kt_accordion_3_item_2"
                    class="collapse fs-6 ps-10"
                    data-bs-parent="#kt_accordion_3"
                  >
                    <!-- rez check pocetak -->
                    <div class="form-check mt-3 mb-3">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="canAddReservations"
                        v-model="permissionsData[0].canAddReservations"
                        :true-value="1"
                        :false-value="0"
                      />
                      <label class="form-check-label" for="canAddReservations">
                        Korisnik može da dodaje nove rezervacije
                      </label>
                    </div>

                    <div class="form-check mt-3 mb-3">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="canEditReservations"
                        v-model="permissionsData[0].canEditReservations"
                        :true-value="1"
                        :false-value="0"
                      />
                      <label class="form-check-label" for="canEditReservations">
                        Korisnik može da vrši izmene na rezervacijama
                      </label>
                    </div>

                    <div class="form-check mt-3 mb-3">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="canDeleteReservations"
                        v-model="permissionsData[0].canDeleteReservations"
                        :true-value="1"
                        :false-value="0"
                      />
                      <label
                        class="form-check-label"
                        for="canDeleteReservations"
                      >
                        Korisnik može da obriše rezervacije
                      </label>
                    </div>

                    <div class="form-check mt-3 mb-3">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="canAllowReservations"
                        v-model="permissionsData[0].canAllowReservations"
                        :true-value="1"
                        :false-value="0"
                      />
                      <label
                        class="form-check-label"
                        for="canAllowReservations"
                      >
                        Korisnik može da odobrava zahteve za rezervacije
                      </label>
                    </div>
                    <!-- rez check kraj -->
                  </div>
                  <!--end::Body-->
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="mb-5">
                  <!--begin::Header-->
                  <div
                    class="accordion-header py-3 d-flex collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#kt_accordion_3_item_3"
                  >
                    <span class="accordion-icon">
                      <i
                        class="ki-duotone ki-plus-square fs-3 accordion-icon-off"
                        ><span class="path1"></span><span class="path2"></span
                        ><span class="path3"></span
                      ></i>
                      <i
                        class="ki-duotone ki-minus-square fs-3 accordion-icon-on"
                        ><span class="path1"></span><span class="path2"></span
                      ></i>
                    </span>
                    <h3 class="fs-4 fw-semibold mb-0 ms-4">
                      Permisije Apartmani
                    </h3>
                  </div>
                  <!--end::Header-->

                  <!--begin::Body-->
                  <div
                    id="kt_accordion_3_item_3"
                    class="collapse fs-6 ps-10"
                    data-bs-parent="#kt_accordion_3"
                  >
                    <!-- PERMISIJE APARTMANI -->
                    <div class="form-check mt-3 mb-3">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="canAddApartments"
                        v-model="permissionsData[0].canAddApartments"
                        :true-value="1"
                        :false-value="0"
                      />
                      <label
                        class="form-check-label"
                        for="canAddApartments"
                      >
                        Korisnik može da dodaje nove apartmane
                      </label>
                    </div>
                    <div class="form-check mt-3 mb-3">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="canEditApartments"
                        v-model="permissionsData[0].canEditApartments"
                        :true-value="1"
                        :false-value="0"
                      />
                      <label
                        class="form-check-label"
                        for="canEditApartments"
                      >
                        Korisnik može da vrši izmene na apartmanima
                      </label>
                    </div>
                    <div class="form-check mt-3 mb-3">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="canDeleteApartments"
                        v-model="permissionsData[0].canDeleteApartments"
                        :true-value="1"
                        :false-value="0"
                      />
                      <label
                        class="form-check-label"
                        for="canDeleteApartments"
                      >
                        Korisnik može da obriše apartmane
                      </label>
                    </div>
                  </div>
                  <!-- PERMISIJE APARTMANI -->
                  <!--end::Body-->
                </div>
                <!--end::Item-->
              </div>
              <!--end::Accordion-->

              <!-- SAVE PERMISSION CHANGES START -->
              <div class="d-flex justify-content-end mt-3">
                <a href="/administracija-korisnika" class="btn btn-danger me-2"
                  >Odustani</a
                >
                <a
                  href="#"
                  @click="savePermissionsChanges"
                  class="btn btn-primary"
                  >Sačuvaj</a
                >
              </div>
              <!-- SAVE PERMISSION CHANGES END -->
            </div>
            <!--end::Card body-->
          </div>
          <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
      </div>
      <!--end:::Tab content-->
    </div>
    <!--end::Content-->
  </div>
</template>
  
  <script>
import axios from "axios";

export default {
  props: ["permissions", "user"],
  data() {
    return {
      permissionsData: this.permissions,
    };
  },
  mounted() {
    console.log(this.permissionsData);
  },
  methods: {
    savePermissionsChanges(event) {
      let th = this;
      event.preventDefault();
      const permissionsDataChanged = {
        id: th.permissionsData[0].id,
        canAddReservations: th.permissionsData[0].canAddReservations,
        canAllowReservations: th.permissionsData[0].canAllowReservations,
        canDeleteReservations: th.permissionsData[0].canDeleteReservations,
        canEditReservations: th.permissionsData[0].canEditReservations,

        canAddApartments: th.permissionsData[0].canAddApartments,
        canEditApartments: th.permissionsData[0].canEditApartments,
        canDeleteApartments: th.permissionsData[0].canDeleteApartments,
      };
      axios
        .post(
          "/administracija-korisnika/permisije/savePermissionChanges",
          permissionsDataChanged,
          {
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
          }
        )
        .then((response) => {
          Swal.fire({
            icon: "success",
            text: "Uspešno sačuvano.",
            timer: 5000,
            confirmButton: "confirmationBtn",
            confirmButtonColor: "#4eb3ac",
          });
        })
        .catch((error) => {
          Swal.fire({
            icon: "warning",
            text: "Greška prilikom čuvanja permisija!",
            confirmButton: "confirmationBtn",
            confirmButtonColor: "#4eb3ac",
          });

          console.error(error);
        });
    },
  },
};
</script>