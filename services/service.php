<?php

use App\Db;
use App\Models\ShoppingList;
use App\Models\Hoz;
use App\Models\Pharmacy;

if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        echo 'Введите название';
    } else {
        $formId = $_POST['formId'];

        if ($_POST['count']) {
            $count = $_POST['count'];
        } else {
            $count = 1;
        }

        if ($formId == 1) {
            $list = new ShoppingList();
            $table = 'shoppinglist';
            $location = 'location: https://list.zvendinov.ru/?tabId=1';
        } elseif ($formId == 2) {
            $list = new Hoz();
            $table = 'hoz';
            $location = 'location: https://list.zvendinov.ru/?tabId=2';
        } elseif ($formId == 3) {
            $list = new Pharmacy();
            $table = 'pharmacy';
            $location = 'location: https://list.zvendinov.ru/?tabId=3';
        }

        $list->name = trim($_POST['name']);
        $db = new Db();
        $result = $db->checkShoppingListName($table, $_POST['name']);

        if (!empty($result)) {
            $db->setStatus($table, $_POST['name']);
            Header($location);
            exit();
        } else {
            $list->status = 0;
        }

        $list->count = $count;


        $add = $list->addShoppingList();

        if ($formId == 1) {
            Header($location);
            exit();
        } elseif ($formId == 2) {
            Header($location);
            exit();
        } elseif ($formId == 3) {
            Header($location);
            exit();
        }

    }

} elseif (isset($_POST['del'])) {
    $id = $_POST['id'];
    $formId = $_POST['formId'];

    if ($formId == 1) {
        $list = new ShoppingList();
    } elseif ($formId == 2) {
        $list = new Hoz();
    } elseif ($formId == 3) {
        $list = new Pharmacy();
    }

    $list::delete($id);
    if ($formId == 1) {
        Header('location: https://list.zvendinov.ru/?tabId=1');
        exit();
    } elseif ($formId == 2) {
        Header('location: https://list.zvendinov.ru/?tabId=2');
        exit();
    } elseif ($formId == 3) {
        Header('location: https://list.zvendinov.ru/?tabId=3');
        exit();
    }
    exit();

} elseif (isset($_POST['change']) || isset($_POST['yes'])) {
    if (isset($_POST['change'])) {
        $status = 0;
    }
    if (isset($_POST['yes'])) {
        $status = 1;
    }

    $id = $_POST['id'];
    $formId = $_POST['formId'];
    $name = $_POST['name'];
    $count = $_POST['count'];


    if ($formId == 1) {
        $list = new ShoppingList();
    } elseif ($formId == 2) {
        $list = new Hoz();
    } elseif ($formId == 3) {
        $list = new Pharmacy();
    }

    $list::update($id, $name, $count, $status);
}

