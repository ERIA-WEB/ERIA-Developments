

 $('#fromDate').datepicker({
         dateFormat: 'yy-mm-dd',
        onSelect: function(selected) {
          $("#toDate").datepicker("option","minDate", selected)
        }
    });
    $("#toDate").datepicker({ 
        dateFormat: 'yy-mm-dd', 
        onSelect: function(selected) {
           $("#fromDate").datepicker("option","maxDate", selected)
        }
    });  
 




 $(".datepicker").datepicker({ 
         
      dateFormat: 'yy-mm-dd',
    });  



 $("#indate").datepicker({ 
         
      dateFormat: 'yy-mm-dd',
    });  







 $('#fromMonth').datepicker({
         dateFormat: 'yy-mm',
	  minViewMode: 1,
	// startView: 2,
        onSelect: function(selected) {
         // $("#toMonth").datepicker("option","minDate", selected)
        }
    });
    $("#toMonth").datepicker({ 
        dateFormat: 'yy-mm',
		 minViewMode: 1,
        onSelect: function(selected) {
          // $("#fromMonth").datepicker("option","maxDate", selected)
        }
    });  