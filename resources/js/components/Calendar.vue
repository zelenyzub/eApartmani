<template>
  <div class="row mt-3 mb-5 d-flex justify-content-end">
    <div class="col-6">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">Kalendar</li>
        <li class="breadcrumb-item active">{{ selectedApartment ? apartments.find(apartment => apartment.id ===
          selectedApartment).apartmentName : '' }}</li>
      </ol>
    </div>
    <div class="col-3 d-flex justify-content-end">
      <button type="button" id="btnLegenda" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#modalLegend"><i class="fa-solid fa-info fa-sm"></i>
        Legenda</button>
    </div>
    <div class="col-3" style="text-align-last: center;">
      <select class="form-select theme-color-dark col-2" v-model="selectedApartment" id="apartDD"
        aria-label="Odabir apartmana">
        <option value="0" disabled selected>Odaberite apartman</option>
        <option v-for="apartment in apartments" :key="apartment.id" :value="apartment.id" apart-id="apartment.id">
          {{ apartment.apartmentName }}
        </option>
      </select>
    </div>
  </div>
  <div>
    <FullCalendar :options="calendarPlugins" />
  </div>

  <!-- Modal za legendu kalendara -->
  <div class="modal" tabindex="-1" id="modalLegend">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Legenda</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <i class="fa-solid fa-circle mt-3 mb-3" style="color: #FF385C;"></i><label>&nbsp;Rezervacije sa
            Airbnb-a</label><br>
          <i class="fa-solid fa-circle mb-3" style="color: #0057b8;"></i><label>&nbsp;Rezervacije sa
            Booking-a</label><br>
          <i class="fa-solid fa-circle mb-3" style="color: #4eb3ac;"></i><label>&nbsp;Privatne rezervacije</label><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Kraj modala za legendu -->

  <!-- Informacije o gostu modal -->
  <div class="modal" tabindex="-1" id="guestInfoModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Informacije o gostu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="m-1">
                <label style="font-weight:700;">Apartman:</label>
                <p style="font-size: 14px;">{{ selectedApartment ? apartments.find(apartment => apartment.id ===
          selectedApartment).apartmentName : '' }}</p>
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
  </div>
  <!-- kraj informacija o gostu modal -->
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'
import axios from 'axios';
import { getRelevantEvents } from '@fullcalendar/core/internal'

export default {
  components: { FullCalendar }, // corrected component name
  data() {
    return {
      calendarPlugins: {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, listPlugin],
        // initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,today,next',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek'
        },
        buttonText: {
          today: 'Danas',
          dayGridMonth: 'Mesec',
          timeGridWeek: 'Sedmica',
          // timeGridDay: 'Dan',
        },
        locale: 'sr-latn',
        dayCellContent: this.dayCellContentCallback,

        events: [],
        eventContent: this.renderEventContent,
        eventClick: this.guestInfoModal,
      },

      apartments: [],
      apartID: null,
      selectedApartment: 0,

      reservations: [],

      guestId: null,
      guestFirstName: null,
      guestLastName: null,
      fullPrice: null,
      taxPrice: null,
      guestNumber: null,
      arrivalTime: null,
      guestRegistered: null,
      guestPaid: null,
      guestHasCar: null,
      guestDescription: null,
      reservationSetDay: null,
      startDate: null,
      endDate: null,
    }
  },

  mounted() {
    let th = this;

    this.getApartName();

    $('#apartDD').change(function () {
      const selectedApartment = $(this).val();
      th.getReservations(selectedApartment);
    });
  },

  methods: {
    dayCellContentCallback(arg) {
      const date = arg.date.getDate();
      return {
        html: `
        <div class="custom-date-container">
          <span class="custom-date-num">${date}</span>
          <span class="custom-date-price">$50</span>
        </div>
        `
      }
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

    async getReservations(selectedApartment) {
      let th = this;

      try {
        const response = await axios.post('/kalendar/reservations', { apartID: selectedApartment });
        th.reservations = response.data.map(reservation => {

          let reservationType;

          // Postavite reservationType na osnovu podataka iz baze

          return {
            title: `${reservation.guestFirstName} ${reservation.guestLastName} ${reservation.fullPrice} <i class="fa-solid fa-euro-sign fa-sm"></i>`,
            start: reservation.date_start,
            end: reservation.date_end,
            guestID: reservation.id,
            guestFirstName: reservation.guestFirstName,
            guestLastName: reservation.guestLastName,
            fullPrice: reservation.fullPrice,
            reservationType: reservation.reservationType,
            taxPrice: reservation.taxPrice,
            guestNumber: reservation.guestNumber,
            arrivalTime: reservation.arrivalTime,
            guestRegistered: reservation.guestRegistered,
            guestPaid: reservation.guestPaid,
            guestHasCar: reservation.guestHasCar,
            guestDescription: reservation.guestDescription,
            reservationSetDay: reservation.created_at,
            dateStart: reservation.date_start,
            dateEnd: reservation.date_end,
          };
        });

        th.calendarPlugins.events = th.reservations;
      } catch (error) {
        console.error('Došlo je do greške prilikom dohvatanja naziva apartmana: ', error);
      }
    },

    renderEventContent(arg) {
      this.guestFirstName = arg.event.extendedProps.guestFirstName;
      const reservationType = arg.event.extendedProps.reservationType;
      let color;
      switch (reservationType) {
        case 'airbnb':
          color = '#FF385C'; //Roze Airbnb
          break;
        case 'booking':
          color = '#0057b8'; //Plava Booking.com
          break;
        case 'private':
          color = '#4eb3ac'; //Zelena privatne rezervacije
          break;
        default:
          color = '#000000';
          break;
      }

      return {
        html: `
        <div style="background-color: ${color};">${arg.event.title}</div>
      `
      };
    },

    guestInfoModal(clickedEventInfo) {
      const event = clickedEventInfo.event;
      this.guestId = event.extendedProps.guestID;
      this.guestFirstName = event.extendedProps.guestFirstName;
      this.guestLastName = event.extendedProps.guestLastName;
      this.fullPrice = event.extendedProps.fullPrice;
      this.taxPrice = event.extendedProps.taxPrice;
      this.guestNumber = event.extendedProps.guestNumber;
      this.arrivalTime = event.extendedProps.arrivalTime;
      this.guestRegistered = event.extendedProps.guestRegistered;
      this.guestPaid = event.extendedProps.guestPaid;
      this.guestHasCar = event.extendedProps.guestHasCar;
      this.guestDescription = event.extendedProps.guestDescription;
      this.reservationSetDay = this.formatDate(event.extendedProps.reservationSetDay);
      this.startDate = this.formatDate(event.extendedProps.dateStart);
      this.endDate = this.formatDate(event.extendedProps.dateEnd);
      $('#guestInfoModal').modal('show')
    },

    formatDate(dateString) {
      const date = new Date(dateString);
      const day = date.getDate();
      const month = date.getMonth() + 1;
      const year = date.getFullYear();
      return `${day < 10 ? '0' + day : day}.${month < 10 ? '0' + month : month}.${year}`;
    },

    guestRegisteredChange(clickedEventInfo) {
      let th = this;
      if (th.guestRegistered == 0) {
        th.guestRegistered = 1;
      }
      else {
        th.guestRegistered = 0;
      }

      const guestRegisteredUpdateData = {
        id: th.guestId,
        guestRegistered: th.guestRegistered,
      }
      axios
        .post('/kalendar/updateGuestRegistered', guestRegisteredUpdateData, {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        }).then((response) => {

        }).catch((error) => {
          console.error(error);
        });
    },

    guestPaidChange() {
      let th = this;
      if (this.guestPaid == 0) {
        this.guestPaid = 1
      }
      else {
        this.guestPaid = 0
      }

      const guestPaidUpdateData = {
        id: th.guestId,
        guestPaid: th.guestPaid,
      }
      axios
        .post('/kalendar/updateGuestPaid', guestPaidUpdateData, {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        }).then((response) => {

        }).catch((error) => {
          console.error(error);
        });
    },

    guestHasCarChange() {
      let th = this;
      if (this.guestHasCar == 0) {
        this.guestHasCar = 1
      }
      else {
        this.guestHasCar = 0
      }

      const guestHasCarUpdateData = {
        id: th.guestId,
        guestHasCar: th.guestHasCar,
      }
      axios
        .post('/kalendar/updateGuestHasCar', guestHasCarUpdateData, {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        }).then((response) => {

        }).catch((error) => {
          console.error(error);
        });
    }

  },
}
</script>

<style>
.custom-date-container {
  position: relative;
}

.custom-date-price {
  position: absolute;
  bottom: 0;
  right: 15px;
  top: 130px;
}


.custom-date-num {
  margin-bottom: 10px;
  margin-right: 15px;
  font-size: 25px;
}


.fc {
  height: 1200px;
}

.fc-toolbar-title {
  text-transform: uppercase;
}

.fc-col-header-cell-cushion {
  text-transform: lowercase;
  color: rgb(33 37 41);
}

.fc-col-header-cell-cushion::first-letter {
  text-transform: uppercase;
}

.fc-daygrid-day-number {
  color: rgb(33 37 41);
}

.fc-timegrid-slot-label-cushion {
  color: rgb(33 37 41);
}

/* .fc-toolbar-title {
  color: #4eb3ac;
} */

:root {
  --fc-button-text-color: #4eb3ac;
  --fc-button-bg-color: rgb(33 37 41);
  --fc-button-border-color: rgb(33 37 41);
  --fc-button-hover-bg-color: #1e2b37;
  --fc-button-hover-border-color: #1a252f;
  --fc-button-active-bg-color: #1a252f;
  --fc-button-active-border-color: #151e27;
  /* --fc-border-color: #D3D3D3; ovo ce biti moja okvira kalendara*/
  --fc-border-color: gray;
}

.theme-color-dark {
  background-color: rgb(33 37 41);
  color: #4eb3ac;
}

.theme-color-green {
  margin-right: 3px;
  border-color: #4eb3ac;
  background-color: #4eb3ac;
  color: white;
}

.theme-color-green:hover {
  background-color: #215c58;
  border-color: #215c58;
}

/* ovo je eventualna stilizacija za buttone
 :root {
  --fc-button-text-color: black;
  --fc-button-bg-color: white;
  --fc-button-border-color: #4eb3ac;
  --fc-button-hover-bg-color: #4eb3ac;
  --fc-button-hover-border-color: #4eb3ac;
  --fc-button-active-bg-color: #4eb3ac;
  --fc-button-active-border-color: #4eb3ac;
}


.fc-prev-button,
.fc-today-button,
.fc-next-button {
  color: var(--fc-button-text-color);
  background-color: var(--fc-button-bg-color);
  border: 1px solid var(--fc-button-border-color);
}

.fc-prev-button:hover,
.fc-today-button:hover,
.fc-next-button:hover {
  color: white; 
  background-color: var(--fc-button-hover-bg-color);
  border-color: var(--fc-button-hover-border-color);
}

.fc-prev-button:active,
.fc-today-button:active,
.fc-next-button:active {
  background-color: var(--fc-button-active-bg-color);
  border-color: var(--fc-button-active-border-color);
} */
</style>
