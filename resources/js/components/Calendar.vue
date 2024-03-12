<template>
  <div class="row mt-3 mb-5 d-flex justify-content-end">
    <div class="col-6">
      <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">Kalendar</li>
            <li class="breadcrumb-item active">{{ selectedApartment ? apartments.find(apartment => apartment.id === selectedApartment).apartmentName : '' }}</li>
        </ol>
    </div>
    <div class="col-3 d-flex justify-content-end">
      <button type="button" id="btnLegenda" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#modalLegend"><i class="fa-solid fa-info fa-sm"></i>
        Legenda</button>
    </div>
    <div class="col-3" style="text-align-last: center;">
      <select class="form-select theme-color-dark col-2" v-model="selectedApartment" aria-label="Odabir apartmana">
        <option value="0" disabled selected>Odaberite apartman</option>
        <option v-for="apartment in apartments" :key="apartment.id" :value="apartment.id">
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
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Kraj modala za legendu -->
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'
import axios from 'axios';

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

        events: [
          { // this object will be "parsed" into an Event Object
            title: 'The Title', // a property!
            start: '2024-01-01', // a property!
            end: '2024-01-01' // a property! ** see important note below about 'end' **
          }
        ]
      },

      apartments: [],
      selectedApartment: 0
    }
  },

  mounted() {
    this.getApartName();
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
  top: 140px;
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
