// DATA_TEMPLATE: empty_table
oTest.fnStart( "sPaginationType" );

$(document).ready( function () {
	/* Check the default */
	var oTable = $('#example').dataTable( {
		"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php"
	} );
	var oSettings = oTable.fnSettings();
	
	oTest.fnWaitTest( 
		"Check two button paging is the default",
		null,
		function () { return oSettings.sPaginationType == "two_button"; }
	);
	
	oTest.fnWaitTest( 
		"Check class is applied",
		null,
		function () { return $('#example_paginate').hasClass('paging_two_button'); }
	);
	
	oTest.fnWaitTest( 
		"Two A elements are in the wrapper",
		null,
		function () { return $('#example_paginate a').length == 2; }
	);
	
	oTest.fnWaitTest( 
		"We have the previous button",
		null,
		function () { return document.getElementById('example_previous'); }
	);
	
	oTest.fnWaitTest( 
		"We have the next button",
		null,
		function () { return document.getElementById('example_next'); }
	);
	
	oTest.fnWaitTest( 
		"Previous button is disabled",
		null,
		function () { return $('#example_previous').hasClass('paginate_disabled_previous'); }
	);
	
	oTest.fnWaitTest( 
		"Next button is enabled",
		null,
		function () { return $('#example_next').hasClass('paginate_enabled_next'); }
	);
	
	/* Don't test paging - that's done by the zero config test script. */
	
	
	/* Two buttons paging */
	var bComplete = false;
	oTest.fnWaitTest( 
		"Can enabled full numbers paging",
		function () {
			oSession.fnRestore();
			oTable = $('#example').dataTable( {
				"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php",
				"sPaginationType": "full_numbers",
				"fnInitComplete": function () {
					setTimeout( function () {
						bComplete = true;
					}, 500 );
				}
			} );
			oSettings = oTable.fnSettings();
		},
		function () {
			if ( bComplete )
				return oSettings.sPaginationType == "full_numbers";
			else
				return false;
		}
	);
	
	oTest.fnWaitTest( 
		"Check full numbers class is applied",
		nul