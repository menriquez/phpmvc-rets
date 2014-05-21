<?php

include_once('mls/model/pdoConfig.php');
//include_once('mls/model/areazone.php');

// hold the data in this class
class dbRets extends PDOConfig {

  public  $row;
  public  $count;

  public function __construct(){
    parent::__construct( );
  }

  //
  public function getPropertyType () {
  	return $this->row['property_type'];
  }

  public function getPropertyTypeTag () {

		switch ($this->row['property_sub_type']) {
			case "Single Family Detached":
				return "Home";
			break;
			default:
				return $this->row['property_sub_type'];
		}

  }

  public function getAgentId () {
		return $this->row['agent_id'];
  }

  public function getStreetAddress() {
   $str = $this->row['street_number']." ".$this->row['street_dir']." ".$this->row['street_name']." ".$this->row['street_suffix'];
   if ($str=="   ")
   		$str="No Address Found";
   return $str;
  }

  public function getCityStZip() {
   return $this->row['city'].", FL ".$this->row['postal_code'];
  }

  public function getMLS() {
   return $this->row['listing_id'];
  }

  public function getCity() {
   return $this->row['city'];
  }

  public function getBaths() {
   return $this->row['bathrooms'];
  }

  public function getHalfBaths() {
   return $this->row['halfbaths'];
  }

  public function getPrice() {
   return "$".number_format($this->row['listing_price']);
  }

  public function getBeds() {
   return $this->row['bedrooms'];
  }

  public function getShortDesc($inLen=66) {
		return substr($this->row['remarks'],0,$inLen)."...";
  }

  public function getThumbSmallFn() {
		return "photos/thumbs200/".$this->row['listing_id']."-1.jpg";
  }

  public function getThumbFn() {
		return "photos/thumbs/".$this->row['listing_id']."-1.jpg";
  }


  public function getExtFeats() {
		return $this->row['exterior_features'];
  }

  public function getIntFeats() {
		return $this->row['interior_features'];
  }

  public function getEquipApp() {
		return $this->row['equipment_appliances'];
  }

  public function getTaxAmount() {
		return "$".number_format($this->row['tax_amount']);
  }

  public function getHOADues() {
		return "$".number_format($this->row['hoa_dues']);
  }

  // generic data function to grab fields directly
  public function getData($inFld) {
		return str_replace(",",", ",$this->row[$inFld]);
  }

  public function notEmpty($inFld) {
  	if (empty($this->row[$inFld]))
			return false;
		else
			return true;
  }

  // functions to build quicksearch links
  public function getMLSLink() {
  	return "/".$this->getMLS().".mls";
  }

}

// do the sql searching in this class
class dbRetsModel extends dbRets {

  // vars to handle internal row management
  private $rows;
  private $rowIdx;
  private $stm;
  private $vars;
  private $paging;

  // search fields
  private $mls_id;
  private $property_type;
  private $property_subtype;
  private $agent_id;
  private $city;
  private $subdiv;
  private $cityname;
  private $date_from;
 	private $tag;

  public function __construct(){
    parent::__construct( );
  }

  // the search "title" is at the search level, not row level
  public function getDisplayTitle () {

  	if (!(isset($_GET['page']))) {
  		if ($this->tag=="")
  			return $this->count." ".$this->getPropertyTypeTag()." Listings for ".$this->cityname;
  		else
  			return $this->count." ".$this->tag." ".$this->getPropertyTypeTag()." Listings for ".$this->cityname;
		}
		else {
			switch ($_GET['page']) {

				case 2:
					$tag.=" 251 - 500";
					break;
				case 3:
					$tag.=" 501 - 750";
					break;
				case 4:
					$tag.=" 751 - 1000";
					break;
				case 5:
					$tag.=" 1001 - 1250";
					break;

				// add more if needed...

			}
			return "Showing $tag of $this->count ".$this->getPropertyTypeTag()." Listings for ".$this->cityname;
		}
  }

  // set functions for searches
  public function setPropertyType ($inStg) {
  	$this->property_type=PDO::quote($inStg);
  }

  public function setPropertySubType ($inStg) {
  	$this->property_subtype=PDO::quote($inStg);
  }

  public function setAgentId ($inStg) {
  	$this->agent_id=PDO::quote($inStg);
  }

  public function setMLS ($inStg) {
  	$this->mls_id=PDO::quote($inStg);
	}

  public function setArea ($inStg) {
  	if ($inStg=="today" || $inStg=="thisweek") {
			$this->date_from = ($inStg=="today" ? date("Y-m-d", strtotime( '-1 days' )): date("Y-m-d", strtotime( '-7 days' ) ))." 00:00:00";
			return;
  	}
  	if ($inStg=="commercial" ) {
  		$this->setPropertyType("commercial");
  		return;
  	}
  	$area=fixDashes($inStg);
  	if ($this->isCity($area)) {
			$this->city=PDO::quote($area);
		}
		else {
			$this->subdiv=PDO::quote($area);
		}
  }

  /******************************************************************************************************************/
  // start search methods
  /******************************************************************************************************************/
  public function getSingleProperty () {

    // check class data
    if ($this->mls_id == "") {
     throw new Exception("dbRetsSearch :: getProperty :: Invalid mls_id");
    }

    $sql = 'SELECT * FROM master_rets_table
            WHERE listing_id = '.$this->mls_id.'
            ORDER BY listing_price DESC';

    $this->stm = $this->prepare($sql);

    $this->stm->execute();
    $this->rows= $this->stm->fetchAll(PDO::FETCH_ASSOC);
    $this->count = $this->stm->rowCount();
    $this->rowIdx = 0;

    // set row to first
    $this->row=$this->rows[$this->rowIdx++];

  }
  public function getClientSummaryListings () {

    // check class data
    if (($this->property_type == "") || ($this->agent_id == "")) {
     throw new Exception("dbRetsSearch ::getClientSummaryListings :: Invalid property_type or agent_id");
    }

    $sql = 'SELECT * FROM master_rets_table
            WHERE property_type = '.$this->property_type.'  AND agent_id = '.$this->agent_id.'
            ORDER BY listing_price DESC';
    $this->stm = $this->prepare($sql);

    $this->stm->execute();
    $this->rows= $this->stm->fetchAll(PDO::FETCH_ASSOC);
    $this->count = $this->stm->rowCount();
    $this->rowIdx = 0;

    // set row to first
    $this->row=$this->rows[$this->rowIdx++];

  }

  public function getAreaListings () {

    // check class data
    if (($this->city == "") && ($this->subdiv == "") &&
    		($this->date_from == "") && ($this->property_type == "")) {
			throw new Exception("dbRetsSearch:: getAreaListings - empty city, subdiv or starting date for search");
    }

    if ($this->city != "" ) {
	    $sql = 'SELECT * FROM master_rets_table
	            WHERE city = '.$this->city.'
	            ORDER BY listing_price DESC';
		}
		else if ($this->subdiv != ""){
	    $sql = 'SELECT * FROM master_rets_table
	            WHERE subdivision REGEXP '.$this->subdiv.'
	            ORDER BY listing_price DESC';
		}
		else if ($this->date_from != "") {

	    $sql = "SELECT * FROM master_rets_table WHERE (listing_entry_timestamp > '$this->date_from' ) ORDER BY listing_price DESC";

		}
		else if ($this->property_type != "") {

	    $sql = 'SELECT * FROM master_rets_table
	    				WHERE property_type = '.$this->property_type.'
	    				ORDER BY listing_price DESC ';

		}

    $this->stm = $this->prepare($sql);
		$this->stm->execute();

    $this->rows= $this->stm->fetchAll(PDO::FETCH_ASSOC);
    $this->count = $this->stm->rowCount();
    $this->rowIdx = 0;

    // set row to first
    $this->row=$this->rows[$this->rowIdx++];

  }

  public function getSearchHeaderInfo () {

      // check class data
    $sql = $this->buildQuery(true);

    $this->stm = $this->prepare($sql);

    $this->stm->execute();
    $this->rows= $this->stm->fetchAll(PDO::FETCH_ASSOC);
    $this->rowIdx = 0;

    // set row to first
    $this->row=$this->rows[$this->rowIdx++];
    $this->count = $this->row['cnt'];

	}

  public function getCityDropDownInfo () {

      // check class data
    $sql = "SELECT DISTINCT city FROM master_rets_table where city <> '' AND county_zone <> 'Out of County' ORDER BY city ASC";

    $this->stm = $this->prepare($sql);

    $this->stm->execute();
    foreach ($this->stm->fetchAll(PDO::FETCH_ASSOC) as $row) {
			$retval.="<option value='".str_replace(' ','-',$row['city'])."'> ".$row['city']."</option>";
    }

    return $retval;

	}

  public function doSearch () {

    // check class data
    $sql = $this->buildQuery();

    if (isset($_GET['page'])) {

			// set flag for later use
    	$this->paging=true;

			switch ($_GET['page']) {

				case 2:
					$sql.=" LIMIT 250,250";
					break;
				case 3:
					$sql.=" LIMIT 500,250";
					break;
				case 4:
					$sql.=" LIMIT 750,250";
					break;
				case 5:
					$sql.=" LIMIT 1000,250";
					break;

				// add more if needed...

			}

		}
		else
	  	$sql.=" LIMIT 0,250";

    $this->stm = $this->prepare($sql);

    $this->stm->execute();
    $this->rows= $this->stm->fetchAll(PDO::FETCH_ASSOC);
    $this->count = $this->stm->rowCount();
    $this->rowIdx = 0;

    // set row to first
    $this->row=$this->rows[$this->rowIdx++];

  }
  /******************************************************************************************************************/
  // end search methods
  /******************************************************************************************************************/

  public function next() {

    if ($this->rowIdx < $this->count) {
      $this->row=$this->rows[$this->rowIdx++];
      return true;
    }
    else {
      $this->rowIdx=0;
      return false;
    }
	}

	// get all city names in database and check for match
	public function isCity($area) {

		$sql = 'SELECT distinct(city) FROM master_rets_table';
    $stm = $this->prepare($sql);

    $stm->execute();
    $cities= $stm->fetchAll(PDO::FETCH_ASSOC);
    if (in_array(ucwords($area),$cities))
    	return true;
    else
    	return false;

	}

  /******************************************************************************************************************/
	//  in order to save time, i cut-n-pasted this crappy-yet-working SQL logic from dbasile.com - please forgive me - marke
  /******************************************************************************************************************/
	public function buildQuery($countFlag=false) {

		// $this->vars = explode($_GET);

		// grab "tag" string for use in titles/seo
		if (isset($_GET['tag'])) {
		  $this->tag = ucwords(fixDashes($_REQUEST['tag']));
		}

		$area = strtolower($_GET['area']);
		$city_number="";
		$subdiv="";

		switch ($area) {

		  // communities that are treated as cities
		  case "tortoiseisland":
		  case "tortoise-island":
		    $city = $this->cityname = "Tortoise Island";
		    $subdiv = "TORTOISE%";
		  break;

		  case "montecito":
		    $city = $this->cityname = "Montecito";
		    $subdiv = "MONTECITO%";
		  break;

		  case "lansingisland":
		  case "lansing-island":
		    $city=$this->cityname = "Lansing Island";
		    $subdiv = "LANSING%";
		  break;

		  case "canaveral-groves":
		    $this->cityname = "Canaveral Groves";
		    $city_number = '210';
		  break;

		  case "viera":
		    $city = $this->cityname = 'Viera';
		    $city_number = '216|217';
		  break;

		  case "suntree":
		    $this->cityname = 'Suntree';
		    $city_number = '216|218';
		  break;

		  case "port-st.-john":
		  case "port-saint-john":
		    $this->cityname = "Port St. John";
		    $city_number = '107';
		  break;
		  ////////////////////////////////////////////////////////////////////////////////

		  case "cocoabeach":
		  case "cocoa-beach":
		    $city = $this->cityname = "Cocoa Beach";
		  break;

		  case "cocoa":
		    $city = $this->cityname = "Cocoa";
		    // $city_number = '210|212|213|215';
		  break;

		  case "satellitebeach":
		  case "satellite-beach":
		    $city = $this->cityname = "Satellite Beach";
		    // $city_number = '381|382';
		  break;

		  case "merrittisland":
		  case "merritt-island":
		    $city = $this->cityname = "Merritt Island";
		    //$city_number = '250|251|252|253|355';
		  break;

		  case "melbournebeach":
		  case "melbourne-beach":
		    $city = $this->cityname = "Melbourne Beach";
		   // $city_number = '384|385';
		  break;

		  case "indian-harbour-beach":
		  case "indianharbour-beach":
		  case "indian-harbourbeach":
		  case "indianharbourbeach":
		    $city = $this->cityname = "Indian Harbour Beach";
		    //$city_number = '381|382';
		  break;

		  case "indialantic":
		    $city = $this->cityname = "Indialantic";
		   // $city_number = '383|384';
		  break;

		  case "palmbay":
		  case "palm-bay":
		    $city = $this->cityname = "Palm Bay";
		   // $city_number = '347|346|345|344|343|341|340';
		  break;

		  case "ne-palm-bay":
		    $this->cityname = "NE Palm Bay";
		    $city_number = '340|341';
		  break;

		  case "se-palm-bay":
		    $this->cityname = "SE Palm Bay";
		    $city_number = '343|347';
		  break;

		  case "nw-palm-bay":
		    $this->cityname = "NW Palm Bay";
		    $city_number = '344';
		  break;

		  case "sw-palm-bay":
		    $this->cityname = "SW Palm Bay";
		    $city_number = '345|346';
		  break;

		  case "westmelbourne":
		  case "west-melbourne":
		    $city = $this->cityname = "West Melbourne";
		    // $city_number = '331';
		  break;

		  case "melbourne-village":
		    $city = $this->cityname = "Melbourne Village";
		    $city_number = '331';
		  break;

		  case "verobeach":
		  case "vero-beach":
		    $city = $this->cityname = "Vero Beach";
		    $city_number = '904';
		  break;

		  case "capecanaveral":
		  case "cape-canaveral":
		    $city = $this->cityname = "Cape Canaveral";
		    $city_number = '271';
		  break;

		  case "grantvalkaria":
		  case "malabar-grant-valkaria":
		  case "grant-valkaria":
		    $this->cityname = "Grant/Valkaria";
		    $city = "GRANT";
		    $city_number = '342';
		  break;

		  case "barefootbay":
		  case "barefoot-bay":
		    $city = $this->cityname = "Barefoot Bay";
		    $city_number = '350';
		  break;

		  case "mims":
		  case "mims-scottsmoor":
		    $city = "Mims";
		    $this->cityname = 'Mims/Scottsmoor';
		    //$city_number = '101|102';
		  break;

		  case "titusville":
		    $city = $this->cityname = 'Titusville';
		    //$city_number = '101|102|103|104';
		  break;

		  case "cocoa":
		    $city = $this->cityname = 'Cocoa';
		    //$city_number = '212|215|215';
		  break;

		  case "rockledge":
		    $city = $this->cityname = 'Rockledge';
		    //$city_number = '214';
		  break;

		  case "melbourne":
		    $city = $this->cityname = 'Melbourne';
		    //$city_number = '320|321|323|330';
		  break;

		  default:
		  	$this->cityname = 'All Brevard County';


		} // end city switch

		// process the multi-areacode strings in the multi-city selection
		if(strstr($city_number, "|")) {
		  $listingAreas = explode("|",$city_number);

		  // process multi-area code for each city selected
		  foreach($listingAreas as $listingArea)
		  {
		    $sql_or[] = "`listing_area` LIKE '$listingArea%'";
		  }

		}
		else {
		  if ($city_number != "")
		    $sql_or[] = "listing_area LIKE '$city_number%'";
		}



		// process the subdivions if needed
		if (!empty($subdiv))
		  $sql_or[] = "subdivision LIKE '%$subdiv%'";

		// throw city into the search becuz sometimes the data has a blank listing_area....sigh - marke
		if (!empty($city))
		  $sql_or[] = "city = '$city'";

		// save city names for display on page
		//$city_display[]= $this->cityname;

		// create multi-city OR sql statement...implode() magic - marke
		if (!empty($sql_or))
			$orsql = '('.implode(" OR ", $sql_or).')';

		$isComm=NULL;
		$this->setPropertyType($_REQUEST['proptype']);
		switch (strtolower($_REQUEST['proptype'])) {

		  // kludge-y way to deal with property_type search - ugh sorry
		  case "home":
		  case "homes":
		  case "single-family-detached":
		    $type = "property_type='residential' AND property_sub_type = 'Single Family Detached'";
		    $isComm = false;
		  break;

		  case "rental":
		  case "rentals":
		    $type = "property_type='rental'";
		  break;

		  case "townhome":
		  case "townhomes":
		  case "townhouses":
		    $type = "property_type='residential' AND property_sub_type='townhouse'";
		  break;

		  case "condo":
		  case "condos":
		    $type = "property_type='residential' AND (property_sub_type='Condo' OR property_sub_type='Condo-Tel')";
		  break;

		  case "industrial":
		    $type = "property_type='commercial' AND property_sub_type='industrial' ";
		  break;

		  case "commercial":
		    $type = "property_type='commercial' AND property_sub_type='commercial' ";
		    if (isset($srch) && $srch=="sale")
    			$isComm = true;
		  break;

		  case "vacantland":
		    $type = "property_type='vacantland'";
		  break;

		  case "listings":
		  default:
		  	// $type="";
		  break;
		} // end proptype switch

		$sql_addition = array();
		if ($type!=NULL)
			$sql_addition[] = $type;

		// quickie hack to filter commercial prop searches by sale or lease
		if (!empty($_GET['id'])) {
		  $sql_addition[] = " listing_id = '$_GET[id]' ";
		}

		// quickie hack to filter commercial prop searches by sale or lease
		if (!empty($_GET['srch'])) {
		  $sql_addition[] = " sale_lease = '$srch' ";
		}

		if(!empty($_GET['price_from'])) {
			$price_from = $_GET['price_from'];
			$sql_addition[] = " listing_price >= $price_from ";
		}

		if(!empty($_GET['price_to'])) {
			$price_to = $_GET['price_to'];
			$sql_addition[] = " listing_price <= $price_to ";
		}

		if(!empty($_GET['bedrooms_from'])) {
			$bedrooms_from = $_GET['bedrooms_from'];
		  $sql_addition[] = " bedrooms >=$bedrooms_from ";
		}

		if(!empty($_GET['bedrooms_to'])) {
			$bedrooms_to= $_GET['bedrooms_to'];
		  $sql_addition[] = " bedrooms <=$bedrooms_to ";
		}

		if(!empty($_GET['bathrooms_from'])) {
			$bathrooms_from = $_GET['bathrooms_from'];
		  $sql_addition[] = " bathrooms >=$bathrooms_from ";
		}

		if(!empty($_GET['bathrooms_to'])) {
			$bathrooms_to = $_GET['bathrooms_to'];
		  $sql_addition[] = " bathrooms <=$bathrooms_to ";
		}

		/* FOOTAGE */
		if(!empty($_GET['footage_from'])) {
			$footage_from = $_GET['footage_from'];
		  $sql_addition[] = " square_footage >=$footage_from ";
		}

		if(!empty($_GET['footage_to'])) {
			$footage_to  = $_GET['footage_to'];
		  $sql_addition[] = " square_footage <=$footage_to ";
		}

		if(!empty($_GET['dwelling'])) {
			$dwelling = $_GET['dwelling'];
		  $sql_addition[] = " dwelling_view LIKE '%$dwelling%' ";
		}

		if(!empty($_GET['year_from'])) {
			$year_from = $_GET['year_from'];
		  $sql_addition[] = "year_built >= $year_from";
		}

		if(!empty($_GET['year_to'])) {
			$year_to = $_GET['year_to'];
		  $sql_addition[] = "year_built <=$year_to";
		}

		if(!empty($_GET['pool'])) {
			$pool = $_GET['pool'];
		  if ($pool=="Yes") {
		  	$sql_addition[] = " pool <> 'None' AND pool <> '' ";
		  } else if ($pool=="No") {
		  	$sql_addition[] = " pool = 'None' OR pool = '' ";
		  }
		}

		if(!empty($_GET['over55'])) {
			$adult_community = $_GET['over55'];
		  $sql_addition[] = " over_55='$adult_community' ";
		}

		/* FORECLOSURE */
		if(!empty($foreclosure)) {
		  if($foreclosure == "yes") {
		    $sql_addition[] = "(property_status='Short Sale' OR property_status='Bank Owned')";
		  }
		  else if($foreclosure == "no") {
		    $sql_addition[] = "(property_status != 'Short Sale' AND property_status != 'Bank Owned')";
		  }
		}

		//  seo quicksearch stuff to process searches - me
		if (isset($street) && $street != ""){
		  $street=str_replace("-"," ",$street);
		  $sql_addition[] = " street_name LIKE '%". $street ."%' ";
		}

		if (isset($zipcode) && $zipcode != ""){
		  $sql_addition[] = " postal_code = '". $zipcode ."' ";
		}

		/* WATER */
		if (!empty($watertype) && $watertype != ""){
		  $watertype = fixDash($watertype);
		  $sql_addition[] = " water_type LIKE '%". $watertype ."%' ";
		}

		$andsql = implode(" AND ", $sql_addition);

		if (isset($orsql)) {
		  if(!empty($andsql)) $andsql = ' AND ' . $andsql;
		}

		if ($countFlag)
			return "SELECT count(*) as cnt,property_sub_type,city,postal_code FROM master_rets_table WHERE $orsql $andsql ORDER BY listing_price DESC";
		else
			return "SELECT listing_id,listing_price,property_sub_type,property_type,bathrooms,halfbaths,street_number,street_name,street_dir,street_suffix,city,postal_code,bedrooms,remarks FROM master_rets_table WHERE $orsql $andsql ORDER BY listing_price DESC";
	}

}





