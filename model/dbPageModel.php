<?php

include_once('mls/model/pdoConfig.php');

// hold the RETS data in this class
class dbPage extends PDOConfig {

  public  $row;

  public function __construct(){

    parent::__construct( );

  }

  ///////////////////////////////////////////////////////////////////////////////////////
  //
  // getter methods to expose class data cleanly
  //
  ///////////////////////////////////////////////////////////////////////////////////////
	public function getPageName () {
	 return $this->row['community_name'];
	}

	public function getPageType () {
	 return $this->row['community_type'];
	}

	public function getPageUrl() {
	 return $this->row['page_url'];
	}

	public function getPageTitle() {
		return $this->row['page_title'];
	}

	public function getPageKeywords() {
		return $this->row['page_keywords'];
	}

	public function getPageDesc() {
		return $this->row['page_description'];
	}

	public function getPageText() {
		return $this->row['page_text'];
	}

	public function getPageYTId() {
		return $this->row['youtube_id'];
	}

	public function isImageValid() {
		$path=pathinfo($this->row['file_name']);
		if ($this->row['file_name']!="" && file_exists(BASE_PATH."images/pages/".$path['basename'])) {
			return true;
		}
		else {
			return false;
		}
	}

	public function getImageFn() {
		$path=pathinfo($this->row['file_name']);
		if ($this->row['file_name']!="" && file_exists(BASE_PATH."images/pages/".$path['basename'])) {
			return "/images/pages/".$path['basename'];
		}
		else {
			return false;
		}
	}

}

// do the sql searching in this class
class dbPageModel extends dbPage {

  // vars to handle internal row management
  private $rows;
  private $rowIdx;
  private $count;
  private $stm;

  // search fields
  private $page_name;
  private $id;

  public function __construct(){

    parent::__construct( );

  }

  ///////////////////////////////////////////////////////////////////////////////////////
  //
  // setter methods to set internal search fields
  //
  ///////////////////////////////////////////////////////////////////////////////////////
  public function setPageName ($inStg) {
		$this->page_name=PDO::quote($inStg);
  }

  public function setId ($inStg) {
		$this->id=PDO::quote($inStg);
  }

  ///////////////////////////////////////////////////////////////////////////////////////
  //
  // getPage() loads class vars with data from database wia search
  //
  ///////////////////////////////////////////////////////////////////////////////////////
  public function getPage () {

    // check class data
    if (($this->page_name == "") && ($this->id == "")) {
			throw new Exception("dbPageSearch :: getPage :: Invalid Search - please check to make sure search terms are set.");
    }

    $sql = 'SELECT * FROM pages
            WHERE (page_name = '.$this->page_name.') ';

    if (!empty($this->id)) {
     $sql .= 'OR (id = '.$this->id.')';
    }

    $this->stm = $this->prepare($sql);

    $this->stm->execute();
    $this->rows= $this->stm->fetchAll(PDO::FETCH_ASSOC);
    $this->count = $this->stm->rowCount();
  	if ($this->count == 0) {
			throw new Exception("dbPageSearch :: getPage :: Empty Results - please check to make sure page exists in database.");
    }

    $this->rowIdx = 0;

    // set row to first
    $this->row=$this->rows[$this->rowIdx++];

  }

  ///////////////////////////////////////////////////////////////////////////////////////
  //
  // next() loads next record (if search returns dataset) in dataset
  //
  ///////////////////////////////////////////////////////////////////////////////////////
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

}

?>
