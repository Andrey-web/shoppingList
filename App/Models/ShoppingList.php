<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 22.02.2018
 * Time: 13:18
 */

namespace App\Models;

use App\Model;


class ShoppingList extends Model
{
    const TABLE = 'shoppinglist';

    public $name;
    public $status;
    public $count;
}