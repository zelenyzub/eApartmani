<template>
  <!-- zaglavlje -->
  <div class="row mt-3 mb-5 d-flex justify-content-end">
    <div class="col-6">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/kalendar">Kalendar</a></li>
        <li class="breadcrumb-item">Lista apartmana</li>
      </ol>
    </div>
    <div v-if="role === 'SUPERADMIN'" class="col-6 d-flex justify-content-end">
      <a href="/dodaj-apartman" class="btn btn-primary">
        <i class="fa fa-home fs-6" aria-hidden="true"></i>&nbsp;&nbsp; Dodajte
        novi apartman
      </a>
    </div>
    <div class="col-6 d-flex justify-content-end"></div>
  </div>
  <!-- zaglavlje kraj -->

  <!-- Lista apartmana -->
  <div class="card card-flush shadow-sm">
    <div class="card-body py-5">
      <div class="table-responsive">
        <table
          class="table table-rounded table-striped border gy-7 gs-7"
          width="100%"
          id="apartmentList"
        >
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Apartman</th>
              <th scope="col">Lokacija</th>
              <th scope="col">Kapacitet</th>
              <th scope="col">Akcije</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Apartman</th>
              <th scope="col">Lokacija</th>
              <th scope="col">Kapacitet</th>
              <th scope="col">Akcije</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <!-- Lista apartmana kraj -->

  <!-- Apartment info modal pocetak -->
  <div class="modal fade" tabindex="-1" id="apartmentInfoModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Informacije o apartmanu</h3>

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
              <div class="m-1">
                <label style="font-weight: 700">Apartman:</label>
                <p style="font-size: 14px">{{this.apartName}}</p>
              </div>
              <div class="m-1">
                <label style="font-weight: 700">Kapacitet:</label>
                <p style="font-size: 14px">{{this.apartCapacity}}</p>
              </div>
              <div class="m-1">
                <label style="font-weight: 700">Wi-fi šifra:</label>
                <p style="font-size: 14px">{{ this.wifi }}
                  <a href="#">
                    <span class="badge badge-light-success fs-7 fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Kopiraj" @click="copyToClipboardWifi">Kopiraj</span>
                  </a>
                </p>
              </div>
              <div class="m-1">
                <label style="font-weight: 700">Status parkinga:</label>
                <p style="font-size: 14px">{{ this.parkingStatus == 1 ? 'Ima parking' : 'Nema parking' }}</p>
              </div>
              <div class="m-1">
                <label style="font-weight: 700">Opis:</label>
                <p style="font-size: 14px">{{ this.apartDescription ? this.apartDescription : '/' }}</p>
              </div>
            </div>
            <div class="col-6">
              <div class="m-1">
                <label style="font-weight: 700">Ime vlasnika:</label>
                <p style="font-size: 14px">{{ this.ownerFN }}</p>
              </div>
              <div class="m-1">
                <label style="font-weight: 700">Prezime vlasnika:</label>
                <p style="font-size: 14px">{{ this.ownerLN }}</p>
              </div>
              <div class="m-1">
                <label style="font-weight: 700">Adresa:</label>
                <p style="font-size: 14px">{{ this.apartAddress }}</p>
              </div>
              <div class="m-1">
                <label style="font-weight: 700">Dodatne informacije:</label>
                <p style="font-size: 14px">{{ this.aditionalApartInfo ? this.aditionalApartInfo : '/' }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Zatvori
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Apartment info modal kraj -->
</template>
  
  <script>
import axios from "axios";
export default {
  props: ["userRole"],
  data() {
    return {
      role: this.userRole,

      apartID: null,

      apartName: '',
      apartCapacity: 0,
      apartDescription: '',
      ownerFN: '',
      ownerLN: '',
      apartAddress: '',
      aditionalInfo: '',
      wifi: '',
      parkingStatus: 0,
    };
  },
  mounted() {
    this.apartmentList();
    this.copyToClipboard();

    // apart info id pocetak
    $(document).on("click", "#infoAction", (e) => {
      this.apartID = $(e.currentTarget).data("entry-id");
      this.getApartDetailelData();
    });

    // apart info id kraj
  },
  methods: {
    copyToClipboardWifi() {
      navigator.clipboard.writeText(this.wifi).then(
        () => {
          console.log('Text copied to clipboard');
        },
        (err) => {
          console.error('Could not copy text: ', err);
        }
      );
    },
    copyToClipboard() {
      $(document).on("click", ".copy-text", function (event) {
        event.preventDefault();
        var text = $(this).data("text");
        var tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(text).select();
        document.execCommand("copy");
        tempInput.remove();
        var $badge = $(this).find("span");
        $badge
          .text("Kopirano")
          .attr("data-bs-original-title", "Kopirano")
          .tooltip("dispose")
          .tooltip("show");
        setTimeout(function () {
          $badge
            .text("Kopirajte geo lokaciju")
            .attr("data-bs-original-title", "Kopiraj")
            .tooltip("dispose");
        }, 2000);
      });
    },
    apartmentList() {
      var th = this;
      var role = this.userRole;
      $("#apartmentList").DataTable().clear().draw();
      $("#apartmentList").DataTable().clear().destroy();
      var apartmentList = $("#apartmentList").DataTable({
        oLanguage: {
          oPaginate: {
            sNext: "Sledeća",
            sPrevious: "Prethodna",
          },
          sEmptyTable: "Nema podataka.",
          sLengthMenu: "Prikaz _MENU_ apartmana",
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
          url: "/lista-apartmana/apartmentList",
          type: "POST",
          // error: function (xhr, textStatus, errorThrown) {
          //     if (xhr.status === 401 || xhr.status === 419) {
          //         window.location.replace("/login");
          //     }
          // },
          data: {},
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        },
        columnDefs: [
          { targets: 0, orderable: true, width: "5%" },
          { targets: 1, orderable: true, width: "30%" },
          { targets: 2, orderable: true, width: "15%" },
          { targets: 3, orderable: true, width: "15%" },
          { targets: 4, orderable: true, width: "10%" },
        ],
        columns: [
          { data: "id" },
          {
            render: function (data, type, row) {
              var html = '<div class="d-flex align-items-center">';
              html += "<!--begin::Thumbnail-->";
              html +=
                '<a href="/lista-apartmana/apartman/' +
                row.id +
                '" class="symbol symbol-50px">';
              html +=
                '<span class="symbol-label" style="background-image: url(assets/media//stock/ecommerce/' +
                row.apartmentPhotos +
                ');"></span>';
              html += "</a>";
              html += "<!--end::Thumbnail-->";
              html += '<div class="ms-5">';
              html += "<!--begin::Title-->";
              html +=
                '<a href="/lista-apartmana/apartman/' +
                row.id +
                '" class="text-gray-800 text-hover-primary fs-5 fw-bold">' +
                row.apartmentName +
                "</a>";
              html += "<!--end::Title-->";
              html += "</div>";
              html += "</div>";

              return html;
            },
          },
          {
            render: function (data, type, row) {
              var badge =
                '<a href="#" class="copy-text" data-text="' +
                row.gmLocation +
                '"><span class="badge badge-light-success fs-7 fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Kopiraj">' +
                "Kopirajte geo lokaciju" +
                "</span></a>";
              return badge;
            },
          },
          { data: "apartmentCapacity" },
          {
            data: "akcije",
            render: function (data, type, row) {
              var actionsHtml =
                '<div class="dropdown justify-content-center">' +
                '<a type="button" class="" data-bs-toggle="dropdown"><i class="fa-solid fa-list fa-sm" style="color: #4eb3ac;"></i></a>' +
                '<div class="dropdown-menu text-center">';

              actionsHtml +=
                '<a type="button" data-bs-toggle="modal" data-bs-target="#apartmentInfoModal" id="infoAction" class="dropdown-item" data-entry-id="' +
                row.id +
                '" ><i class="fa-solid fa-eye fa-sm" style="margin-right: 5px"></i>Pregled</a>';

              if (role === "SUPERADMIN" || role === "ADMIN") {
                actionsHtml +=
                  '<a type="button" data-bs-toggle="modal" data-bs-target="#editApartmentModal" id="editAction" class="dropdown-item" data-entry-id="' +
                  row.id +
                  '" ><i class="fa-regular fa-pen-to-square fa-sm" style="margin-right: 5px"></i>Izmeni</a>';
              } else {
                actionsHtml += "</div>" + "</div>";
              }

              if (role === "SUPERADMIN") {
                actionsHtml +=
                  '<a type="button" data-bs-toggle="modal" data-bs-target="#deleteApartmentModal" id="deleteAction" class=" deleteAction dropdown-item" data-entry-id="' +
                  row.id +
                  '" ><i class="fa-solid fa-trash-can fa-sm" style="margin-right: 5px"></i> Obriši</a>';
              } else {
                actionsHtml += "</div>" + "</div>";
              }

              actionsHtml += "</div>" + "</div>";

              return actionsHtml;
            },
          },
        ],
        // rowCallback: function (row, data) {
        //   if (data.checkRole === 0) {
        //     $(row).addClass("light-pink-bg");
        //   }
        // },
      });
    },
    getApartDetailelData() {
      try {
        axios
          .post("/getApartDeailedInfo", { apartID: this.apartID }, {})
          .then((response) => {
            const data = response.data;
            this.apartName = data.apartmentName;
            this.apartCapacity = data.apartmentCapacity;
            this.apartDescription = data.apartmentDescription;
            this.ownerFN = data.ownerFirstName;
            this.ownerLN = data.ownerLastName;
            this.apartAddress = data.apartmentAddress;
            this.aditionalInfo = data.aditionalApartInfo;
            this.wifi = data.wifiPassword;
            this.parkingStatus = data.parking;
          })
          .catch((error) => {
            console.error(error);
          });
      } catch (error) {
        console.error(
          "Došlo je do greške prilikom dohvatanja detalja apartmana: ",
          error
        );
      }
    },
  },
};
</script>
  
<style scoped>
</style>
  