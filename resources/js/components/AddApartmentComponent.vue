<template>
  <!-- zaglavlje -->
  <div class="row mt-3 mb-5 d-flex justify-content-end">
    <div class="col-6">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/kalendar">Kalendar</a></li>
        <li class="breadcrumb-item">
          <a href="/lista-apartmana">Lista apartmana</a>
        </li>
        <li class="breadcrumb-item">Dodaj apartman</li>
      </ol>
    </div>
    <div class="col-6 d-flex justify-content-end"></div>
  </div>
  <!-- zaglavlje kraj -->
  <div id="kt_app_content_container" class="app-container container-xxl">
    <!--begin::Form-->
    <form
      id="kt_ecommerce_add_product_form"
      class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
      data-kt-redirect="apps/ecommerce/catalog/products.html"
    >
      <!--begin::Aside column-->
      <div
        class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10"
      >
        <!-- FOTOGRAFIJA -->
        <!--begin::Thumbnail settings-->
        <div class="card card-flush shadow-sm py-4">
          <!--begin::Card header-->
          <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
              <h3>Fotografija apartmana</h3>
            </div>
            <!--end::Card title-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body text-center pt-0">
            <!--begin::Image input-->
            <!--begin::Image input placeholder-->
            <!--end::Image input placeholder-->
            <div
              class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
              data-kt-image-input="true"
            >
              <!--begin::Preview existing avatar-->
              <div
                class="image-input-wrapper w-150px h-150px"
                style="
                  background-image: url('assets/media/svg/avatars/blank-image.svg');
                "
              ></div>
              <!--end::Preview existing avatar-->
              <!--begin::Label-->
              <label
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="change"
                data-bs-toggle="tooltip"
                aria-label="Change avatar"
                data-bs-original-title="Change avatar"
                data-kt-initialized="1"
              >
                <i class="ki-duotone ki-pencil fs-7">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
                <!--begin::Inputs-->
                <input
                  type="file"
                  name="avatar"
                  id="apartmentPhoto"
                  accept=".png, .jpg, .jpeg"
                  @change="imageSelect"
                />
                <input type="hidden" name="avatar_remove" />
                <!--end::Inputs-->
              </label>
              <!--end::Label-->
              <!--begin::Cancel-->
              <span
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="cancel"
                data-bs-toggle="tooltip"
                aria-label="Cancel avatar"
                data-bs-original-title="Cancel avatar"
                data-kt-initialized="1"
              >
                <i class="ki-duotone ki-cross fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <!--end::Cancel-->
              <!--begin::Remove-->
              <span
                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="remove"
                data-bs-toggle="tooltip"
                aria-label="Remove avatar"
                data-bs-original-title="Remove avatar"
                data-kt-initialized="1"
              >
                <i class="ki-duotone ki-cross fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <!--end::Remove-->
            </div>
            <!--end::Image input-->
            <!--begin::Description-->
            <div class="text-muted fs-7">
              Postavide fotografiju stana. Dozvoljeni su *.png, *.jpg i *.jpeg
              formati fotografije.
            </div>
            <!--end::Description-->
          </div>
          <!--end::Card body-->
        </div>
        <!-- FOTOGRAFIJA -->

        <!-- PARKING -->
        <!--end::Thumbnail settings-->
        <!--begin::Status-->
        <div class="card card-flush shadow-sm py-4">
          <!--begin::Card header-->
          <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
              <h2>Parking</h2>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <!-- <div class="card-toolbar">
              <div
                class="rounded-circle bg-success w-15px h-15px"
                id="kt_ecommerce_add_product_status"
              ></div>
            </div> -->
            <!--begin::Card toolbar-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!--begin::Select2-->
            <label class="required form-label">Stetus parkinga</label><br>
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="radio" value="0" id="flexRadioDefault1" v-model="parkingStatus" name="parkingOption"/>
                <label class="form-check-label" for="flexRadioDefault1">
                    Nema parking
                </label>&nbsp;&nbsp;
                <input class="form-check-input" type="radio" value="1" id="flexRadioDefault2" v-model="parkingStatus" name="parkingOption"/>
                <label class="form-check-label" for="flexRadioDefault2">
                    Ima parking
                </label>
            </div><br>
            <!--end::Select2-->
            <!--begin::Description-->
            <div class="text-muted fs-7">
              Postavite status parkinga apartmana.
            </div>
            <!--end::Description-->
            <!--begin::Datepicker-->
            <div class="d-none mt-10">
              <label
                for="kt_ecommerce_add_product_status_datepicker"
                class="form-label"
                >Select publishing date and time</label
              >
              <input
                class="form-control flatpickr-input"
                id="kt_ecommerce_add_product_status_datepicker"
                placeholder="Pick date &amp; time"
                type="text"
                readonly="readonly"
              />
            </div>
            <!--end::Datepicker-->
          </div>
          <!--end::Card body-->
        </div>
        <!--end::Status-->
        <!-- PARKING -->

        <!-- LOKACIJA -->
        <!--begin::Weekly sales-->
        <div class="card card-flush shadow-sm py-4">
          <!--begin::Card header-->
          <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
              <h2>Lokacija</h2>
            </div>
            <!--end::Card title-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!-- Lokacija -->
            <!--begin::Input group-->
            <div class="mb-10 fv-row fv-plugins-icon-container">
              <!--begin::Label-->
              <label class="required form-label">Link za lokaciju</label>
              <!--end::Label-->
              <!--begin::Input-->
              <div class="input-group mb-5">
                <span class="input-group-text" id="basic-addon3">
                  <i class="ki-duotone ki-wallet fs-1"
                    ><span class="path1"></span><span class="path2"></span
                    ><span class="path3"></span><span class="path4"></span
                  ></i>
                </span>
                <input
                  type="text"
                  class="form-control"
                  id="gmLocation"
                  v-model="gmLocation"
                  placeholder="Web putanja lokacije"
                  aria-describedby="basic-addon3"
                />
              </div>
              <!--end::Input-->
              <!--begin::Description-->
              <!-- <div class="text-muted fs-7">
                      A product name is required and recommended to be unique.
                    </div> -->
              <!--end::Description-->
              <div
                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
              ></div>
            </div>
            <!--end::Input group-->
            <!-- NAZIV -->
          </div>
          <!--end::Card body-->
        </div>
        <!--end::Weekly sales-->
        <!-- LOKACIJA -->
      </div>

      <!--end::Aside column-->
      <!--begin::Main column-->
      <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin:::Tabs-->
        <!-- <ul
          class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2"
          role="tablist"
        >
          <li class="nav-item" role="presentation">
            <a
              class="nav-link text-active-primary pb-4 active"
              data-bs-toggle="tab"
              href="#kt_ecommerce_add_product_general"
              aria-selected="true"
              role="tab"
              >General</a
            >
          </li>
        </ul> -->
        <!--end:::Tabs-->
        <!--begin::Tab content-->
        <div class="tab-content">
          <!--begin::Tab pane-->
          <div
            class="tab-pane fade active show"
            id="kt_ecommerce_add_product_general"
            role="tab-panel"
          >
            <div class="d-flex flex-column gap-7 gap-lg-10">
              <!--begin::General options-->
              <div class="card card-flush shadow-sm py-4">
                <!--begin::Card header-->
                <div class="card-header">
                  <div class="card-title">
                    <h2>Osnovne informacije</h2>
                  </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                  <!-- NAZIV -->
                  <!--begin::Input group-->
                  <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Naziv apartmana</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input
                      type="text"
                      name="apartmentName"
                      id="apartmentName"
                      v-model="apartmentName"
                      class="form-control mb-2"
                      placeholder="Unesite naziv apartmana"
                      value=""
                    />
                    <!--end::Input-->
                    <!--begin::Description-->
                    <!-- <div class="text-muted fs-7">
                      A product name is required and recommended to be unique.
                    </div> -->
                    <!--end::Description-->
                    <div
                      class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
                    ></div>
                  </div>
                  <!--end::Input group-->
                  <!-- NAZIV -->

                  <!-- ADRESA -->
                  <!--begin::Input group-->
                  <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Adresa</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input
                      type="text"
                      name="apartmentAddress"
                      id="apartmentAddress"
                      v-model="apartmentAddress"
                      class="form-control mb-2"
                      placeholder="Unesite adresu apartmana"
                      value=""
                    />
                    <!--end::Input-->
                    <!--begin::Description-->
                    <!-- <div class="text-muted fs-7">
                      A product name is required and recommended to be unique.
                    </div> -->
                    <!--end::Description-->
                    <div
                      class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
                    ></div>
                  </div>
                  <!--end::Input group-->
                  <!-- ADRESA -->

                  <!-- KAPACITET -->
                  <!--begin::Input group-->
                  <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Kapacitet</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input
                      type="text"
                      name="apartmentCapacity"
                      id="apartmentCapacity"
                      v-model="apartmentCapacity"
                      class="form-control mb-2"
                      placeholder="Unesite kapacitet apartmana"
                      value=""
                    />
                    <!--end::Input-->
                    <!--begin::Description-->
                    <!-- <div class="text-muted fs-7">
                      A product name is required and recommended to be unique.
                    </div> -->
                    <!--end::Description-->
                    <div
                      class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
                    ></div>
                  </div>
                  <!--end::Input group-->
                  <!-- KAPACITET -->

                  <!-- WIFI -->
                  <!--begin::Input group-->
                  <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Wifi šifra</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input
                      type="text"
                      name="wifiPassword"
                      id="wifiPassword"
                      v-model="wifiPassword"
                      class="form-control mb-2"
                      placeholder="Unesite šifru za wifi"
                      value=""
                    />
                    <!--end::Input-->
                    <!--begin::Description-->
                    <!-- <div class="text-muted fs-7">
                      A product name is required and recommended to be unique.
                    </div> -->
                    <!--end::Description-->
                    <div
                      class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
                    ></div>
                  </div>
                  <!--end::Input group-->
                  <!-- WIFI -->

                  <!-- OPIS -->
                  <!--begin::Input group-->
                  <div>
                    <!--begin::Label-->
                    <label class="form-label">Opis</label>
                    <!--end::Label-->
                    <!--begin::Editor-->
                    <textarea
                      class="form-control"
                      v-model="apartmentDescription"
                      data-kt-autosize="true"
                    ></textarea>
                    <!--end::Editor-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">
                      Ovde možete dodati vaš opis za apartman.
                    </div>
                    <!--end::Description-->
                  </div>
                  <!--end::Input group-->
                  <!-- OPIS -->
                </div>
                <!--end::Card header-->
              </div>
              <!--end::General options-->
              <!--begin::Media-->
              <div class="card card-flush shadow-sm py-4">
                <!--begin::Card header-->
                <div class="card-header">
                  <div class="card-title">
                    <h2>Dodatne informacije</h2>
                  </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                  <!-- IME VLASNIKA -->
                  <!--begin::Input group-->
                  <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Ime vlasnika</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input
                      type="text"
                      name="ownerFirstName"
                      id="ownerFirstName"
                      v-model="ownerFirstName"
                      class="form-control mb-2"
                      placeholder="Unesite ime vlasnika apartmana"
                      value=""
                    />
                    <!--end::Input-->
                    <!--begin::Description-->
                    <!-- <div class="text-muted fs-7">
    A product name is required and recommended to be unique.
  </div> -->
                    <!--end::Description-->
                    <div
                      class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
                    ></div>
                  </div>
                  <!--end::Input group-->
                  <!-- IME VLASNIKA -->

                  <!-- PREZIME VLASNIKA -->
                  <!--begin::Input group-->
                  <div class="mb-10 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Prezime vlasnika</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input
                      type="text"
                      name="ownerLastName"
                      id="ownerLastName"
                      v-model="ownerLastName"
                      class="form-control mb-2"
                      placeholder="Unesite prezime vlasnika apartmana"
                      value=""
                    />
                    <!--end::Input-->
                    <!--begin::Description-->
                    <!-- <div class="text-muted fs-7">
                    A product name is required and recommended to be unique.
                    </div> -->
                    <!--end::Description-->
                    <div
                      class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
                    ></div>
                  </div>
                  <!--end::Input group-->
                  <!-- PREZIME VLASNIKA -->

                  <!-- DODATNE INFORMACIJE -->
                  <!--begin::Input group-->
                  <div>
                    <!--begin::Label-->
                    <label class="form-label">Dodatne informacije</label>
                    <!--end::Label-->
                    <textarea
                      class="form-control"
                      v-model="aditionalApartInfo"
                      data-kt-autosize="true"
                    ></textarea>
                    <!--begin::Description-->
                    <div class="text-muted fs-7">
                      Ovde možete uneti dodatne informacije.
                    </div>
                    <!--end::Description-->
                  </div>
                  <!--end::Input group-->
                  <!-- DODATNE INFORMACIJE -->
                </div>
                <!--end::Card header-->
              </div>
              <!--end::Media-->
            </div>
          </div>
          <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->
        <div class="d-flex justify-content-end">
          <!--begin::Button-->
          <a
            href="/lista-apartmana"
            id="resetDataBtn"
            @click="resetData()"
            class="btn btn-light me-5"
            >Odustani</a
          >
          <!--end::Button-->
          <!--begin::Button-->
          <button
            type="button"
            @click="addApartBtn()"
            id="addApartBtn"
            class="btn btn-primary"
          >
            <span class="indicator-label">Sačuvaj</span>
            <span class="indicator-progress"
              >Molimo sačekajte...
              <span
                class="spinner-border spinner-border-sm align-middle ms-2"
              ></span
            ></span>
          </button>
          <!--end::Button-->
        </div>
      </div>
      <!--end::Main column-->
    </form>
    <!--end::Form-->
  </div>
</template>
  
  <script>
import { formatDate } from "@fullcalendar/core";
export default {
  props: ["userRole"],
  data() {
    return {
      parkingStatus: 0,
      gmLocation: "",
      apartmentName: "",
      apartmentAddress: "",
      apartmentCapacity: 0,
      wifiPassword: "",
      apartmentDescription: "",
      ownerFirstName: "",
      ownerLastName: "",
      aditionalApartInfo: "",
    };
  },

  methods: {
    imageSelect(event) {
      this.selectedImage = event.target.files[0];
    },
    addApartBtn() {
      const formData = new FormData();
      formData.append("avatar", this.selectedImage);
      console.log(formatDate);
      const apartmentData = {
        parkingStatus: this.parkingStatus,
        gmLocation: this.gmLocation,
        apartmentName: this.apartmentName,
        apartmentAddress: this.apartmentAddress,
        apartmentCapacity: this.apartmentCapacity,
        wifiPassword: this.wifiPassword,
        apartmentDescription: this.apartmentDescription,
        ownerFirstName: this.ownerFirstName,
        ownerLastName: this.ownerLastName,
        aditionalApartInfo: this.aditionalApartInfo,
      };

      axios
        .post("/dodaj-apartman/uploadPhoto", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
            const pathParts = response.data.image_path.split("/");
            const filename = pathParts[pathParts.length - 1];
            apartmentData.avatar = filename;
          axios
            .post("/dodaj-apartman/addApartment", apartmentData)
            .then((response) => {
              Swal.fire({
                icon: "success",
                text: "Uspešno dodat apartman.",
                timer: 5000,
                confirmButton: "confirmationBtn",
                confirmButtonColor: "#4eb3ac",
              });
              setTimeout(() => {
                window.location.href = "/lista-apartmana";
              }, 5000);
              this.resetData();
            })
            .catch((error) => {
              Swal.fire({
                icon: "warning",
                text: "Greška prilikom dodavanja rezervacije!",
                confirmButton: "confirmationBtn",
                confirmButtonColor: "#4eb3ac",
              });
            });
        })
        .catch((error) => {
          console.error("Error uploading image:", error);
          Swal.fire({
            icon: "error",
            text: "Greška prilikom upload-a slike!",
            confirmButton: "confirmationBtn",
            confirmButtonColor: "#4eb3ac",
          });
        });
    },

    // START RESET INPUT
    resetData() {
      this.parkingStatus = 0;
      this.gmLocation = "";
      this.apartmentName = "";
      this.apartmentAddress = "";
      this.apartmentCapacity = 0;
      this.wifiPassword = "";
      this.apartmentDescription = "";
      this.ownerFirstName = "";
      this.ownerLastName = "";
      this.aditionalApartInfo = "";
    },
    // END RESET INPUT
  },
};
</script>
  
<style scoped>
</style>
  