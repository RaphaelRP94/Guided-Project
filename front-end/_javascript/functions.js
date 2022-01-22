//This function changes the picture that stay close to the main menu

function mudaFoto(foto) {
    document.getElementById("icone").src = foto;
}



//I did not manage to create a code that prented the customer from pic a sunday so I used a framework called JQuery and a date time picker called Flatpickr
$("#date1").flatpickr({
  enableTime: true,
  dateFormat: "Y-m-d",
  "disable": [
      function(date) {
          return (date.getDay() === 0);  // disable sundays
      }
  ],
  "locale": {
      "firstDayOfWeek": 1 // set start day of week to Monday
  }
  });



// I created this function to put an "invisible" form in the page and turn it into visible when the user clicks.
  
function deleteB() {
  setTimeout(() => {
    document.getElementById('fContato').style.display = 'block';
  }, 500);
};

document.getElementById('delete_booking').addEventListener('click', deleteB);



// I am using this function to allow Ger to print only main information from a specific page

function printPageArea(areaID){
  var printContent = document.getElementById(areaID);
  var WinPrint = window.open('', '', 'width=900,height=650');
  WinPrint.document.write(printContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
}