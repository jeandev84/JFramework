<?php
namespace Jan\Component\Library\Form;


use Exception;
use Jan\Component\Library\Form\Type\TextType;
use Jan\Component\Library\Form\Type\TextareaType;
use Jan\Services\Idea\Type\TextArea;
use ReflectionClass;


/**
 * Class Form
 * @package Jan\Component\Library\Form
*/
class Form
{


    /** @var array  */
    protected $data = [];


    /** @var array  */
    protected $formats = [];


    /**
     * Form constructor.
     * @param array $data
    */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * Open form tag and attributes
     *
     * @param string $action
     * @param string $method
     * @param array $attributes
     * @return Form
     */
    public function open(string $action = '/', string $method = 'POST', array $attributes = [])
    {
        $this->formats['open'] = sprintf('<form action="%s" method="%s"%s>', $action, $method, $attributes);
        return $this;
    }


    /**
     * @param $name
     * @param $type
     * @param array $options
     * @return Form
     * @throws \ReflectionException
    */
    public function add($name, $type, $options = [])
    {
        $options = array_merge(compact('name'), $options);
        $field = $this->createField($type, [$this->data, $options]);
        $this->formats[$name] = $field->format();
        return $this;
    }


    /**
     * Close form
    */
    public function close()
    {
        $this->formats['close'] = '</form>';
    }


    /**
     * Render HTML form
     * @return string
    */
    public function render()
    {
        return implode("\n", array_values($this->formats));
    }


    /**
     * @return string
     * @param array $attributes
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
     * @param string $type
     * @param array $arguments
     * @return object
     * @throws \ReflectionException
     * @throws Exception
    */
    private function createField(string $type, array $arguments = [])
    {
        if(! class_exists($type))
        {
            throw new Exception(
                sprintf('class %s does not exist', $type)
            );
        }

        $reflected = new ReflectionClass($type);
        return $reflected->newInstanceArgs($arguments);
    }

}

$form = new Form($_POST);

$form->add('name', TextType::class, [
   'label' => 'Nom',
   'attributes' => [
       'style' => ''
   ]
])->add('message', TextArea::class, [
   'label' => 'Message',
   'attributes' => [
       'style' => ''
   ]
]);


# Render HTML form
$form->render();