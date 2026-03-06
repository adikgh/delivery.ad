<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');
	if (@$user_staff['positions_id'] == 6) {
		$core->user_unset();
		header('location: /');
	}


   	$type = @$_GET['type'];
   	$sort = 'new'; if (@$_GET['sort']) $sort = @$_GET['sort'];
	if (@$_GET['branch']) $branch = @$_GET['branch'];



	$d1_start_cdate = date('Y-m-d 00:00:00', strtotime("$start_cdate -1 day"));
    $d1_end_cdate = $start_cdate;



	// 
	if ($sort == 'new') {
		$menu_name = 'car';
		$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$d1_start_cdate' and '$d1_end_cdate' order by number asc");
	} elseif ($sort == 'history') {
		$menu_name = 'car';
		$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' order by number desc");
	}


	// $stors = db::query("select * from store where order by number desc");
	$stors = db::query("select * from store order by number asc");



	$allorder['total'] = 0;
	$allorder['number'] = 0;
	$allorder['pay_qr'] = 0;
	$allorder['pay_delivery'] = 0;


	// site setting
	$pod_menu_name = $sort;
	$css = ['orders'];
	$js = ['orders'];
?>
<? include "../block/header.php"; ?>

	<div class="">

		<div class="hil_head">
			<div class="bl_c">

				<div class="hil_headc">

					<h4 class="hil_headc1 txt_c">Тарату</h4>

					<div class="hil_fr1 hil_fr2">
						<a class="hil_fr1c <?=($sort == 'new'?'hil_fr1c_act':'')?>" href="/orders/?sort=new">Жаңа</a>
						<a class="hil_fr1c <?=($sort == 'history'?'hil_fr1c_act':'')?>" href="/orders/?sort=history">Тапсырылған</a>
					</div>

					<!-- <div class="hil_headc2">
						<div class="hil_headc2s">
							<span>Заказ саны:</span>
							<p class="pp_number"></p>
						</div>
					</div> -->
					
				</div>

			</div>
		</div>


		<? if ($sort == 'new'): ?>
			<div class="bl_c">
				<div class="new_store_btn">
					<div class="btn store_add_btn">Дүкен қосу</div>
					<div class="btn btn_cl btn_d44"><i class="fas fa-search"></i></div>
				</div>
			</div>
		<? endif ?>


		<div class="bl_c">

			<div class="uc_u">

				<? if ($orders != ''): ?>
					<? if (mysqli_num_rows($orders) != 0): ?>
						<? while ($buy_d = mysqli_fetch_assoc($orders)): ?>
							<? $store_id = $buy_d['store_id']; $store_d = fun::store($store_id); ?>

							<? $order4 = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and store_id = '$store_id'"); ?>
							<? if (mysqli_num_rows($order4) && $sort == 'new'): ?>

							<? else: ?>

								<a class="uc_ui" href="item.php?id=<?=$store_id?>">
									<div class="uc_uil2" >
										<div class="uc_uil2_top">
											<!-- <div class="uc_uil2_nmb"><?=$buy_d['number']?></div> -->
											<div class="uc_uil2_date">
												<div class="uc_uil2_date1"><?=@$store_d['name_kz']?> (<?=@$store_d['mkr']?>)</div>
												<div class=""><?=date("d-m-Y", strtotime($buy_d['ins_dt']))?> ⌛ <?=date("H:i", strtotime($buy_d['ins_dt']))?> <?=($buy_d['preorder_dt']?'| 🔴':'')?>  <?=($buy_d['preorder_dt']?$buy_d['preorder_dt']:'')?></div>
											</div>
										</div>
										<div class="uc_uil2_raz">
											<div class="uc_uil2_trt">
												<div class="uc_uil2_trt1">Атауы</div>
												<div class="uc_uil2_trt2">Саны</div>
												<div class="uc_uil2_trt3">Бағасы</div>
											</div>
											<div class="uc_uil2_trc">

												<? 	
													$cashbox_id = $buy_d['id'];
													$cashboxp = db::query("select * from retail_orders_products where order_id = '$cashbox_id' order by ins_dt asc");
													$number = 0; $total = 0;
												?>
												<? if (mysqli_num_rows($cashboxp) != 0): ?>
													<? while ($sel_d = mysqli_fetch_assoc($cashboxp)): ?>
														<? 
															$number++; 
															$sum = $sel_d['quantity'] * $sel_d['price']; 
															$total = $total + $sum;
															$product_d = product::product($sel_d['product_id']);
														?>
														<div class="uc_uil2_trt">
															<div class="uc_uil2_trt1"><?=$number?>. <?=$product_d['name_ru']?></div>
															<div class="uc_uil2_trt2"><?=$sel_d['quantity']?> шт</div>
															<!-- <div class=""><?=$sel_d['price']?></div> -->
															<div class="uc_uil2_trt3 fr_price"><?=$sum?></div>
														</div>
													<? endwhile ?>
												<? endif ?>
												<div class="uc_uil2_trt">
													<div class="uc_uil2_trt1">Барлығы</div>
													<div class="uc_uil2_trt2">=</div>
													<div class="uc_uil2_trt3 fr_price"><?=$buy_d['total']?></div>
												</div>
												<div class="uc_uil2_trt">
													<div class="uc_uil2_trt1">Предоплата</div>
													<div class="uc_uil2_trt2">-</div>
													<div class="uc_uil2_trt3 fr_price"><?=$buy_d['prepay']?></div>
												</div>
												<div class="uc_uil2_trt">
													<div class="uc_uil2_trt1">Қарызы</div>
													<div class="uc_uil2_trt2">+</div>
													<div class="uc_uil2_trt3 fr_price"><?=$buy_d['duty']?></div>
												</div>
											</div>
											<div class="uc_uil2_trb">
												<div class="uc_uil2_trt1">Төлеу керек</div>
												<div class="uc_uil2_trt2"></div>
												<div class="uc_uil2_trt3 fr_price"><?=$buy_d['total'] + $buy_d['duty'] - $buy_d['prepay']?></div>
											</div>
										</div>

									</div>
								</a>

								<? 
									$allorder['number'] = $allorder['number'] + 1;
									if ($buy_d['order_status'] != 5 && $buy_d['order_status'] != 6) {
										$allorder['pay_delivery'] = $allorder['pay_delivery'] + $buy_d['pay_delivery'] + 500;
									}
								?>
							<? endif ?>

						<? endwhile ?>
					<? else: ?>

						<? if ($sort == 'road'): ?>

							<? while ($buy_d = mysqli_fetch_assoc($stors)): ?>

								<a class="uc_ui" href="item.php?id=<?=$buy_d['id']?>">
									<div class="uc_uil2" >

										<div class="uc_uil2_top">
											<div class="uc_uil2_nmb"><?=$buy_d['number']?></div>
											<div class="uc_uil2_date">
												<div class="uc_uil2_date1"><?=@$buy_d['name_kz']?></div>
												<div class=""><?=@$buy_d['mkr']?></div>
											</div>
										</div>

									</div>
								</a>
								
							<? endwhile ?>
						<? endif ?>
						
					<? endif ?>
				<? else: ?> <div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div> <? endif ?>

			</div>

		</div>

	</div>


	<script>
		$(document).ready(function() {
			$('.pp_number').html('<?=$allorder['number']?> шт');
		})
	</script>

<? include "../block/footer.php"; ?>

	<!--  -->
   	<div class="pop_bl fr store_add_block">
		<div class="pop_bl_a  store_add_back"></div>
		<div class="pop_bl_c">
			<div class="head_c txt_c">
				<h4>Дүкен қосу</h4>
			</div>
			<div class="form_c">
				<div class="form_im">
					<input type="text" class="form_txt store_name" placeholder="Дүкен атауы ..">
					<div class="form_icon"><i class="far fa-text"></i></div>
				</div>
				<div class="form_im">
					<input type="text" class="form_txt store_mkr" placeholder="МКР атауы ..">
					<div class="form_icon"><i class="far fa-text"></i></div>
				</div>
				<div class="form_im">
					<div class="btn store_add2">Сақтау</div>
				</div>
			</div>
		</div>
	</div>