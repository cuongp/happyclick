<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
global $wpdb;
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */

	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */

	 /* PNGHAI customize from http://datatables.net/release-datatables/examples/data_sources/server_side.html*/
	$aColumns = array( 'sID', 'sUser', 'sTitle', 'sCreateDate','sPayDate', 'sPayType','sPayStatus' );
	$real_aColumns = array( 'ussk.ID', 'ng.user_login', 'sk.post_title', 'ussk.created_at','ussk.payment_at', 'ussk.payment_type','ussk.payment_status' );
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "ussk.ID";

	/*
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}


	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}

		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
		//default order is sort by ussk.ID
			$sOrder = "ORDER BY ussk.ID DESC";
		}
	}


	/*
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$value=mysql_real_escape_string( $_GET['sSearch'] );
		$sWhere = "WHERE (";
		//template $sWhere .= $real_aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			switch ($aColumns[$i]) {
			//block global on these field or install custom search here
					case "sCreateDate":
					case "sPayDate":
//						$value = date('U', mktime(0, 0, 0, substr($value, 3, 2), substr($value, 0, 2), substr($value, 6, 4)));
//						$sWhere .= $real_aColumns[$i]." LIKE '%".."%' OR ";
						break;
					case "sPayType":
//						if ($value=='Thanh toán trực tiếp tại văn phòng') $value=0;
//						if ($value=='Thanh toán chuyển khoản') $value=1;
						break;
					case "sPayStatus":
//						$row[] = ($aRow[$aColumns[$i]]=="0")?'Chưa thanh toán':'Đã thanh toán';
						break;
					default :
						$sWhere .= $real_aColumns[$i]." LIKE '%".$value."%' OR ";
			}

		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}

	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $real_aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}

	$sTable=$wpdb->prefix."user_sukien ussk JOIN $wpdb->users ng ON ussk.user_id = ng.ID JOIN $wpdb->posts as sk ON ussk.sukien_id = sk.ID";
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "SELECT
				ussk.ID as sID,
				ng.user_login as sUser,
				sk.post_title as sTitle,
				ussk.created_at as sCreateDate,
				ussk.payment_at as sPayDate,
				ussk.payment_type as sPayType,
				ussk.payment_status as sPayStatus
			FROM $sTable
			$sWhere
			$sOrder
			$sLimit
		";
	/* WP-Database connection information */
	//pnghai: prepare() to avoid sql injection
	// ARRAY_A mean numerically indexed array
     $rResult = $wpdb->get_results($sQuery,ARRAY_A );
	/* Data set length after filtering */
	//count here
	$sQuery = "SELECT COUNT(".$sIndexColumn.")
			FROM $sTable
			$sWhere
			$sLimit
	";
	$iFilteredTotal = $wpdb->get_var($sQuery);

	/* Total data set length */
	$sQuery = "SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$iTotal = $wpdb->get_var($sQuery);

	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"sDebugMessage" => "",
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);

	if(!empty($rResult)){
		foreach ($rResult as $aRow) {
			$row = array();
			for ( $i=0 ; $i<count($aColumns); $i++ ) {
				switch ($aColumns[$i]) {
					case "sCreateDate":
						$row[] = date('d-m-Y', $aRow[$aColumns[$i]]);
						break;
					case "sPayDate":
						$row[] = ($aRow[$aColumns[$i]]=="0")?"Chưa thanh toán":date('d-m-Y', $aRow[$aColumns[$i]]);
						break;
					case "sPayType":
						$row[] = ($aRow[$aColumns[$i]]=="0")?'Thanh toán trực tiếp tại văn phòng':'Thanh toán chuyển khoản';
						break;
					case "sPayStatus":
						$row[] = ($aRow[$aColumns[$i]]=="0")?'Chưa thanh toán':'Đã thanh toán';
						break;
					default :
						$row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row;
		}
	}
	echo json_encode( $output );
?> 
