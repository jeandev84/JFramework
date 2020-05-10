<?php
namespace Jan\Foundation\Parse;


/**
 * Class StringBody
 * @package Jan\Foundation\Parse
 *
 * Stringify body
 */
class StringBody extends CustomBody
{

    /**
     * @return mixed
    */
    public function getContent()
    {
        if(is_array($this->body))
        {
            return json_encode($this->body);
        }

        return $this->body;
    }
}