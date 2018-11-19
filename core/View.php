<?php


class View{

  protected $_head, $_body,$_footer, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout= DEFAULT_LAYOUT;

  public function __construct(){

  }

  public function render($viewName){
    $view_array = explode('/',$viewName);
    $viewString = implode(DS,$view_array);
    if(file_exists(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php')){
        include(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php');
      include(ROOT.DS.'app'.DS.'views'.DS.'layouts'.DS.$this->_layout.'.php');

    }else{

      die('The View \"'.$viewName.'\" does not Exist');
    }
  }


  public function content($type){
    if($type == 'head'){
      return $this->_head;
    }elseif($type == 'body'){
      return $this->_body;
    }elseif($type == 'footer'){
      return $this->_footer;
    }
    return false;
  }

  public function start($type){
      $this->_outputBuffer = $type;
      ob_start();
  }
  public function end(){
    if($this->_outputBuffer == 'head'){
      $this->_head = ob_get_clean();
    }elseif($this->_outputBuffer == 'body'){
        $this->_body = ob_get_clean();
    }elseif($this->_outputBuffer == 'footer'){
      $this->_footer = ob_get_clean();
    }else{
      die('You must Call start');
    }
  }

  public function siteTitle(){

      return $this->_siteTitle;

  }

  public function setSiteTitle($title){
      $this->_siteTitle = $title;
  }

  public function setLayout($path){
      $this->_layout = $path;
  }
}
