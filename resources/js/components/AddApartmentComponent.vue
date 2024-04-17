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
                  background-image: url('assets/media/svg/avatars/blank.svg');
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
                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
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
            <select
              class="form-select mb-2"
              data-control="select2"
              data-hide-search="true"
              data-placeholder="Status parkinga"
              id="parking"
              data-select2-id="select2-data-kt_ecommerce_add_product_status_select"
              aria-hidden="true"
              data-kt-initialized="1"
            >
              <option value="2" selected="selected" disabled>
                Status parkinga
              </option>
              <option value="0">Nema parking</option>
              <option value="1">Ima parking</option>
            </select>
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
        <!--begin::Weekly sales-->
        <div class="card card-flush shadow-sm py-4">
          <!--begin::Card header-->
          <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
              <h2>Weekly Sales</h2>
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
                  id="basic-url"
                  placeholder="web putanja lokacije"
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
                    <div class="ql-toolbar ql-snow">
                      <span class="ql-formats"
                        ><span class="ql-header ql-picker"
                          ><span
                            class="ql-picker-label"
                            tabindex="0"
                            role="button"
                            aria-expanded="false"
                            aria-controls="ql-picker-options-0"
                            ><svg viewBox="0 0 18 18">
                              <polygon
                                class="ql-stroke"
                                points="7 11 9 13 11 11 7 11"
                              ></polygon>
                              <polygon
                                class="ql-stroke"
                                points="7 7 9 5 11 7 7 7"
                              ></polygon></svg></span
                          ><span
                            class="ql-picker-options"
                            aria-hidden="true"
                            tabindex="-1"
                            id="ql-picker-options-0"
                            ><span
                              tabindex="0"
                              role="button"
                              class="ql-picker-item"
                              data-value="1"
                            ></span
                            ><span
                              tabindex="0"
                              role="button"
                              class="ql-picker-item"
                              data-value="2"
                            ></span
                            ><span
                              tabindex="0"
                              role="button"
                              class="ql-picker-item ql-selected"
                            ></span></span></span
                        ><select class="ql-header" style="display: none">
                          <option value="1"></option>
                          <option value="2"></option>
                          <option selected="selected"></option></select></span
                      ><span class="ql-formats"
                        ><button type="button" class="ql-bold">
                          <svg viewBox="0 0 18 18">
                            <path
                              class="ql-stroke"
                              d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"
                            ></path>
                            <path
                              class="ql-stroke"
                              d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"
                            ></path>
                          </svg></button
                        ><button type="button" class="ql-italic">
                          <svg viewBox="0 0 18 18">
                            <line
                              class="ql-stroke"
                              x1="7"
                              x2="13"
                              y1="4"
                              y2="4"
                            ></line>
                            <line
                              class="ql-stroke"
                              x1="5"
                              x2="11"
                              y1="14"
                              y2="14"
                            ></line>
                            <line
                              class="ql-stroke"
                              x1="8"
                              x2="10"
                              y1="14"
                              y2="4"
                            ></line>
                          </svg></button
                        ><button type="button" class="ql-underline">
                          <svg viewBox="0 0 18 18">
                            <path
                              class="ql-stroke"
                              d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"
                            ></path>
                            <rect
                              class="ql-fill"
                              height="1"
                              rx="0.5"
                              ry="0.5"
                              width="12"
                              x="3"
                              y="15"
                            ></rect>
                          </svg></button
                      ></span>
                    </div>
                    <div
                      id="kt_ecommerce_add_product_description"
                      name="kt_ecommerce_add_product_description"
                      class="min-h-200px mb-2 ql-container ql-snow"
                    >
                      <div
                        class="ql-editor ql-blank"
                        data-gramm="false"
                        contenteditable="true"
                      >
                        <p><br /></p>
                      </div>
                      <div
                        class="ql-clipboard"
                        contenteditable="true"
                        tabindex="-1"
                      ></div>
                      <div class="ql-tooltip ql-hidden">
                        <a
                          class="ql-preview"
                          rel="noopener noreferrer"
                          target="_blank"
                          href="about:blank"
                        ></a
                        ><input
                          type="text"
                          data-formula="e=mc^2"
                          data-link="https://quilljs.com"
                          data-video="Embed URL"
                        /><a class="ql-action"></a><a class="ql-remove"></a>
                      </div>
                    </div>
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
                    <!--begin::Editor-->
                    <div class="ql-toolbar ql-snow">
                      <span class="ql-formats"
                        ><span class="ql-header ql-picker"
                          ><span
                            class="ql-picker-label"
                            tabindex="0"
                            role="button"
                            aria-expanded="false"
                            aria-controls="ql-picker-options-0"
                            ><svg viewBox="0 0 18 18">
                              <polygon
                                class="ql-stroke"
                                points="7 11 9 13 11 11 7 11"
                              ></polygon>
                              <polygon
                                class="ql-stroke"
                                points="7 7 9 5 11 7 7 7"
                              ></polygon></svg></span
                          ><span
                            class="ql-picker-options"
                            aria-hidden="true"
                            tabindex="-1"
                            id="ql-picker-options-0"
                            ><span
                              tabindex="0"
                              role="button"
                              class="ql-picker-item"
                              data-value="1"
                            ></span
                            ><span
                              tabindex="0"
                              role="button"
                              class="ql-picker-item"
                              data-value="2"
                            ></span
                            ><span
                              tabindex="0"
                              role="button"
                              class="ql-picker-item ql-selected"
                            ></span></span></span
                        ><select class="ql-header" style="display: none">
                          <option value="1"></option>
                          <option value="2"></option>
                          <option selected="selected"></option></select></span
                      ><span class="ql-formats"
                        ><button type="button" class="ql-bold">
                          <svg viewBox="0 0 18 18">
                            <path
                              class="ql-stroke"
                              d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"
                            ></path>
                            <path
                              class="ql-stroke"
                              d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"
                            ></path>
                          </svg></button
                        ><button type="button" class="ql-italic">
                          <svg viewBox="0 0 18 18">
                            <line
                              class="ql-stroke"
                              x1="7"
                              x2="13"
                              y1="4"
                              y2="4"
                            ></line>
                            <line
                              class="ql-stroke"
                              x1="5"
                              x2="11"
                              y1="14"
                              y2="14"
                            ></line>
                            <line
                              class="ql-stroke"
                              x1="8"
                              x2="10"
                              y1="14"
                              y2="4"
                            ></line>
                          </svg></button
                        ><button type="button" class="ql-underline">
                          <svg viewBox="0 0 18 18">
                            <path
                              class="ql-stroke"
                              d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"
                            ></path>
                            <rect
                              class="ql-fill"
                              height="1"
                              rx="0.5"
                              ry="0.5"
                              width="12"
                              x="3"
                              y="15"
                            ></rect>
                          </svg></button
                      ></span>
                    </div>
                    <div
                      id="kt_ecommerce_add_product_description"
                      name="kt_ecommerce_add_product_description"
                      class="min-h-200px mb-2 ql-container ql-snow"
                    >
                      <div
                        class="ql-editor ql-blank"
                        data-gramm="false"
                        contenteditable="true"
                      >
                        <p><br /></p>
                      </div>
                      <div
                        class="ql-clipboard"
                        contenteditable="true"
                        tabindex="-1"
                      ></div>
                      <div class="ql-tooltip ql-hidden">
                        <a
                          class="ql-preview"
                          rel="noopener noreferrer"
                          target="_blank"
                          href="about:blank"
                        ></a
                        ><input
                          type="text"
                          data-formula="e=mc^2"
                          data-link="https://quilljs.com"
                          data-video="Embed URL"
                        /><a class="ql-action"></a><a class="ql-remove"></a>
                      </div>
                    </div>
                    <!--end::Editor-->
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
            href="apps/ecommerce/catalog/products.html"
            id="kt_ecommerce_add_product_cancel"
            class="btn btn-light me-5"
            >Odustani</a
          >
          <!--end::Button-->
          <!--begin::Button-->
          <button
            type="submit"
            id="kt_ecommerce_add_product_submit"
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
export default {
  props: ["userRole"],
  data() {
    return {};
  },

  methods: {},
};
</script>
  
  <style scoped>
</style>
  