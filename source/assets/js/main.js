var d = new Date();
var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var today = days[d.getDay()];
var date = d.getDate();
var year = d.getFullYear();
var month = months[d.getMonth()];
var rank='';

if(d.getDate() === 1){
  rank = 'st';
} else if(d.getDate() === 3){
  rank='rd';
} else if(d.getDate() === 2){
  rank = 'nd';
} else {
  rank = 'th';
}

document.getElementById('day_today').innerHTML = today+ ',';
document.getElementById('date_today').innerHTML = date + rank;
document.getElementById('month_today').innerHTML = month;
document.getElementById('year_today').innerHTML = year;