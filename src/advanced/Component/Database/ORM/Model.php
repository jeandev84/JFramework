<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Exceptions\ConnectionException;
use ReflectionException;


/**
 * Class Model
 * @package Jan\Component\Database\ORM
*/
abstract class Model extends ModelRepository
{

     /** @var array  */
     // protected $fillable = ['name', 'cost', 'description'];


     /** @var array  */
     protected $hidden = [];


     /**
      * @param string $condition
      * @param $value
      * @return string
      * @throws ConnectionException|ReflectionException
     */
     public static function where($condition, $value)
     {
         return self::repository()->where($condition, $value);
     }


     /**
      * Get all record
      * @return mixed
      * @throws ConnectionException
      * @throws ReflectionException
     */
     public static function all()
     {
         return self::repository()->findAll();
     }



    /**
     * Save data to the database
    */
    public function save()
    {
        $columns = $this->getTableColumns();
        $attributes = [];

        foreach ($columns as $column)
        {
            // if(empty($this->{$column}))  { continue; }
            if(! empty($this->fillable))
            {
                if(\in_array($column, $this->fillable))
                {
                    $attributes[$column] = $this->{$column};
                }

            } else {

                $attributes[$column] = $this->{$column};
            }
        }

        if(! empty($this->guarded))
        {
            foreach ($this->guarded as $guarded)
            {
                if(isset($attributes[$guarded]))
                {
                    unset($attributes[$guarded]);
                }
            }
        }

        //dump($attributes);
        //dd($this);

        # Process
        $id = (int) $this->getAttribute('id');

        $manager = self::manager()->setTable($this->getTable());

        if($id)
        {
            $manager->update($attributes, $id);
        } else{
            $manager->insert($attributes);
            $this->setAttribute('id', self::query()->lastId());
        }
    }
}