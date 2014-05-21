<?php

// eliminates the need for all those messy include files
// IMPORTANT! MUST NAME THE CLASS THE SAME AS THE FILENAME!
//
// 	example:  dbRetsModel class MUST be in model/dbRetsModel.php!
//
// IMPORTANT! MUST NAME THE CLASS THE SAME AS THE FILENAME!
spl_autoload_register(function ($class) {
    include 'mls/model/' . $class . '.php';
});

//
//  seoController gets the data for the pages as needed and spits out the SEO-ed title, descriptions, and keywords
//
class seoController {

  private $model;
  private $action;
  private $page;
  private $pagename;

  public function __construct($action) {

    $this->action = $action;
    //session_start();									// for persistant data store if needed
  }

  //
  // main controller function - this is where we connect the data/model to the view by the page
  //
  public function invoke() {

    switch ($this->action) {

      case 'shownews':

        $this->model = new dbNewsModel();

        //  get data...
        $this->model->setId($_GET['id']);
        $this->model->getNewsItem();

        // process view
        require ('mls/view/seoHeader.php');

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

      case 'search-results':

      	//explode($_GET);
      	$this->pagename = $_GET['page'];

      	// load model need for this action
        $this->page = new dbPageModel();

        // set params for search and get data
        $this->page->setPageName($this->pagename);
        $this->page->getPage();
        $_SESSION['search'] = $this->page->row;		// store for later use in search

        // process view
        require ('mls/view/search.php');

        break;

      default:
        throw new Exception('Controller ERROR - unknown action type  Please make sure the filename WITHOUT extension matches the switch/case strings in the invoke() method.');
    }

  }
}

?>
