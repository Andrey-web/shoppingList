<?php

namespace App\Models;

use App\Model;


class Pharmacy extends Model
{
    const TABLE = 'pharmacy';

    public $name;
    public $status;
    public $count;
}