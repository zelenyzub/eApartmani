<template>
  <div class="row mt-3 mb-5">
    <div class="col-6"></div>
    <div class="col-6 d-flex justify-content-end">
      <div class="dropdown">
        <button type="button" class="btn btn-primary theme-color-green"><i class="fa-solid fa-info fa-sm"></i>  Legenda</button>
        <button class="btn btn-secondary dropdown-toggle theme-color-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Odabir apartmana
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div>
      <FullCalendar
        :options="calendarPlugins"
      />
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'

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
    }
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
  right: 10px;
  top:150px;
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
  --fc-border-color: #4eb3ac;
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





