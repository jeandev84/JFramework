<?php
namespace Jan\Services\Validation;


/**
 * Class Validator
 * @package Jan\Services\Validation
*/
class Validator
{

     /** @var array  */
     private $data = [];


     /** @var array  */
     private $errors = [];


     /**
      * Validator constructor.
      * @param array $data
     */
     public function __construct($data)
     {
         $this->data = $data;
     }


     /**
      * @param $name
      * @param $rule
      * @param bool $options
      * @return $this
     */
     public function check($name, $rule, $options = false)
     {
         $validator = "validate".ucfirst($rule);

         if(! $this->{$validator}($name, $options))
         {
              $this->errors[$name] = "Le champ $name n'a pas ete correctement remplit";
         }

         return $this;
     }


     /**
      * @param $name
      * @return bool
     */
     public function validateRequired($name)
     {
         return array_key_exists($name, $this->data) && $this->data[$name] != '';
     }


    /**
     * @param $name
     * @return bool
    */
    public function validateEmail($name)
    {
        return array_key_exists($name, $this->data) && filter_var($this->data[$name], FILTER_VALIDATE_EMAIL);
    }



    /**
     * @param $name
     * @param $values
     * @return bool
     */
    public function validateIn($name, $values)
    {
        return array_key_exists($name, $this->data) && in_array($this->data[$name], $values);
    }


    /**
     * @return array
    */
    public function errors()
    {
        return $this->errors;
    }


    /**
     * @return bool
    */
    public function isValid()
    {
        return empty($this->errors);
    }
}