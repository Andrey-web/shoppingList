<?php

use App\Models\ShoppingList;
use App\Models\Hoz;
use App\Models\Pharmacy;

session_start();

require __DIR__ . '/autoload.php';
require __DIR__ . '/services/service.php';

$goods = ShoppingList::findAll();
$hGoods = Hoz::findAll();
$pharmacy = Pharmacy::findAll();

require __DIR__ . '/services/sort.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Список покупок</title>
    <script src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/uploads/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css?47">
    <link rel="stylesheet" href="css/mobile.css?17">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css?13" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="apple-touch-icon" href="/uploads/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/uploads/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/uploads/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/uploads/touch-icon-ipad-retina.png">
</head>
<body id="content">

<ul class="nav nav-tabs">
  <li data-tabId="1" <?php if ($_GET['tabId'] == 1 || !$_GET['tabId']){echo ' class="active"';} ?>><a data-toggle="tab" href="#panel1">Продукты</a></li>
  <li data-tabId="2" <?php if ($_GET['tabId'] == 2){echo ' class="active"';} ?>><a data-toggle="tab" href="#panel2">Для дома</a></li>
  <li data-tabId="3" <?php if ($_GET['tabId'] == 3){echo ' class="active"';} ?>><a data-toggle="tab" href="#panel3">Аптека</a></li>
</ul>
<span class="retweet"><i class="fas fa-retweet"></i>Обновить</span>
<div class="tab-content">
	<div id="panel1" class="tab-pane fade <?php if ($_GET['tabId'] == 1 || !$_GET['tabId']){echo ' active in';} ?>">
		<h3>Продукты</h3>
		<div class="products-form">
		    <form action="" method="post">

		    <div class="prod_name">
		        <input type="text" name="name" class="form-control prod_name head_input" placeholder="Наименование">
		    </div>
		    <div class="prod_count">
		        <input type="number" name="count" class="prod_count head_input" placeholder="Кол-во">
		    </div>
		    <div class="success">
		        <label for="addProdButtonHoz"><i style="cursor: pointer" class="fas fa-check-circle okIcon"></i></label>
		        <input style="display:none;" id="addProdButtonHoz" type="submit" name="submit" value="ОК">
		    </div>
                <input type="hidden" name="formId" value="1">
		    </form>
		    <div class="products form-group">
		        <table class="table">
		            <?php foreach ($goods as $good):
                        if ($good->status == 0) {
                            $goodsStatus0Arr[] = $good;
                        } else {
                            $goodsStatus1Arr[] = $good;
                        }
                    endforeach;
                        foreach ($goodsStatus0Arr as $good):
                    ?>
		                <tr class="status status-<?=$good->status?>">
		                    <form action="" method="post">
		                        <input name="id" type="hidden" value="<?=$good->id?>">

		                        <td>
		                            <div class="name">
		                                <div class="nameFull"><?=$good->name?></div>
		                                <input class="inputProdName form-control" style="display:none;" name="name" type="text" value="<?=$good->name?>">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="count">
		                                <input name="count" class="form-control" type="number" value="<?=$good->count?>">
		                            </div>
		                        </td>
		                        <td>
		                            <input name="status" type="hidden" value="<?=$good->status?>">
		                            <div class="iconOk">
		                                <i data-formId="1" data-name="<?=$good->name?>" data-count="<?=$good->count?>" data-status="<?=$good->status?>" data-id="<?=$good->id?>" style="cursor: pointer" class="fas fa-check-circle okIcon"></i>
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
		                                <i data-formId="1" data-name="<?=$good->name?>" data-count="<?=$good->count?>" data-status="<?=$good->status?>" data-id="<?=$good->id?>" class="fas fa-cart-arrow-down yesIcon"></i>
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
		                                <label for="pDel-<?=$good->id?>"><i class="fas fa-trash-alt delIcon"></i></label>
		                                <input id="pDel-<?=$good->id?>" class="form-control" style="display: none" type="submit" name="del" value="Удалить">
		                            </div>
		                        </td>
                                <input name="formId" type="hidden" value="1">
		                    </form>
		                </tr>
		            <?php endforeach; ?>
                    <?php foreach ($goodsStatus1Arr as $good): ?>
                        <tr class="status status-<?=$good->status?>">
                            <form action="" method="post">
                                <input name="id" type="hidden" value="<?=$good->id?>">

                                <td>
                                    <div class="name">
                                        <div class="nameFull"><?=$good->name?></div>
                                        <input class="inputProdName form-control" style="display:none;" name="name" type="text" value="<?=$good->name?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="count">
                                        <input name="count" class="form-control" type="number" value="<?=$good->count?>">
                                    </div>
                                </td>
                                <td>
                                    <input name="status" type="hidden" value="<?=$good->status?>">
                                    <div class="iconOk">
                                        <label for="pChange-<?=$good->id?>"><i style="cursor: pointer" class="fas fa-check-circle okIcon"></i></label>
                                        <input id="pChange-<?=$good->id?>" class="form-control" style="display: none" type="submit" name="change" value="Изменить">
                                    </div>
                                </td>
                                <td>
                                    <div class="iconOk forHide">

                                    </div>
                                </td>
                                <td>
                                    <div class="iconOk forHide">
                                        <label for="pDel-<?=$good->id?>"><i class="fas fa-trash-alt delIcon"></i></label>
                                        <input id="pDel-<?=$good->id?>" class="form-control" style="display: none" type="submit" name="del" value="Удалить">
                                    </div>
                                </td>
                                <input name="formId" type="hidden" value="1">
                            </form>
                        </tr>
                    <?php endforeach; ?>
		        </table>
		    </div>
		</div>
	</div>
	<div id="panel2" class="tab-pane fade<?php if ($_GET['tabId'] == 2){echo ' active in';} ?>">
		<h3>Для дома</h3>
		<div class="products-form">
		    <form action="" method="post">
			    <div class="prod_name">
			        <input type="text" name="name" class="form-control prod_name head_input" placeholder="Наименование">
			    </div>
			    <div class="prod_count">
			        <input type="number" name="count" class="prod_count head_input" placeholder="Кол-во">
			    </div>
			    <div class="success">
			        <label for="addProdButton"><i style="cursor: pointer" class="fas fa-check-circle okIcon"></i></label>
			        <input style="display:none;" id="addProdButton" type="submit" name="submit" value="ОК">
			    </div>
                <input type="hidden" name="formId" value="2"">
		    </form>
		    <div class="products form-group">
		        <table class="table">
		            <?php foreach ($hGoods as $good):
                        if ($good->status == 0) {
                            $hgoodsStatus0Arr[] = $good;
                        } else {
                            $hgoodsStatus1Arr[] = $good;
                        }
                    endforeach;
                        foreach ($hgoodsStatus0Arr as $good):
                    ?>
		                <tr class="status status-<?=$good->status?>">
		                    <form action="" method="post">
		                        <input name="id" type="hidden" value="<?=$good->id?>">

		                        <td>
		                            <div class="name">
		                                <div class="nameFull"><?=$good->name?></div>
		                                <input class="inputProdName form-control" style="display:none;" name="name" type="text" value="<?=$good->name?>">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="count">
		                                <input name="count" class="form-control" type="number" value="<?=$good->count?>">
		                            </div>
		                        </td>
		                        <td>
		                            <input name="status" type="hidden" value="<?=$good->status?>">
		                            <div class="iconOk">
		                                <label for="pChange-<?=$good->id?>H"><i style="cursor: pointer" class="fas fa-check-circle okIcon"></i></label>
		                                <input id="pChange-<?=$good->id?>H" class="form-control" style="display: none" type="submit" name="change" value="Изменить">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
                                        <i data-formId="2" data-name="<?=$good->name?>" data-count="<?=$good->count?>" data-status="<?=$good->status?>" data-id="<?=$good->id?>" class="fas fa-cart-arrow-down yesIcon"></i>
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
		                                <label for="pDel-<?=$good->id?>H"><i class="fas fa-trash-alt delIcon"></i></label>
		                                <input id="pDel-<?=$good->id?>H" class="form-control" style="display: none" type="submit" name="del" value="Удалить">
		                            </div>
		                        </td>
                                <input name="formId" type="hidden" value="2">
		                    </form>
		                </tr>
		            <?php endforeach; ?>
                    <?php foreach ($hgoodsStatus1Arr as $good): ?>
		                <tr class="status status-<?=$good->status?>">
		                    <form action="" method="post">
		                        <input name="id" type="hidden" value="<?=$good->id?>">

		                        <td>
		                            <div class="name">
		                                <div class="nameFull"><?=$good->name?></div>
		                                <input class="inputProdName form-control" style="display:none;" name="name" type="text" value="<?=$good->name?>">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="count">
		                                <input name="count" class="form-control" type="number" value="<?=$good->count?>">
		                            </div>
		                        </td>
		                        <td>
		                            <input name="status" type="hidden" value="<?=$good->status?>">
		                            <div class="iconOk">
		                                <label for="pChange-<?=$good->id?>H"><i style="cursor: pointer" class="fas fa-check-circle okIcon"></i></label>
		                                <input id="pChange-<?=$good->id?>H" class="form-control" style="display: none" type="submit" name="change" value="Изменить">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
		                                <label for="pDel-<?=$good->id?>H"><i class="fas fa-trash-alt delIcon"></i></label>
		                                <input id="pDel-<?=$good->id?>H" class="form-control" style="display: none" type="submit" name="del" value="Удалить">
		                            </div>
		                        </td>
                                <input name="formId" type="hidden" value="2">
		                    </form>
		                </tr>
		            <?php endforeach; ?>
		        </table>
		    </div>
		</div>
	</div>
	<div id="panel3" class="tab-pane fade<?php if ($_GET['tabId'] == 3){echo ' active in';} ?>">
		<h3>Аптека</h3>
		<div class="products-form">
		    <form action="" method="post">
			    <div class="prod_name">
			        <input type="text" name="name" class="form-control prod_name head_input" placeholder="Наименование">
			    </div>
			    <div class="prod_count">
			        <input type="number" name="count" class="prod_count head_input" placeholder="Кол-во">
			    </div>
			    <div class="success">
			        <label for="addPharmButton"><i style="cursor: pointer" class="fas fa-check-circle okIcon"></i></label>
			        <input style="display:none;" id="addPharmButton" type="submit" name="submit" value="ОК">
			    </div>
                <input type="hidden" name="formId" value="3"">
		    </form>
		    <div class="products form-group">
		        <table class="table">
		            <?php foreach ($pharmacy as $good):
                        if ($good->status == 0) {
                            $pharmacyStatus0Arr[] = $good;
                        } else {
                            $pharmacyStatus1Arr[] = $good;
                        }
                        endforeach;
                        foreach ($pharmacyStatus0Arr as $good):
                    ?>
		                <tr class="status status-<?=$good->status?>">
		                    <form action="" method="post">
		                        <input name="id" type="hidden" value="<?=$good->id?>">

		                        <td>
		                            <div class="name">
		                                <div class="nameFull"><?=$good->name?></div>
		                                <input class="inputProdName form-control" style="display:none;" name="name" type="text" value="<?=$good->name?>">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="count">
		                                <input name="count" class="form-control" type="number" value="<?=$good->count?>">
		                            </div>
		                        </td>
		                        <td>
		                            <input name="status" type="hidden" value="<?=$good->status?>">
		                            <div class="iconOk">
		                                <label for="pChange-<?=$good->id?>Pharm"><i style="cursor: pointer" class="fas fa-check-circle okIcon"></i></label>
		                                <input id="pChange-<?=$good->id?>Pharm" class="form-control" style="display: none" type="submit" name="change" value="Изменить">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
                                        <i data-formId="3" data-name="<?=$good->name?>" data-count="<?=$good->count?>" data-status="<?=$good->status?>" data-id="<?=$good->id?>" class="fas fa-cart-arrow-down yesIcon"></i>
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
		                                <label for="pDel-<?=$good->id?>Pharm"><i class="fas fa-trash-alt delIcon"></i></label>
		                                <input id="pDel-<?=$good->id?>Pharm" class="form-control" style="display: none" type="submit" name="del" value="Удалить">
		                            </div>
		                        </td>
                                <input name="formId" type="hidden" value="3">
		                    </form>
		                </tr>
		            <?php endforeach; ?>
                    <?php foreach ($pharmacyStatus1Arr as $good): ?>
		                <tr class="status status-<?=$good->status?>">
		                    <form action="" method="post">
		                        <input name="id" type="hidden" value="<?=$good->id?>">

		                        <td>
		                            <div class="name">
		                                <div class="nameFull"><?=$good->name?></div>
		                                <input class="inputProdName form-control" style="display:none;" name="name" type="text" value="<?=$good->name?>">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="count">
		                                <input name="count" class="form-control" type="number" value="<?=$good->count?>">
		                            </div>
		                        </td>
		                        <td>
		                            <input name="status" type="hidden" value="<?=$good->status?>">
		                            <div class="iconOk">
		                                <label for="pChange-<?=$good->id?>Pharm"><i style="cursor: pointer" class="fas fa-check-circle okIcon"></i></label>
		                                <input id="pChange-<?=$good->id?>Pharm" class="form-control" style="display: none" type="submit" name="change" value="Изменить">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
		                            </div>
		                        </td>
		                        <td>
		                            <div class="iconOk forHide">
		                                <label for="pDel-<?=$good->id?>Pharm"><i class="fas fa-trash-alt delIcon"></i></label>
		                                <input id="pDel-<?=$good->id?>Pharm" class="form-control" style="display: none" type="submit" name="del" value="Удалить">
		                            </div>
		                        </td>
                                <input name="formId" type="hidden" value="3">
		                    </form>
		                </tr>
		            <?php endforeach; ?>
		        </table>
		    </div>
		</div>
	</div>
</div>

    <script type="text/javascript" src="/uploads/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js?r=4"></script>
</body>
</html>