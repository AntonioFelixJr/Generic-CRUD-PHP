<?php

namespace Api\Repository;

use Api\Config\Conection;

abstract class AbstractRepository extends Conection
{
    protected $table;
    protected $sql;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function insert($array)
    {
        $this->sql = ('insert into ' . $this->table . '(');

        unset($array['id']);

        foreach ($array as $key => $values) {
            $this->sql .=  $key . ',';
        }

        $this->sql =  substr($this->sql, 0, -1) . ') values (';

        foreach ($array as  $key => $value) {
            $this->sql .= ':' .$key . ',';
        }

        $this->sql =  substr($this->sql, 0, -1) . ')';

        $stmt = Conection::prepare($this->sql);
        foreach ($array as  $key => $value) {
            $stmt->bindParam(':' . $key , $value);
        }
        $stmt->execute();
    }

    public function update($array, $id)
    {
        $this->sql = ('update ' . $this->table . ' set ');

        unset($array['id']);

        foreach ($array as $key => $values) {
            $this->sql .=  $key . ' = :' . $key . ' ,';
        }

        $this->sql =  substr($this->sql, 0, -1) . 'where id=:id';

        $stmt = Conection::prepare($this->sql);
        foreach ($array as  $key => $value) {
            $stmt->bindParam(':' . $key , $value);
        }
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function fetch()
    {
        $this->sql = ('select * from ' . $this->table);
        $stmt = Conection::prepare($this->sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $this->sql = ('select * from ' . $this->table . ' where id = :id');
        $stmt = Conection::prepare($this->sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function delete($id)
    {
        $this->sql = ('delete from ' . $this->table . ' where id = :id');
        $stmt = Conection::prepare($this->sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
