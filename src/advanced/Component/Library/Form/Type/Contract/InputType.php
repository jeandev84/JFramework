<?php
namespace Jan\Component\Library\Form\Type\Contract;


/**
 * Class InputType
 * @package Jan\Component\Library\Form\Type\Contract
*/
abstract class InputType implements InputInterface
{

    /** @var array */
    protected $data;



    /** @var array  */
    protected $attributes = [];


    /**
     * InputType constructor.
     * @param $name
     * @param $data
     * @param $attributes
    */
    public function __construct($data, $attributes)
    {
        $this->data = $data;
        $this->attributes = $attributes;
    }


    /**
     * @return string
    */
    public function format()
    {
        $html = $this->getLabel();
        $html .= sprintf('<input type="%s"%s>', $this->getType(), $this->getAttributes());
        return $html;
    }


    /**
     * @return string
     * name='something' class="form-control"
    */
    public function getAttributes()
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


    /**
     * @param array $attributes
     * @return string
    */
    public function attributeStringify(array $attributes)
    {
        $str = '';
        foreach ($attributes as $key => $value)
        {
            if(! is_array($value))
            {
                $str .= sprintf(' %s="%s"', $key, $value);
            }
        }
        return $str;
    }


    /**
     * @param $key
     * @return mixed|null
    */
    protected function getAttribute($key)
    {
        return $this->attributes[$key] ?? null;
    }


    /**
     * Get Label
     *
     * @param array $attributes
     * @return mixed
    */
    protected function getLabel(array $attributes = [])
    {
        $label = $this->getAttribute('label');

        if(! $label)
        {
            $label = ucfirst($this->getAttribute('name'));
        }

        return sprintf('<label for="%s"%s>%s</label>',
            $this->getAttribute('id'),
            $this->getAttributes(),
            $label
        );
    }


    /**
     * @return mixed
    */
    protected function getSurround() {}


    /**
     * @return string
    */
    abstract public function getType();
}