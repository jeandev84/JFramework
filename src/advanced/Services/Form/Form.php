<?php
namespace Jan\Services\Form;


/**
 * Class Form
 * @package Jan\Services\Form
*/
class Form
{

     /** @var array  */
     private $data = [];


     /**
      * Form constructor.
      * @param array $data
     */
     public function __construct($data = [])
     {
          $this->data = $data;
     }



     /**
      * @param $type
      * @param $name
      * @param $label
      * @return string
     */
     private function input($type, $name, $label)
     {
         $value = $this->getValue($name);

         if($type == 'textarea')
         {
             $input = "<textarea name=\"$name\" class=\"form-control\" id=\"input-$name\">$value</textarea>";
         }else{
             $input = "<input type=\"$type\" name=\"$name\" class=\"form-control\" id=\"input-$name\" value=\"$value\">";
         }

         return "<div class=\"form-group\"><label for=\"input-$name\">$label</label>$input</div>";
     }


     /**
      * @param $name
      * @return mixed|string
     */
     private function getValue($name)
     {
         return $this->data[$name] ?? '';
     }


     /**
      * Generate input field type text
      * @param $name
      * @param $label
      * @return string
     */
     public function text($name, $label)
     {
         return $this->input('text', $name, $label);
     }


     /**
      * @param $name
      * @param $label
      * @return string
     */
     public function email($name, $label)
     {
         return $this->input('email', $name, $label);
     }


    /**
     * @param $name
     * @return string
     */
     public function hidden($name)
     {
         return $this->input('hidden', $name, false);
     }


     /**
      * @param $name
      * @param $label
      * @param array $options
      *
      * key = {0,1,2}
      * $options = [
      *  'Contact',
      *  'Depannage',
      *  'Shell'
      * ]
     */
     public function select($name, $label, $options = [])
     {
         $optionHtml = '';
         $value = $this->getValue($name);
         foreach ($options as $k => $v)
         {
             $selected = '';
             if($value == $k)
             {
                $selected = ' selected';
             }
             $optionHtml .= "<option value=\"$k\"$selected>$v</option>";
         }

         echo "<div class=\"form-group\">
                <label for=\"input-service\">Service</label>
                <select name=\"$name\" id=\"input-$name\" class=\"form-control\">$optionHtml</select>
              </div>";
     }


    /**
     * @param $name
     * @param $label
     * @return string
     */
     public function textarea($name, $label)
     {
         return $this->input('textarea', $name, $label);
     }


     /**
      * @param $label
      * @return string
     */
     public function submit($label)
     {
         return '<button type="submit" class="btn btn-primary">'. $label .'</button>';
     }
}