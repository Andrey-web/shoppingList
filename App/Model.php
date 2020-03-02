<?php

namespace App;

abstract class Model
{

    const TABLE = '';

    public static function findAll()
    {
        $db = new Db();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
    }

    public function addShoppingList()
    {
        $fields = get_object_vars($this);

        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
            }
            $cols[] = $name;
            $data[':' . $name] = $value;
        }

        $sql = '
            INSERT INTO ' . static::TABLE . ' 
            (' . implode(',', $cols) . ')
             VALUES 
            (' . implode(',', array_keys($data)) . ')
         ';
        $db = new Db();
        $db->executeNew($sql, $data);

        $this->id = $db->getLastId();

        return true;
    }

    public static function delete($id)
    {
        $db = new Db();
        return $db->query(

            'DELETE FROM ' . static::TABLE . ' WHERE id=\'' . $id . '\'',
            static::class
        );

    }

    public static function update($id, $name, $count, $status) {
        $db = new Db();
        return $db->query(

            'UPDATE ' . static::TABLE . ' SET name=\'' . $name . '\', count=\'' . $count . '\', status=\'' . $status . '\' WHERE id=\'' . $id . '\'',
            static::class
        );
    }

}