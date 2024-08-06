<template>
    <!-- zaglavlje -->
    <div class="row mt-3 mb-5">
      <div class="col-4">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="/kalendar">Kalendar</a></li>
          <li class="breadcrumb-item">Lista prihoda po apartmanima</li>
        </ol>
      </div>
    </div>
    <!-- zaglavlje kraj -->
    <div class="container">
      <div class="row">
        <div v-for="(item, index) in income" :key="index" class="col-md-4 mb-3">
          <div class="card card-bordered">
            <div class="card-header">
              <div class="row">
                <div class="col-12">
                  <div class="mt-3 symbol symbol-50px">
                    <img
                      :src="`assets/media/stock/ecommerce/${item.apartmentPhotos}`"
                      alt=""
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div
                  class="col-12 d-flex justify-content-between align-items-center"
                >
                  <h3 class="card-title">{{ item.apartmentName }}</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div>
                <h5>
                  Ukupno iznos rezervacija: {{ item.totalFullPrice || 0 }}&nbsp;<i
                    class="fa-solid fa-euro-sign fa-sm"
                  ></i>
                </h5>
              </div>
              <div>
                Ukupan iznos taksi: {{ item.totalTaxPrice || 0 }}&nbsp;<i
                  class="fa-solid fa-euro-sign fa-sm"
                ></i>
              </div>
              <div
                class="mb-5 mt-5 d-flex justify-content-between align-items-center"
              >
                <span><h5>Procenat:</h5></span>
                <input
                  type="number"
                  v-model="item.percentageInput"
                  @input="updatePercentage(item)"
                  class="form-control w-25"
                  placeholder="Unesite procenat"
                  :disabled="canManagePercentage === 0"
                />
              </div>
              <div class="mb-3 mt-5">
                <div class="row">
                  <div class="col-6">
                    <button
                      class="btn btn-success"
                      :disabled="canExportExpences === 0"
                      @click="exportInvoiceTxt(item)"
                    >
                      <i class="fa-solid fa-download"></i>Izvod
                    </button>
                  </div>
                  <div class="col-6 d-flex justify-content-end align-items-end">
                    <button
                      class="btn btn-info"
                      data-bs-toggle="modal"
                      data-bs-target="#newExpenceModal"
                      :disabled="canManageAdditionalExpences === 0"
                      @click="addNewExpence(item)"
                    >
                      Dodatni troškovi
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="mb-3 mt-3 text-light-success bg-success">
                Iznos procenta: ({{ item.percentageInput }}%):
                {{ calculatePercentage(item) }}&nbsp;<i
                  class="fa-solid fa-euro-sign fa-sm"
                ></i>
              </div>
              <div class="mb-3 mt-3 text-light-info bg-info">
                Iznos dodatnih troškova: {{ item.totalExpencesPrice }}&nbsp;<i
                  class="fa-solid fa-euro-sign fa-sm"
                ></i>
              </div>
              <div class="mb-3 mt-3 text-light-danger bg-danger">
                Ukupni iznos posle obračuna procenta:
                {{ calculateAmountAfterPercentage(item) }}&nbsp;<i
                  class="fa-solid fa-euro-sign fa-sm"
                ></i>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="modal fade" tabindex="-1" id="newExpenceModal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Dodatni troškovi</h3>
  
              <!--begin::Close-->
              <div
                class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                <i class="ki-duotone ki-cross fs-1"
                  ><span class="path1"></span><span class="path2"></span
                ></i>
              </div>
              <!--end::Close-->
            </div>
  
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <label class="form-label">Opis</label>
                  <textarea
                    class="form-control w-100"
                    data-kt-autosize="true"
                    v-model="description"
                  ></textarea>
                  <div class="text-muted fs-7">
                    Ovde možete dodati vaš opis dodatnog troška.
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label">Iznos</label>
                  <div class="input-group input-group-solid mb-5">
                    <span class="input-group-text">€</span>
                    <input
                      type="number"
                      class="form-control"
                      v-model="amount"
                      @input="formatAmount"
                    />
                  </div>
                  <div class="text-muted fs-7">
                    Ovde unesite iznos dodatnog troška.
                  </div>
                </div>
              </div>
            </div>
  
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-danger"
                data-bs-dismiss="modal"
              >
                Odustani
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="saveNewExpence"
              >
                Sačuvaj
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: [
      "incomeData",
      "canManagePercentage",
      "canManageAdditionalExpences",
      "canExportExpences",
    ],
    data() {
      return {
        income: this.incomeData.map((item) => ({
          ...item,
          percentageInput: this.getStoredPercentage(item.apartmentName) || 0,
        })),
        apartID: null,
        description: "",
        amount: null,
        canManagePercentage: this.canManagePercentage,
        canManageAdditionalExpences: this.canManageAdditionalExpences,
        canExportExpences: this.canExportExpences,
      };
    },
    methods: {
      updatePercentage(item) {
        localStorage.setItem(
          `percentage-${item.apartmentName}`,
          item.percentageInput
        );
      },
      calculatePercentage(item) {
        return (item.totalFullPrice * (item.percentageInput / 100)).toFixed(2);
      },
      calculateAmountAfterPercentage(item) {
        const percentageAmount =
          item.totalFullPrice * (item.percentageInput / 100);
        const amountAfterPercentage = item.totalFullPrice - percentageAmount;
        return (amountAfterPercentage - item.totalExpencesPrice).toFixed(2);
      },
      getStoredPercentage(apartmentName) {
        const storedValue = localStorage.getItem(`percentage-${apartmentName}`);
        return storedValue ? parseFloat(storedValue) : null;
      },
      addNewExpence(item) {
        this.apartID = item.id;
      },
      resetExpenceInput() {
        this.description = "";
        this.amount = "";
      },
      saveNewExpence() {
        let newExpenceModal = $("#newExpenceModal");
        axios
          .post("/lista-prihoda/saveNewExpence", {
            apartID: this.apartID,
            description: this.description,
            amount: this.amount,
          })
          .then((response) => {
            Swal.fire({
              icon: "success",
              text: "Uspešno sačuvana rezervacija.",
              timer: 5000,
              confirmButton: "confirmationBtn",
              confirmButtonColor: "#4eb3ac",
            });
  
            this.resetExpenceInput();
            newExpenceModal.modal("hide");
            $(".modal-backdrop").remove();
            window.location.reload();
          })
          .catch((error) => {
            newExpenceModal.modal("hide");
            $(".modal-backdrop").remove();
            Swal.fire({
              icon: "warning",
              text: "Greška prilikom dodavanja novog troška!",
              confirmButton: "confirmationBtn",
              confirmButtonColor: "#4eb3ac",
            });
  
            this.resetExpenceInput();
            console.error(error);
          });
      },
      exportInvoiceTxt(item) {
        this.apartID = item.id;
        axios
          .post("/lista-prihoda/exportInvoiceTxt", { apartID: this.apartID })
          .then((response) => {})
          .catch((error) => {
            Swal.fire({
              icon: "warning",
              text: "Greška prilikom izvlačenja izvoda finansija!",
              confirmButton: "confirmationBtn",
              confirmButtonColor: "#4eb3ac",
            });
            console.error(error);
          });
      },
      formatAmount() {
        // Proveri da li amount sadrži broj
        if (this.amount && !isNaN(this.amount)) {
          // Ukloni eventualne suvišne nule posle decimale
          this.amount = parseFloat(this.amount).toString();
        }
      },
    },
    mounted() {},
  };
  </script>
  
  <style scoped>
  .card-img-top {
    width: 100%;
    height: auto;
  }
  
  .form-control {
    max-width: 150px;
  }
  
  .text-light-success,
  .text-light-danger,
  .text-light-info {
    border-radius: 8px;
    padding: 10px;
  }
  
  .bg-success {
    background-color: #28a745;
    color: white;
  }
  
  .bg-info {
    background-color: #7239ea;
    color: white;
  }
  
  .bg-danger {
    background-color: #dc3545;
    color: white;
  }
  </style>
  