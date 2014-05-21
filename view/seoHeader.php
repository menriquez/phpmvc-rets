<?

GLOBAL $page_title;
$page_title = $this->model->getSEOTitle();
GLOBAL $page_description;
$page_description = $this->model->getSEODesc();
GLOBAL $page_keywords;
$page_keywords = $this->model->getSEOKeywords();

?>