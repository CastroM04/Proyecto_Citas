const currentDate = document.querySelector(".current-date");
const daysTag = document.querySelector(".days");
const prevNextIcon = document.querySelectorAll(".icons span");

let date = new Date();
let currYear = date.getFullYear();
let currMonth = date.getMonth();

const months = [
  "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
  "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];

const renderCalendar = () => {
  let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(); // primer día del mes
  let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
  let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();
  let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
  let liTag = "";

  for (let i = firstDayofMonth; i > 0; i--) {
    liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    let isToday =
      i === date.getDate() &&
      currMonth === new Date().getMonth() &&
      currYear == new Date().getFullYear()
        ? "active"
        : "";

 

    liTag += `<li class="${isToday}">${i}</li>`;
  }

  for (let i = lastDayofMonth; i < 6; i++) {
    liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
  }

  currentDate.innerText = `${months[currMonth]} ${currYear}`; // Mes y año del calendario
  daysTag.innerHTML = liTag;
};

renderCalendar();


prevNextIcon.forEach(icon => {
    icon.addEventListener("click", () => { //evento para los botones de cambiar el mes

        mes = date.getMonth();

        if (mes == currMonth) {
            currMonth = icon.id === "prev" ? currMonth - 0 : currMonth + 1;
            renderCalendar();
        } else {
            currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;
            renderCalendar();
        }

        if (currMonth < 0 || currMonth > 11) { // agregar los demas años
            date = new Date(currYear, currMonth); //actualñzar fecha
            currYear = date.getFullYear(); //actualizar año
            currMonth = date.getMonth(); //actualizar meses
        } else {
            date = new Date(); //si se encuentra dentro del mismo año
        }
        renderCalendar();

    });
});
