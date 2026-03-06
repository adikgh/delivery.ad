// start jquery
$(document).ready(function() {

	// btn_return_sn
	$('.btn_return_sn').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?return_sn",
         type: "POST",
         dataType: "html",
         data: ({ id: btn.data('id'), }),
         success: function(data){ 
            if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})



	// 
	$('.on_delete').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?delete",
         type: "POST",
         dataType: "html",
         data: ({ id: btn.data('id'), }),
         success: function(data){ 
            if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})

	// 
	$('.on_check').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?check",
         type: "POST",
         dataType: "html",
         data: ({ id: btn.data('id'), }),
         success: function(data){ 
            if (data == 'yes') {
               btn.parents('.uc_ui').remove()
            }
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


   // 
	$('.on_staff').on('change', function () {
		btn = $(this)
      text = btn.children('option:selected').html()

      $.ajax({
         url: "/orders/get.php?change_staff",
         type: "POST",
         dataType: "html",
         data: ({ 
            id: btn.children('option:selected').attr('data-id'),
            order_id: btn.attr('data-order-id'),
         }),
         success: function(data){ 
            if (data == 'yes') {
               // location.reload();
               btn.parents('.uc_uil2_sel').siblings('.uc_uil2_mi').children('.uc_uil2_mi2').html(text)
            }
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


   // 
	$('.on_status').on('change', function () {
      // id = $(this).children('option:selected').attr('data-id')
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?change_status",
         type: "POST",
         dataType: "html",
         data: ({ 
            id: btn.children('option:selected').attr('data-id'),
            order_id: btn.attr('data-order-id'),
         }),
         success: function(data){ 
            // if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})
   
   
   
   // 
	$('.on_sort_status').on('change', function () {
      var val = $(this).children('option:selected').attr('data-id');
      const url = new URL(window.location);
      url.searchParams.set('status', val); 
      history.pushState(null, null, url);
      location.reload();
	})
   
   // 
	$('.on_sort_staff').on('change', function () {
      var val = $(this).children('option:selected').attr('data-id');
      const url = new URL(window.location);
      url.searchParams.set('staff', val); 
      history.pushState(null, null, url);
      location.reload();
	})
   
   // 
	$('.on_sort_branch').on('click', function () {
      var val = $(this).attr('data-id');
      const url = new URL(window.location);
      url.searchParams.set('branch', val); 
      history.pushState(null, null, url);
      location.reload();
	})




	$('.on_sort_time').on('change', function () {
      var val = $(this).val();
      const url = new URL(window.location);
      url.searchParams.set('time', val);
      history.pushState(null, null, url);
      location.reload();
	})














	$('.on_print').on('click', function () {
      window.open("/orders/" + "order_print.php?" + "&orderID=" + $(this).attr('data-id'), "mywin","width=570,height=570,left=250,top=50");
	})
	// $('.on_print').on('click', function () {

	// })














	// store_add
	$('.store_add_btn').click(function(){
		$('.store_add_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.store_add_back').click(function(){
		$('.store_add_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})

   // store_add
	$('.store_add2').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/orders/get.php?store_add",
         type: "POST",
         dataType: "html",
         data: ({ 
            store_name: $('.store_name').attr('data-val'),
            store_mkr: $('.store_mkr').attr('data-val'),
         }),
         success: function(data){
            location.href = '/orders/item.php?id=' + data;
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


}) // end jquery