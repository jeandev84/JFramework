<?php 
namespace Project;



class Validate
{
	
	 private $passed = false,
	         $errors = [],
	         $db = null;


	 public function __construct()
	 {
	 	 $this->db = DB::getInstance();
	 }

     
     /**
      * $source = $_POST, $_GET, $_FILES, etc..
     */
	 public function check($source, $items = [])
	 {
	 	  foreach($items as $item => $rules)
	 	  {
	 	  	  foreach($rules as $rule => $rule_value)
	 	  	  {
	 	  	  	   # Message : echo "{$item} {$rule} must be {$rule_value} <br>";

	 	  	  	    $value = trim($source[$item]);
	 	  	  	    $item  = escape($item);

	 	  	  	    if($rule === 'required' && empty($value))
	 	  	  	    {
                          $this->addError("{$item} is required");

	 	  	  	    }else if(!empty($value)){

                         switch($rule)
                         {
                         	  case 'min':
                                 if(strlen($value) < $rule_value)
                                 {
                                    $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                                 }
                         	  break;
                         	  case 'max':
                         	     if(strlen($value) > $rule_value)
                                 {
                                    $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                                 }

                         	  break;
                         	  case 'matches':
                         	     if($value != $source[$rule_value])
                         	     {
                         	     	  $this->addError("{$rule_value} must match {$item}");
                         	     }

                         	  break;
                         	  case 'unique':
                                  $check = $this->db->get($rule_value, [$item, '=', $value]);
                                  if($check->count())
                                  {
                                  	   $this->addError("{$item} already exists.");
                                  }
                         	  break;
                         }
	 	  	  	    }
	 	  	  }
	 	  }


	 	  if(empty($this->errors))
	 	  {
	 	  	   $this->passed = true;
	 	  }

	 	  return $this;
	 }


	 private function addError($error)
	 {
          $this->errors[] = $error;
	 }

	 public function errors()
	 {
	 	 return $this->errors;
	 }


	 public function passed()
	 {
	 	 return $this->passed;
	 }


	 public function errorHTML()
	 {
	 	if(!empty($this->errors()))
	 	{
               $html =  '<ul class="error">';
               foreach($this->errors as $error)
		       {
		  	         $html .= '<li>'. $error . '</li>';
		       }
              $html .= '</ul>';
              return $html;
	 	}
	 }


	  public function successHTML($msg = 'Passed!')
	 {
	 	if(empty($this->errors()))
	 	{
              $html =  '<ul class="success">';
  	          $html .= '<li>'. $msg . '</li>';
              $html .= '</ul>';
              return $html;
	 	}
	 }

}