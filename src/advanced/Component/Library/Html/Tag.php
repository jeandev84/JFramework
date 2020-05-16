<?php
namespace Jan\Component\Library\Html;


/**
 * Class Tag
 * @package Jan\Component\Library\Html
*/
class Tag
{

    /** @var bool  */
    protected $single = false;


    /** @var string  */
    protected $name;


    /** @var  string */
    protected $content;


    /** @var array  */
    protected $attributes = [];


    /**
     * Build tag
    */
    public function format()
    {
        if(! $this->single)
        {
            return $this->getPairFormat();
        }

        return $this->getSingleFormat();
    }


    /**
     * @return string
    */
    protected function getPairFormat()
    {
        return sprintf('<%s%s>%s</%s>',
            $this->name,
            $this->attributeStringify(),
            $this->content,
            $this->name
        );
    }


    /**
     * @return string
    */
    protected function getSingleFormat()
    {
         return sprintf('<%s%s/>',
             $this->name,
             $this->attributeStringify()
         );
    }


    /**
     * @return string
    */
    protected function attributeStringify()
    {
        $str = '';
        foreach ($this->attributes as $key => $value)
        {
            if(! is_array($value))
            {
                $str .= sprintf(' %s="%s"', $key, $value);
            }
        }
        return $str;
    }
}

echo '<hr/>';
echo '<a></a>';