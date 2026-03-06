<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');


	   
	   




	$d1_start_cdate = date('Y-m-d 00:00:00', strtotime("$start_cdate -1 day"));
    $d1_end_cdate = $start_cdate;






   	$store_id = @$_GET['id'];
	$store_d = mysqli_fetch_assoc(db::query("select * from store where id = $store_id"));


	if (@$_GET['id']) {
		$cashbox_id = $_GET['id'];
		$cashbox = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and store_id = '$store_id'");
	
		if (mysqli_num_rows($cashbox)) {
			$cashbox_d = mysqli_fetch_assoc($cashbox);
			$cashbox_id = $cashbox_d['id'];
		} else {
			$cashbox_id = (mysqli_fetch_assoc(db::query("SELECT * FROM `retail_orders` order by id desc")))['id'] + 1;
			// $ins = db::query("INSERT INTO `retail_orders`(`id`, `сourier_id`, `store_id`) VALUES ('$cashbox_id', '$user_id', '$store_id')");
			$ins = db::query("INSERT INTO `retail_orders`(`id`, `сourier_id`, `store_id`, `ins_dt`) VALUES ('$cashbox_id', '$user_id', '$store_id', '$start_cdate')");
		}
	}

	// $cashboxp = db::query("select * from retail_orders_products where order_id = '$cashbox_id' order by ins_dt asc");
	$number = 0; $total = 0;






	// 
	$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$d1_start_cdate' and '$d1_end_cdate' and store_id = '$store_id'");

	// $stors = db::query("select * from store where order by number desc");



	$allorder['total'] = 0;
	$allorder['number'] = 0;
	$allorder['pay_qr'] = 0;
	$allorder['pay_delivery'] = 0;


	// site setting
	$pod_menu_name = $sort;
	$css = ['item'];
	$js = ['item'];
?>
<? include "../block/header.php"; ?>

<div class="">

		<div class="hil_head">
			<div class="bl_c">

				<div class="hil_headc">

					<h4 class="hil_headc1 txt_c"><?=$store_d['name_kz']?> (<?=$store_d['mkr']?>)</h4>

					<!-- <p><?=mysqli_num_rows($cashbox)?></p> -->
					
					<!-- <div class="hil_headc2">
						<div class="hil_headc2s">
							<span>Заказ саны:</span>
							<p class="pp_number"></p>
						</div>
					</div> -->
					
				</div>

			</div>
		</div>


		<div class="bl_c">

			<? if (mysqli_num_rows($orders)): ?>
				<? $orders_d = mysqli_fetch_assoc($orders); ?>
				<? $order_id = $orders_d['id']; ?>

				<div class="ti_sn">
					<div class="ti_snh">Сатылды:</div>
					<div class="uc_uc">
						<? $products = db::query("select * from retail_orders_products where order_id = '$order_id'"); ?>
						<? while ($sel_d = mysqli_fetch_assoc($products)): ?>
							<? $product_d = product::product($sel_d['product_id']); ?>
							<? if (!$sel_d['quantity']) $sel_d['quantity'] = 0; ?>
							<? $number++; $total = 0; $sum = 0; ?>
							<? if ($sel_d['sell'] > 0) $sum = $sel_d['sell'] * $sel_d['price']; ?>
							<? $total = $total + $sum; ?>
							
							<div class="uc_ui uc_ui2" data-id="<?=$sel_d['id']?>" data-item-id="<?=$product_d['id']?>" data-pr="<?=$sel_d['price']?>" data-qn="<?=$sel_d['quantity']?>" data-sum="<?=$sum?>">
								<div class="uc_uiln">
									<div class="uc_uinu">
										<div class="uc_ui_name"><?=$number?>. <?=$product_d['name_ru']?> <b>- <?=$sel_d['quantity']?> шт</b></div>
									</div>
									<div class="uc_uilf1">
										<div class="uc_uin_other fr_price cashbox_sum"><?=$sum?></div>
									</div>
								</div>
								<div class="uc_uil">
									<div class="uc_uilf1c" data-qn="<?=$sel_d['quantity']?>">
										<div class="uc_uin_other fr_price cashbox_pr"><?=$product_d['price']?></div>
										<div class="uc_uin_other cashbox_qn">х <?=$sel_d['sell']?> шт</div>
									</div>
									<div class="uc_uilf2">
										<div class="uc_uin_cn sell_plus" data-id="<?=$sel_d['id']?>" data-sell="<?=$sel_d['sell']?>" data-max="<?=$sel_d['quantity']?>"><i class="far fa-plus"></i></div>
										<div class="uc_uin_cn sell_minus " data-id="<?=$sel_d['id']?>" data-sell="<?=$sel_d['sell']?>" data-min="0"><i class="far fa-minus"></i></div>
									</div>
								</div>
							</div>
						<? endwhile ?>
					</div>
				</div>

				<div class="ti_sn">
					<div class="ti_snh">Қайтты:</div>
					<div class="uc_uc">
						<? $products = db::query("select * from retail_orders_products where order_id = '$order_id'"); ?>
						<? while ($sel_d = mysqli_fetch_assoc($products)): ?>
							<? $product_d = product::product($sel_d['product_id']); ?>
							<? if (!$sel_d['quantity']) $sel_d['quantity'] = 0; ?>
							<? $number++; $total = 0; $sum = 0; ?>
							<? if ($sel_d['cancel'] > 0) $sum = $sel_d['cancel'] * $sel_d['price']; ?>
							<? $total = $total + $sum; ?>
							
							<div class="uc_ui uc_ui2" data-id="<?=$sel_d['id']?>" data-item-id="<?=$product_d['id']?>" data-pr="<?=$sel_d['price']?>" data-qn="<?=$sel_d['quantity']?>" data-sum="<?=$sum?>">
								<div class="uc_uiln">
									<div class="uc_uinu">
										<div class="uc_ui_name"><?=$number?>. <?=$product_d['name_ru']?> <b>- <?=$sel_d['quantity']?> шт</b></div>
									</div>
									<div class="uc_uilf1">
										<div class="uc_uin_other fr_price cashbox_sum"><?=$sum?></div>
									</div>
								</div>
								<div class="uc_uil">
									<div class="uc_uilf1c" data-qn="<?=$sel_d['quantity']?>">
										<div class="uc_uin_other fr_price cashbox_pr"><?=$product_d['price']?></div>
										<div class="uc_uin_other cashbox_qn">х <?=$sel_d['cancel']?> шт</div>
									</div>
									<div class="uc_uilf2">
										<div class="uc_uin_cn cancel_plus" data-id="<?=$sel_d['id']?>" data-cancel="<?=$sel_d['cancel']?>" data-max="<?=$sel_d['quantity']?>"><i class="far fa-plus"></i></div>
										<div class="uc_uin_cn cancel_minus " data-id="<?=$sel_d['id']?>" data-cancel="<?=$sel_d['cancel']?>" data-min="0"><i class="far fa-minus"></i></div>
									</div>
								</div>
							</div>
						<? endwhile ?>
					</div>
				</div>
			<? else: ?>

			<? endif ?>

			<div class="ti_sn">
				<div class="ti_snh">Тастаймын:</div>
				<div class="uc_uc">
					<? $products = db::query("select * from product order by number asc"); ?>
					<? while ($product_d = mysqli_fetch_assoc($products)): ?>
						<? if (!$sel_d['quantity']) $sel_d['quantity'] = 0; ?>
						<? $number++; $product_id = $product_d['id']; ?>
						<? // $product_d = product::product($sel_d['product_id']); ?>
						<? $cashboxp_d = mysqli_fetch_assoc(db::query("select * from retail_orders_products where order_id = '$cashbox_id' and product_id = $product_id")); ?>
						<? $sum = $cashboxp_d['quantity'] * $product_d['price']; $total = $total + $sum; ?>
						
						<div class="uc_ui uc_ui2" data-id="<?=$sel_d['id']?>" data-item-id="<?=$product_id?>" data-pr="<?=$sel_d['price']?>" data-qn="<?=$sel_d['quantity']?>" data-sum="<?=$sum?>">
							<div class="uc_uiln">
								<div class="uc_uinu">
									<div class="uc_ui_name"><?=$number?>. <?=$product_d['name_ru']?></div>
								</div>
								<div class="uc_uilf1">
									<div class="uc_uin_other fr_price cashbox_sum"><?=$sum?></div>
								</div>
							</div>
							<div class="uc_uil">
								<div class="uc_uilf1c" data-qn="<?=$cashboxp_d['quantity']?>">
									<div class="uc_uin_other fr_price cashbox_pr"><?=$product_d['price']?></div>
									<div class="uc_uin_other cashbox_qn">х <?=$cashboxp_d['quantity']?> шт</div>
								</div>
								<div class="uc_uilf2">
									<div class="uc_uin_cn cashbox_plus" data-cid="<?=$cashbox_id?>" data-pid="<?=$product_d['id']?>" data-id="<?=$cashboxp_d['id']?>"><i class="far fa-plus"></i></div>
									<div class="uc_uin_cn cashbox_minus " data-cid="<?=$cashbox_id?>" data-pid="<?=$product_d['id']?>" data-id="<?=$cashboxp_d['id']?>" data-min="<?=$cashboxp_d['quantity']?>"><i class="far fa-minus"></i></div>
								</div>
							</div>
						</div>
					<? endwhile ?>
				</div>
			</div>

		</div>

	</div>

<? include "../block/footer.php"; ?>
