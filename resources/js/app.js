const datepicker = document.getElementById("datepicker");
const datepickerContainer = document.getElementById(
  "datepicker-container",
);
const daysContainer = document.getElementById("days-container");
const currentMonthElement = document.getElementById("currentMonth");
const prevMonthButton = document.getElementById("prevMonth");
const nextMonthButton = document.getElementById("nextMonth");
const cancelButton = document.getElementById("cancelButton");
const applyButton = document.getElementById("applyButton");
const toggleDatepicker = document.getElementById("toggleDatepicker");

let currentDate = new Date();
let selectedStartDate = null;
let selectedEndDate = null;

// Function to render the calendar
function renderCalendar() {
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();

  currentMonthElement.textContent = currentDate.toLocaleDateString(
    "en-US",
    { month: "long", year: "numeric" },
  );

  daysContainer.innerHTML = "";
  const firstDayOfMonth = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  for (let i = 0; i < firstDayOfMonth; i++) {
    daysContainer.innerHTML += `<div></div>`;
  }

  for (let i = 1; i <= daysInMonth; i++) {
    const day = new Date(year, month, i);
    const dayString = day.toLocaleDateString("en-US");

    let className =
      "flex items-center justify-center cursor-pointer w-[46px] h-[46px] rounded-full text-dark-3 dark:text-dark-6 hover:bg-primary hover:text-white";

    // Highlight start and end dates
    if (selectedStartDate && dayString === selectedStartDate) {
      className +=
        " bg-primary text-white dark:text-white rounded-r-none";
    }
    if (selectedEndDate && dayString === selectedEndDate) {
      className +=
        " bg-primary text-white dark:text-white rounded-l-none";
    }

    // Highlight dates between start and end
    if (
      selectedStartDate &&
      selectedEndDate &&
      new Date(day) > new Date(selectedStartDate) &&
      new Date(day) < new Date(selectedEndDate)
    ) {
      className += " bg-dark-3 text-white rounded-none"; // Add your custom class for the range
    }

    daysContainer.innerHTML += `<div class="${className}" data-date="${dayString}">${i}</div>`;
  }

  document.querySelectorAll("#days-container div").forEach((day) => {
    day.addEventListener("click", function (event) {
      event.stopPropagation(); // Prevent event from bubbling up to document

      const selectedDay = this.dataset.date;

      if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
        selectedStartDate = selectedDay;
        selectedEndDate = null;
      } else {
        if (new Date(selectedDay) < new Date(selectedStartDate)) {
          selectedEndDate = selectedStartDate;
          selectedStartDate = selectedDay;
        } else {
          selectedEndDate = selectedDay;
        }
      }

      updateInput();
      renderCalendar(); // Re-render calendar to update highlighted range
    });
  });
}

// Function to update the datepicker input
function updateInput() {
  if (selectedStartDate && selectedEndDate) {
    datepicker.value = `${selectedStartDate} - ${selectedEndDate}`;
  } else if (selectedStartDate) {
    datepicker.value = selectedStartDate;
  } else {
    datepicker.value = "";
  }
}

// Toggle datepicker visibility
datepicker.addEventListener("click", function (event) {
  event.stopPropagation(); // Prevent click from bubbling up to document
  datepickerContainer.classList.toggle("hidden");
  renderCalendar();
});

toggleDatepicker.addEventListener("click", function (event) {
  event.stopPropagation(); // Prevent click from bubbling up to document
  datepickerContainer.classList.toggle("hidden");
  renderCalendar();
});

// Navigate months
prevMonthButton.addEventListener("click", function () {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
});

nextMonthButton.addEventListener("click", function () {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
});

// Cancel selection and close calendar
cancelButton.addEventListener("click", function () {
  selectedStartDate = null;
  selectedEndDate = null;
  updateInput();
  datepickerContainer.classList.add("hidden");
});

// Apply selection and close calendar
applyButton.addEventListener("click", function () {
  updateInput();
  datepickerContainer.classList.add("hidden");
});

// Close calendar when clicking outside of it
document.addEventListener("click", function (event) {
  if (
    !datepicker.contains(event.target) &&
    !datepickerContainer.contains(event.target)
  ) {
    datepickerContainer.classList.add("hidden");
  }
});