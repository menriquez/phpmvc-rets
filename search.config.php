<?PHP
/* FILE:	search.config.php
 * DESC:	sets domain values that influence search results
 * 
 * MLS PROVIDER: Brevard MLS - brevardmls.com
 * 
 * OWNER:	FENCLWEBDESIGN.COM
 * 
 * Original code by:		Chris Vanzo
 * contributors:
 * 
 * DETAILED NOTES:
 * - all configish files pertaining to the actual search, we got requireds below
 * - this is the beginning of hopefully something better when it comes to required field checks, this is very basic
 * 
 * DATA DEFINED IN THIS DOCUMENT:
 * - required search fields per search type
 * - property types included in search related to what is in the DB
 * - range limits for price range, 
 */

$required_array = array();

/* SYNTAX for required_array
 * $required_array[] = array('type'=>'NAME OF SEARCH TYPE','name'=>'FIELD INPUT NAME','required'=>'yes/no');
 */
$required_array[] = array('type'=>'default','name'=>'city','required'=>'yes');
$required_array[] = array('type'=>'mls','name'=>'mlsnumber','required'=>'yes');
$required_array[] = array('type'=>'proptype','name'=>'type','required'=>'yes');
$required_array[] = array('type'=>'address','name'=>'city','required'=>'yes');
$required_array[] = array('type'=>'address','name'=>'streetName','required'=>'yes');
$required_array[] = array('type'=>'adult','name'=>'adult_community','required'=>'yes');
$required_array[] = array('type'=>'none','name'=>'none','required'=>'no');

/* SYNTAX for proptype_array
 * $proptype_array['OPTION FIELD VALUE'] = 'READABLE TITLE';
 */
$proptype_array = array();
$proptype_array['home'] = 'Home';
$proptype_array['townhomes'] = 'Townhouse';
$proptype_array['condo'] = 'Condominium';
$proptype_array['rental'] = 'Rental';
$proptype_array['vacantland'] = 'Vacant Land';

/* SYNTAX for pooltype_array
 * $proptype_array['OPTION FIELD VALUE'] = 'READABLE TITLE';
 */
$pooltype_array = array();
$pooltype_array['None'] = 'None';
$pooltype_array['Private'] = 'Private';
$pooltype_array['Community'] = 'Community';
$pooltype_array['Community & Private'] = 'Community & Private';


/* SYNTAX for $range_array
 * $range_array[RANGE TYPE][RANGE LEVEL]['start'] = 0;
 * $range_array[RANGE TYPE][RANGE LEVEL]['increment'] = 500;
 * $range_array[RANGE TYPE][RANGE LEVEL]['end'] = 2000;
 * 
 * RANGE LEVEL starts at 0, this is to help create range tiers to be cool
 * 
 * NOTES: this is actually pretty cool, this can handle multiple levels of ranges per type
 */
$range_array = array();
// price
$range_array['price'][1]['start'] = 1000;
$range_array['price'][1]['increment'] = 1000;
$range_array['price'][1]['end'] = 3000;
$range_array['price'][2]['start'] = 50000;
$range_array['price'][2]['increment'] = 50000;
$range_array['price'][2]['end'] = 10000000;
// rooms
$range_array['rooms'][0]['start'] = 1;
$range_array['rooms'][0]['increment'] = 1;
$range_array['rooms'][0]['end'] = 10;
// years
$range_array['years'][0]['start'] = 1900;
$range_array['years'][0]['increment'] = 10;
$range_array['years'][0]['end'] = 2000;
$range_array['years'][1]['start'] = 2000;
$range_array['years'][1]['increment'] = 1;
$range_array['years'][1]['end'] = (int)date('Y');
// footage
$range_array['footage'][0]['start'] = 500;
$range_array['footage'][0]['increment'] = 500;
$range_array['footage'][0]['end'] = 2000;
$range_array['footage'][1]['start'] = 2000;
$range_array['footage'][1]['increment'] = 1000;
$range_array['footage'][1]['end'] = 7000;
$range_array['footage'][2]['start'] = 7000;
$range_array['footage'][2]['increment'] = 1500;
$range_array['footage'][2]['end'] = 10000;


$config_array = array();
$config_array["rental_price_min"] = 990;


function getMLSConfig(){GLOBAL $config_array; return $config_array;}	 
function getMLSProptype(){GLOBAL $proptype_array; return $proptype_array;}	 
function getMLSRequiredFields(){GLOBAL $required_array; return $required_array;}
function getMLSRange($r){GLOBAL $range_array; if(empty($range_array[$r]))return false; else return $range_array[$r];}

function getMLSPooltype(){GLOBAL $pooltype_array; return $pooltype_array;}	 