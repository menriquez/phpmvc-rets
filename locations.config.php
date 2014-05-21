<?PHP
/* FILE:	locations.config.php
 * DESC:	stores domain specific data for mls locations included in search
 * 
 * MLS PROVIDER: Brevard MLS - brevardmls.com
 * 
 * OWNER:	FENCLWEBDESIGN.COM
 * 
 * Original code by:		Chris Vanzo
 * contributors:
 * 
 * DETAILED NOTES:
 * * the follow declares all the cities that will be included in the locations along with coresponding area zone numbers
 * * all locations on this file are included in searchs.
 * * there is no way to designate visibility of locations between search pages on your site.
 * * If you wish to disable locations per search, then that must be done in the page display code
 * 
 * * unless otherwise altered, the position that a location is added to the locations array is the order they will display in frontend
 * 
 * 
 */
 
 
// locations included in searches

/* SYNTAX
 * 
 * $locations_array['CITY/AREA'] = array('title'=>'TEXT TITLE','mls'=>'MLS CITY DB NAME', 'subdivision'=>'NAME OF SUBDIV','areazone'=>'COMMA DELIMINATED');
 * 
 * NOTES: 
 * - all fields are optional, for results, you need to either define the mls or subdivision (also the title, please)
 * - areazone are used to attached mls defined zones to cities so when a search is done, the areazone locations are also included regardless of actual city
 * - zones array below is to provide details on area zones for searches, zones defined by brevard mls 
 */
$locations_array = array();
$locations_array['cocoa'] = array('title'=>'Cocoa','city'=>'COCOA','areazone'=>'210,212,215');
$locations_array['cocoa-beach'] = array('title'=>'Cocoa Beach','city'=>'COCOA BEACH','areazone'=>'272');
$locations_array['cape=canaveral'] = array('title'=>'Cape Canaveral','city'=>'CAPE CANAVERAL','areazone'=>'270,271');
$locations_array['cloister'] = array('title'=>'Cloisters','city'=>'', 'subdivision'=>'CLOISTER','areazone'=>'');
$locations_array['indian-harbor-beach'] = array('title'=>'Indian Harbour Beach','city'=>'INDIAN HARBOUR BEACH','areazone'=>'382');
$locations_array['indialantic'] = array('title'=>'Indialantic','city'=>'INDIALANTIC','areazone'=>'383,384');
$locations_array['lansing-island'] = array('title'=>'Lansing Island', 'city'=>'', 'subdivision'=>'LANSING ISLAND','areazone'=>'');
$locations_array['melbourne'] = array('title'=>'Melbourne','city'=>'MELBOURNE','areazone'=>'320,321,322,323,330');
$locations_array['melbourne-beach'] = array('title'=>'Melbourne Beach','city'=>'MELBOURNE BEACH','areazone'=>'385');
$locations_array['merritt-island'] = array('title'=>'Merritt Island','city'=>'MERRITT ISLAND','areazone'=>'250,251,252,253,254,355');
$locations_array['montecito'] = array('title'=>'Montecito','city'=>'', 'subdivision'=>'MONTECITO','areazone'=>'');
$locations_array['palm-bay'] = array('title'=>'Palm Bay','city'=>'PALM BAY','areazone'=>'340,341,343,344,345,346,347'); 
$locations_array['rockledge'] = array('title'=>'Rockledge','city'=>'','areazone'=>'214');
$locations_array['satellite-beach'] = array('title'=>'Satellite Beach','city'=>'SATELLITE BEACH','areazone'=>'381,382');
$locations_array['suntree'] = array('title'=>'Suntree','city'=>'','areazone'=>'216,218');
$locations_array['titusville'] = array('title'=>'Titusville','city'=>'','areazone'=>'102,103,104');
$locations_array['tortoise-island'] = array('title'=>'Tortoise Island','city'=>'','areazone'=>'','subdivision'=>'TORTOISE ISL');
$locations_array['west-melbourne'] = array('title'=>'West Melbourne','city'=>'WEST MELBOURNE','areazone'=>'331');
$locations_array['vero-beach'] = array('title'=>'Vero Beach','city'=>'VERO BEACH','areazone'=>'');
$locations_array['viera'] = array('title'=>'Viera','city'=>'VIERA','areazone'=>'216,217');


function getMLSLocations(){GLOBAL $locations_array; return $locations_array;}
?>