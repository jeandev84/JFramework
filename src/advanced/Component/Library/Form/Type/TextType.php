<?php
namespace Jan\Component\Library\Form\Type;


use Jan\Component\Library\Form\Type\Contract\InputType;


/**
 * Class TextType
 * @package Jan\Component\Library\Form\Type
*/
class TextType extends InputType
{

    /**
     * @return string
    */
    public function getType()
    {
        return 'text';
    }
}