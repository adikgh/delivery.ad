// start jquery
$(document).ready(function() {

	
   // cashbox_remove
	$('.sell_plus').on('click', function () {
		btn = $(this)
      if (btn.data('max') > btn.data('sell')) {
         $.ajax({
            url: "/orders/get.php?sell_plus",
            type: "POST",
            dataType: "html",
            data: ({ id: btn.data('id'), }),
            success: function(data){ 
               if (data == 'yes') location.reload();
               else console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ }
         })
      } else mess('Қайда тығып жатсын');
	})

   // cashbox_remove
	$('.sell_minus').on('click', function () {
		btn = $(this)
      if (btn.data('min') < btn.data('sell')) {
         $.ajax({
            url: "/orders/get.php?sell_minus",
            type: "POST",
            dataType: "html",
            data: ({ id: btn.data('id'), }),
            success: function(data){ 
               if (data == 'yes') location.reload();
               else console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ }
         })
      } else mess('Қайда тығып жатсын');
	})





   // cashbox_remove
	$('.cancel_plus').on('click', function () {
		btn = $(this)
      if (btn.data('max') > btn.data('cancel')) {
         $.ajax({
            url: "/orders/get.php?cancel_plus",
            type: "POST",
            dataType: "html",
            data: ({ id: btn.data('id'), }),
            success: function(data){ 
               if (data == 'yes') location.reload();
               else console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ }
         })
      } else mess('Қайда тығып жатсын');
	})

   // cashbox_remove
	$('.cancel_minus').on('click', function () {
		btn = $(this)
      if (btn.data('min') < btn.data('cancel')) {
         $.ajax({
            url: "/orders/get.php?cancel_minus",
            type: "POST",
            dataType: "html",
            data: ({ id: btn.data('id'), }),
            success: function(data){ 
               if (data == 'yes') location.reload();
               else console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ }
         })
      } else mess('Қайда тығып жатсын');
	})




   // cashbox_remove
	$('.cashbox_plus').on('click', function () {
		btn = $(this)
      // if (btn.data('max') > btn.data('cancel')) {
         $.ajax({
            url: "/orders/get.php?cashbox_plus",
            type: "POST",
            dataType: "html",
            data: ({ 
               id: btn.data('id'),
               cid: btn.data('cid'),
               pid: btn.data('pid'),
            }),
            success: function(data){ 
               if (data == 'yes') location.reload();
               else console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ }
         })
      // } else mess('Қайда тығып жатсын');
	})

   // cashbox_remove
	$('.cashbox_minus').on('click', function () {
		btn = $(this)
      if (btn.data('min') > 0) {
         $.ajax({
            url: "/orders/get.php?cashbox_minus",
            type: "POST",
            dataType: "html",
            data: ({ 
               id: btn.data('id'),
               cid: btn.data('cid'),
               pid: btn.data('pid'),
            }),
            success: function(data){ 
               if (data == 'yes') location.reload();
               else console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ }
         })
      } else mess('Қайда тығып жатсын');
	})














}) // end jquery