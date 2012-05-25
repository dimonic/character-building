/*========================================*/
/* A Date Last Modified script            */
/* Original found on the Net              */
/* Modified by H Patterson                */
/* hpttrsn@daisy.freeserve.co.uk          */
/*========================================*/
     
updated = new Date(document.lastModified);
day = updated.getDate();
month = updated.getMonth() + 1;
year = updated.getYear();
duffix = "th";
century=20;
yleading="";
if (year >99)(year = year - 100);
if (year >1000) (year = year - 1900);
if (month == 1)(monthcal = "January");
if (month == 2)(monthcal = "February");
if (month == 3)(monthcal = "March");
if (month == 4)(monthcal = "April");
if (month == 5)(monthcal = "May");
if (month == 6)(monthcal = "June");
if (month == 7)(monthcal = "July");
if (month == 8)(monthcal = "August");
if (month == 9)(monthcal = "September");
if (month == 10)(monthcal = "October");
if (month == 11)(monthcal = "November");
if (month == 12)(monthcal = "December");
if (day == 2 || day == 22)(duffix = "nd");
if (day == 1 || day == 21 || day == 31)(duffix = "st");
if (day == 3 || day == 23)(duffix = "rd");
if (year<10)(yleading="0");
document.write("Last Update on " + day + duffix + " " + monthcal + " " + century + yleading + year);