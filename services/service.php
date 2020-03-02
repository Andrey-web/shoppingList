<?php

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
        } elseif ($formId == 2) {
            $list = new Hoz();
        } elseif ($formId == 3) {
            $list = new Pharmacy();
        }

        $list->name = $_POST['name'];
        $list->count = $count;
        $list->status = 0;

        $add = $list->addShoppingList();

        if ($formId == 1) {
            Header('location: http://list.zvendinov.ru/?tabId=1');
            exit();
        } elseif ($formId == 2) {
            Header('location: http://list.zvendinov.ru/?tabId=2');
            exit();
        } elseif ($formId == 3) {
            Header('location: http://list.zvendinov.ru/?tabId=3');
            exit();
        }

    }

}

if (isset($_POST['del'])) {
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
        Header('location: http://list.zvendinov.ru/?tabId=1');
        exit();
    } elseif ($formId == 2) {
        Header('location: http://list.zvendinov.ru/?tabId=2');
        exit();
    } elseif ($formId == 3) {
        Header('location: http://list.zvendinov.ru/?tabId=3');
        exit();
    }
}

if (isset($_POST['change'])) {
    $id = $_POST['id'];
    $formId = $_POST['formId'];
    $name = $_POST['name'];
    $count = $_POST['count'];
    $status = 0;

    if ($formId == 1) {
        $list = new ShoppingList();
    } elseif ($formId == 2) {
        $list = new Hoz();
    } elseif ($formId == 3) {
        $list = new Pharmacy();
    }

    $list::update($id, $name, $count, $status);
    if ($formId == 1) {
        Header('location: http://list.zvendinov.ru/?tabId=1');
        exit();
    } elseif ($formId == 2) {
        Header('location: http://list.zvendinov.ru/?tabId=2');
        exit();
    } elseif ($formId == 3) {
        Header('location: http://list.zvendinov.ru/?tabId=3');
        exit();
    }
}

if (isset($_POST['yes'])) {
    $id = $_POST['id'];
    $formId = $_POST['formId'];
    $name = $_POST['name'];
    $count = $_POST['count'];
    $status = 1;

    if ($formId == 1) {
        $list = new ShoppingList();
    } elseif ($formId == 2) {
        $list = new Hoz();
    } elseif ($formId == 3) {
        $list = new Pharmacy();
    }


    $list::update($id, $name, $count, $status);
    if ($formId == 1) {
        Header('location: http://list.zvendinov.ru/?tabId=1');
        exit();
    } elseif ($formId == 2) {
        Header('location: http://list.zvendinov.ru/?tabId=2');
        exit();
    } elseif ($formId == 3) {
        Header('location: http://list.zvendinov.ru/?tabId=3');
        exit();
    }
}