<?php 
namespace Core\HTML;

/**
 * Class Form
 * Permet de generer un formulaire rapidement et simplement
*/

class Form 
{
     
     /**
      * @var array Donnees utilisees par le formulaire
     */
     private $data;

     /**
      * @var string Tag utilise pour entourer les champs
     */
     public $surround = 'p';
     

     /**
      * @param array $data Donnees utilisees par le formulaire
      * @return void
     */
  	 public function __construct($data = [])
  	 {
            $this->data = $data;
  	 }
    
     /**
      * @param $html Code HTML a entourer
      * @return string
     */
  	 protected function surround($html)
  	 {
  	 	 return "<{$this->surround}>{$html}</{$this->surround}>".PHP_EOL;
  	 }
       

     /**
      * @param string $index Index de la valeur a recuperer
      * @return mixed
     */
  	 protected function getValue($index)
  	 {
        if(is_object($this->data))
        {
            return $this->data->{$index};

        }
           
        return isset($this->data[$index]) ? $this->data[$index] : null;
  	 	 
  	 }
     

    /**
      * @param string $name 
      * @param string $label
      * @param array $options 
      * @return string
     */
      public function input($name, $label, $options = [])
      {
           $type = isset($options['type']) ? $options['type'] : 'text';
           $label = '<label>' . $label .'</label>';
           
           if($type === 'textarea')
           {
               $input = '<textarea name="'. $name .'">'. $this->getValue($name) .'</textarea>';

           }else{

               $input = '<input type="'. $type .'" name="'. $name .'" value="'. $this->getValue($name) .'">';
           }
           

           return $this->surround($label . $input);
      }
       
     /**
      * @return string
     */
  	 public function submit()
  	 {
  	 	  return $this->surround('<button type="submit">Envoyer</button>');
  	 }

}