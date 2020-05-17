<?php
namespace Jan\Component\Database\ORM;


/**
 * Class Repository
 * @package Jan\Component\Database\ORM
*/
class Repository
{

    /**
     * @param array $criteria
     * @return mixed
     * @throws \ReflectionException
     */
    public function find(array $criteria)
    {
        $sql = 'SELECT * FROM '. $this->tableName() .' WHERE ';

        // AND WHERE
        foreach ($criteria as $column => $value)
        {
            $sql .= $column .' = :'. $column;
            if(next($criteria))
            {
                $sql .= ' AND ';
            }
        }

        $sql = $this->resolveSql($sql, false);
        $record = $this->manager->execute($sql, $criteria)->fetchAll();

        return $record;
    }


    /**
     * @param array $criteria
     * @return array|mixed
     * @throws \ReflectionException
     */
    public function findOne(array $criteria)
    {
        return $this->find($criteria)[0] ?? [];
    }


    /**
     * @param int $id
     * @return
     * @throws \ReflectionException
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM '. $this->tableName() .' WHERE id = :id';

        if($this->isSoftDeleted())
        {
            // deleted_at (datetime may be)
            $sql = 'UPDATE '. $this->tableName() .' SET deleted_at = 1 WHERE id = :id';

            // $sql = 'UPDATE '. $this->tableName() .' SET deleted_at = '. $this->deletedAt .' WHERE id = :id';
        }

        return $this->manager->execute($sql, ['id' => $id]); // compact('id')
    }


    /**
     * @param int $id
     * @return mixed
     * @throws \ReflectionException
     */
    public function restore(int $id)
    {
        if($this->isSoftDeleted())
        {
            // deleted_at (datetime may be)
            $sql = 'UPDATE '. $this->tableName() .' SET deleted_at = 0 WHERE id = :id';
            return $this->manager->execute($sql, ['id' => $id]); // compact('id')
        }
    }


}