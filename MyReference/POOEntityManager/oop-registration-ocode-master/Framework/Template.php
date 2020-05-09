<?php 
namespace Project;



class Template 
{

     protected $header;
     protected $content;
     protected $footer;

     protected $dir = null;

     
     public function __construct($header = null, $content = null, $footer = null)
     {
          $this->header  = $header;
          $this->footer  = $footer;
          $this->content = $content;

     }

     public function render($view = null, $data = [])
     {
           extract($data);

           if($this->header)
           {
           	   require_once($this->dir.'/'. $this->header);
           }

           if(!is_null($view))
           {
           	  include($view);
           }

           if($this->footer)
           {
           	  require_once($this->dir.'/'. $this->footer);
           }
     }

}