<?php

namespace App;

class Db
{

    protected $dbh;

    public function __construct()
    {
        $this->dbh = new \PDO('mysql:dbname=ci52131_shlist;host=localhost;charset=utf8;', 'ci52131_shlist', 'Raedge12');
    }

    public function execute($sql)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute();
        return $res;
    }

    public function query($sql, $class)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute();
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    public function queryNew($sql, $data=[], $class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function executeNew($sql, $params=[])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;
    }

    public function getLastId()
    {
        return $this->dbh->lastInsertId();
    }

    public function checkShoppingListName($table, $name)
    {
        $sql = "SELECT * FROM ".$table." WHERE name LIKE '".$name."'";
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    public function setStatus($table, $name)
    {
        $sql = "UPDATE ".$table." SET status = 0 WHERE name ='".$name."'";
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute();
        return $res;
    }
}

