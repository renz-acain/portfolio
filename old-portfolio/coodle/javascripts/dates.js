
    //==== Create a date object ====
    var now = new Date();
    var dayNames = new Array("Sun",
                             "Mon",
                             "Tue",
                             "Wed",
                             "Thu",
                             "Fri",
                             "Sat");
    var monthNames = new Array("Jan",
                               "Feb",
                               "Mar",
                               "Apr",
                               "May",
                               "Jun",
                               "Jul",
                               "Aug",
                               "Sep",
                               "Oct",
                               "Nov",
                               "Dec");
    //==== Use the date object's methods extract info held within it ====
    var year  = now.getFullYear();
    var date  = now.getDate();
    var month = now.getMonth();
    var day   = now.getDay();
    
  
    //==== calculation of tomorrow
    var tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
	var tomDay = tomorrow.getDay();
	var tomDate = tomorrow.getDate();
	var tomMonth = tomorrow.getMonth();
	var tomYear = tomorrow.getFullYear();
	
  //==== calculation of the day after tomorrow

	var next = new Date(tomorrow.getTime() + 24 * 60 * 60 * 1000);
	var nDay = next.getDay();
	var nDate = next.getDate();
	var nMonth = next.getMonth();
	var nYear = next.getFullYear();
  


    //==== Display end of JavaScript message - useful for debugging purposes

   
