// DATA_TEMPLATE: empty_table
/*
 * NOTE: There are some differences in this zero config script for server-side
 * processing compared to the other data sources. The main reason for this is the
 * difference in how the server-side processing does it's filtering. Also the
 * sorting state is always reset on each draw.
 */
oTest.fnStart( "Sanity checks for DataTables with data from JS" );

oTest.fnWaitTest( 
	"jQuery.dataTable function",
	null,
	function () { return typeof jQuery().dataTable == "function"; }
);

oTest.fnWaitTest(
	"jQuery.dataTableSettings storage array",
	null,
	function () { return typeof jQuery().dataTableSettings == "object"; }
);

oTest.fnWaitTest(
	"jQuery.dataTableExt plugin object",
	null,
	function () { return typeof jQuery().dataTableExt == "object"; }
);

$(document).ready( function () {
	$('#example').dataTable( {
		"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php"
	} );
	
	/* Basic checks */
	oTest.fnWaitTest( 
		"Length changing div exists",
		null,
		function () { return document.getElementById('example_length') != null; }
	);
	
	oTest.fnWaitTest( 
		"Filtering div exists",
		null,
		function () { return document.getElementById('example_filter') != null; }
	);
	
	oTest.fnWaitTest( 
		"Information div exists",
		null,
		function () { return document.getElementById('example_info') != null; }
	);
	
	oTest.fnWaitTest( 
		"Pagination div exists",
		null,
		function () { return document.getElementById('example_paginate') != null; }
	);
	
	oTest.fnWaitTest( 