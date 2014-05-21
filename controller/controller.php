<?php

define("DS","/",true);
define('BASE_PATH',$_SERVER['DOCUMENT_ROOT'].DS,true);

// eliminates the need for all those messy include files
// IMPORTANT! MUST NAME THE CLASS THE SAME AS THE FILENAME!
// IMPORTANT! MUST NAME THE CLASS THE SAME AS THE FILENAME!
//
// 	example:  dbRetsModel class MUST be in model/dbRetsModel.php!
//
// IMPORTANT! MUST NAME THE CLASS THE SAME AS THE FILENAME!
// IMPORTANT! MUST NAME THE CLASS THE SAME AS THE FILENAME!

spl_autoload_register(function ($class) {
    include 'mls/model/' . $class . '.php';
});

class Controller {

  private $model;
  private $action;
  private $page;
  private $pagename;

  public function __construct($action) {

    $this->action = $action;
    session_start();									// for persistant data store
  }

  //
  //  invoke() holds the business logic that connects the data to the view for each page in the switch() conditional
  //
  public function invoke() {

    switch ($this->action) {

			//  handle news data retreval and display ////////////////////////////////////////////////////////////////////////
      case 'shownews':

        $this->model = new dbNewsModel();

        //  get data...
        $this->model->setId($_GET['id']);
        $this->model->getNewsItem();

        // process view
        require ('mls/view/shownews.php');

        break;

      case 'news-loop':

        $this->model = new dbNewsModel();

        //  get data...no params needed
        $this->model->getNewsListings();

        // process view
        do {
          require ('mls/view/newsLoop.php');
        } while ($this->model->next());

        break;
			// end news //////////////////////////////////////////////////////////////////////////////////////////////////////


      case 'listings-loop':

        $this->model = new dbRetsModel();

        // set params for search and get data
        $this->model->setPropertyType("residential");
        $this->model->setAgentId("20130716175942774876000000");
        $this->model->getClientSummaryListings();

        // process view
        do {
          require ('mls/view/listingLoop.php');
        } while ($this->model->next());

        break;

      case 'area':

      	//explode($_GET);
      	$this->pagename = $_GET['page'];

      	// load model need for this action
        $this->page = new dbPageModel();

        // set params for search and get data
        $this->page->setPageName($this->pagename);
        $this->page->getPage();
        $_SESSION['page'] = $this->page->row;		// store for later use in search

        // process view
        require ('mls/view/area.php');

        break;

      case 'area-loop':

      	// load model need for this action
        $this->model = new dbRetsModel();
        $area = $_SESSION['page']['page_name'];

        // set params for search and get data
        $this->model->setArea($area);
        $this->model->getAreaListings();

        // process view
        do {
          require ('mls/view/areaLoop.php');
        } while ($this->model->next());

        break;

      case 'search-results':

      	// load model need for this action
        $this->model = new dbRetsModel();

        // set params for search and get data
        $this->model->setArea($_GET['area']);
       	$this->model->getSearchHeaderInfo();

        // process view
        require ('mls/view/search.php');

        break;

      case 'search-loop':

      	// load model need for this action
        $this->model = new dbRetsModel();

        // set params for search and get data
        $this->model->setArea($_GET['area']);
      	$this->model->doSearch();

        // process view using listing loop code...nice re-use
        do {
          require ('mls/view/areaLoop.php');
        } while ($this->model->next());

        break;

      case 'showmls':

      	// load model need for this action
        $this->model = new dbRetsModel();

        // set params for search and get data
        $this->model->setMLS($_GET['mls']);
       	$this->model->getSingleProperty();

        // process view
        switch ($this->model->getPropertyType()) {

					case "residential":
						require ('mls/view/mlsDetail/showRes.php');
						break;
					case "multifamily":
						require ('mls/view/mlsDetail/showMF.php');
						break;
					case "commercial":
						require ('mls/view/mlsDetail/showComm.php');
						break;
					case "rental":
						require ('mls/view/mlsDetail/showRent.php');
						break;
					case "vacantland":
						require ('mls/view/mlsDetail/showLand.php');
						break;

        }

        break;

      default:
        throw new Exception('Controller ERROR - unknown action type {'.$this->action.'} Please make sure the filename WITHOUT extension matches the switch/case strings in the invoke() method.');
    }

  }
}

?>
