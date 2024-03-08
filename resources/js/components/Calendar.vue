<!-- <script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth'
      }
      
    }
  }
}
</script>
<template>
  <FullCalendar :options="calendarOptions" class="custom-calendar" />
</template>
<style>
/* calendarStyles.css */
.custom-calendar {
  border: 1px solid black;
}

/* calendarStyles.css */
.fc-daygrid-day {
  border: 1px solid black !important; /* Set cell borders to black */
  background-color: lightpink !important; /* Set background color to light pink */
}

.fc-daygrid-day-top,
.fc-daygrid-day-number {
  color: green !important; /* Set text and numbers color to green */
}

/* Add more custom styles as needed */

</style> -->
<template>
    <div ref="calendar"></div>
  </template>
<script>
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid'; // Import dayGrid plugin
import bootstrap5Plugin from '@fullcalendar/bootstrap5';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-icons/font/bootstrap-icons.css';

export default {
  data() {
    return {
      isMounted: false // Track mounted status
    };
  },
  mounted() {
    this.isMounted = true; // Set mounted status to true
    this.initCalendar();
  },
  methods: {
    initCalendar() {
      // Ensure element is connected before initializing the calendar
      if (!this.isMounted) return;

      const calendarEl = this.$refs.calendar;
      const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, bootstrap5Plugin], // Include dayGridPlugin here
        initialView: 'dayGridMonth',
        // Other calendar options
      });
      calendar.render();
    }
  }
}
</script>



  
  