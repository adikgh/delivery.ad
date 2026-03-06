<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');
	if (@$user_staff['positions_id'] == 6) {
		$core->user_unset();
		header('location: /');
	}


	// site setting
	$menu_name = 'store';
	$css = ['orders'];
	$js = ['orders'];
?>
<? include "../block/header.php"; ?>

	<div class="">

		<div class="hil_head">
			<div class="bl_c">
				<div class="hil_headc">
					<h4 class="hil_headc1 txt_c">Дүкендер</h4>
				</div>
			</div>
		</div>

		<div class="bl_c">
			<div class="new_store_btn">
				<div class="btn btn_cl">
					<i class="fas fa-search"></i>
					<span>Іздеу</span>
				</div>
			</div>
			<div class="new_store_btn">
				<div class="btn store_add_btn">Дүкен қосу</div>
			</div>
		</div>


		<div class="bl_c">

			<div class="uc_u">
				
				<? $stors = db::query("select * from store order by number asc"); ?>
				<? while ($buy_d = mysqli_fetch_assoc($stors)): ?>

					<a class="uc_ui" href="/orders/item.php?id=<?=$buy_d['id']?>">
						<div class="uc_uil2" >

							<div class="uc_uil2_top">
								<div class="uc_uil2_date">
									<div class="uc_uil2_date1"><?=@$buy_d['name_kz']?></div>
									<div class=""><?=@$buy_d['mkr']?></div>
								</div>
							</div>

						</div>
					</a>
					
				<? endwhile ?>

			</div>

		</div>

	</div>

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