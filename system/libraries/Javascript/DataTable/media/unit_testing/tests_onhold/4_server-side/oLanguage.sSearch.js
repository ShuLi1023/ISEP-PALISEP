// DATA_TEMPLATE: empty_table
oTest.fnStart( "sDom" );

/* This is going to be brutal on the browser! There is a lot that can be tested here... */

$(document).ready( function () {
	/* Check the default */
	var oTable = $('#example').dataTable( {
		"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php"
	} );
	var oSettings = oTable.fnSettings();
	
	oTest.fnWaitTest( 
		"Default DOM varaible",
		null,
		function () { return oSettings.sDom == "lfrtip"; }
	);
	
	oTest.fnWaitTest( 
		"Default DOM in document",
		null,
		function () {
			var nNodes = $('#demo div, #demo table');
			var nWrapper = document.getElementById('example_wrapper');
			var nLength = document.getElementById('example_length');
			var nFilter = document.getElementById('example_filter');
			var nInfo = document.getElementById('example_info');
			var nPaging = document.getElementById('example_paginate');
			var nTable = document.getElementById('example');
			
			var bReturn = 
				nNodes[0] == nWrapper &&
				nNodes[1] == nLength &&
				nNodes[2] == nFilter &&
				nNodes[3] == nTable &&
				nNodes[4] == nInfo &&
				nNodes[5] == nPaging;
			return bReturn;
		}
	);
	
	oTest.fnWaitTest( 
		"Check example 1 in code propagates",
		function () {
			oSession.fnRestore();
			oTable = $('#example').dataTable( {
				"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php",
				"sDom": '<"wrapper"flipt>'
			} );
			oSettings = oTable.fnSettings();
		},
		function () { return oSettings.sDom == '<"wrapper"flipt>'; }
	);
	
	oTest.fnWaitTest( 
		"Check example 1 in DOM",
		null,
		function () {
			var jqNodes = $('#demo div, #demo table');
			var nNodes = [];
			
			/* Strip the paging nodes */
			for ( var i=0, iLen=jqNodes.length ; i<iLen ; i++ )
			{
				if ( jqN