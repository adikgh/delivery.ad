<? if ($site_set['menu']): ?>
   <div class="pmenu">
		<div class="pmenu_c">
			<a class="pmenu_i txt_c <?=($menu_name=='car'?'pmenu_i_act':'')?>" href="/orders/?sort=new">
				<i class="far fa-car"></i>
				<span>Тарату</span>
			</a>
			<a class="pmenu_i <?=($menu_name=='store'?'pmenu_i_act':'')?>" href="/store/">
				<i class="far fa-search"></i>
				<span>Дүкендер</span>
			</a>
			<!-- 
			<a class="pmenu_i <?=($menu_name=='coffee'?'pmenu_i_act':'')?>" href="/orders/?sort=coffee">
				<i class="far fa-store"></i>
				<span>Кофе</span>
			</a>
			<a class="pmenu_i <?=($menu_name=='none'?'pmenu_i_act':'')?>" href="/orders/?sort=none">
				<i class="far fa-times-circle"></i>
				<span>Отказ</span>
			</a> -->
			<a class="pmenu_i <?=($menu_name=='acc'?'pmenu_i_act':'')?>" href="/acc/">
				<i class="far fa-user"></i>
				<span>Аккаунт</span>
			</a>
		</div>
   </div>
<? endif ?>