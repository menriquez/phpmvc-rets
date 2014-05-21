<?php

include_once('mls/model/pdoConfig.php');

// hold the RETS data in this class
class dbNews extends PDOConfig {

  public  $row;

  public function __construct(){

    parent::__construct( );

  }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // getter methods to expose class data cleanly
  //
  ///////////////////////////////////////////////////////////////////////////////////////
	public function getId () {
	 return $this->row['id'];
	}

	public function getTitle () {
	 return stripslashes($this->row['title']);
	}

	public function getContent() {
	 return stripslashes($this->row['content']);
	}

	public function getKeywords() {
		return $this->row['keywords'];
	}

	public function getAuthor() {
		return $this->row['author'];
	}

	public function getDateAdded() {
		return $this->row['date_added'];
	}

	public function getSourceLink() {
		return $this->row['source_link'];
	}

	public function getCatId() {
		return $this->row['category_id'];
	}

	public function getShortDesc() {
		return $this->row['short_description'];
	}

	public function getPageYTId() {
		return $this->row['youtube_id'];
	}

	public function getImageFn() {
		$path=pathinfo($this->row['file_name']);
		return "images/news/".$path['basename'];
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//
	//	SEO functions for model
	//
	///////////////////////////////////////////////////////////////////////////////////////
	public function getSEOTitle() {
		return "Brevard County Florida Real Estate News :: ".$this->row['title'];
	}

	public function getSEODesc() {
		return $this->row['short_description'];
	}

	public function getSEOKeywords() {
		return $this->row['keywords'];
	}

}

// do the sql searching in this class
class dbNewsModel extends dbNews {

  // vars to handle internal row management
  private $rows;
  private $rowIdx;
  private $count;
  private $stm;

  // search fields
  private $id;

  public function __construct(){

    parent::__construct( );

  }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // setter methods to set internal search fields
  //
  ///////////////////////////////////////////////////////////////////////////////////////
  public function setId ($inStg) {
   $this->id=PDO::quote($inStg);
  }

  public function setTitle ($inStg) {
   $this->id=PDO::quote(fixDashes($inStg));
  }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // getNewsListings() loads all the news listings and loops thru them
  //
  ///////////////////////////////////////////////////////////////////////////////////////
  public function getNewsListings () {

    $sql = 'SELECT * FROM news
            ORDER BY position ASC';
    $this->stm = $this->prepare($sql);

    $this->stm->execute();
    $this->rows= $this->stm->fetchAll(PDO::FETCH_ASSOC);
    $this->count = $this->stm->rowCount();
    $this->rowIdx = 0;

    // set row to first
    $this->row=$this->rows[$this->rowIdx++];

  }

  ///////////////////////////////////////////////////////////////////////////////////////
  //
  // getNewsItem() loads one news artilce and displays the view
  //
  ///////////////////////////////////////////////////////////////////////////////////////
  public function getNewsItem () {

    // check class data
    if ($this->id == "") {
     throw new Exception("dbNewsSearch :: getNews:: Invalid Search - please check to make sure search terms are set.");
    }

    $sql = 'SELECT * FROM news
            WHERE  (id = '.$this->id.')';

     //      (title = '.$this->title.') OR
    $this->stm = $this->prepare($sql);

    $this->stm->execute();
    $this->rows= $this->stm->fetchAll(PDO::FETCH_ASSOC);
    $this->count = $this->stm->rowCount();
    $this->rowIdx = 0;

    // set row to first
    $this->row=$this->rows[$this->rowIdx++];

  }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
