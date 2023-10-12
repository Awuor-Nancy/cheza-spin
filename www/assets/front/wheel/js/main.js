//function to fetch bal
var site_url = 'https://spin-wingame.com';
var user_bal = 0;
function update_game_ui($user_bal){
    //update balance
    $(".user_bal").html('Bal: Ksh '+$user_bal);
    
    //update buttons
    $(".ui-button").removeClass("disabled");
    if(parseInt($user_bal) < 20){
        $(".twenty").addClass("disabled");
        $('.fifty').addClass("disabled");
        $(".one_h").addClass("disabled");
        $(".two_h").addClass("disabled");
        $(".five_h").addClass("disabled");
        $(".one_t").addClass("disabled");
    }
    if(parseInt($user_bal) < 50){
        $('.fifty').addClass("disabled");
        $(".one_h").addClass("disabled");
        $(".two_h").addClass("disabled");
        $(".five_h").addClass("disabled");
        $(".one_t").addClass("disabled");
        
    }
    if(parseInt($user_bal) < 100){
        $(".one_h").addClass("disabled");
        $(".two_h").addClass("disabled");
        $(".five_h").addClass("disabled");
        $(".one_t").addClass("disabled");
    }
    if(parseInt($user_bal) < 200){
        $(".two_h").addClass("disabled");
        $(".five_h").addClass("disabled");
        $(".one_t").addClass("disabled");
    }
    if(parseInt($user_bal) < 500){
        $(".five_h").addClass("disabled");
        $(".one_t").addClass("disabled");
    }
    
    if(parseInt($user_bal) < 1000){
        $(".one_t").addClass("disabled");
    }
    
    
    
}

function update_user_bal(amnt){
    var data = new FormData();
    data.append("CSF", "xx5674839");
    data.append("amt", amnt);
    $.ajax({
    
	  type: "POST",
	  enctype: 'multipart/form-data',
	  url: site_url+"/home/update_user_bal",
	  data: data,
	  processData: false,
	  contentType: false,
	  cache: false,
	  timeout: 800000,
	  success: function(data) {
		const obj = JSON.parse(data);
		if (obj.code == 1) {
		    //$user_bal = obj.bal
		    //update_game_ui($user_bal)
		}
		if (obj.code == 2) {
		  $("#register_button_spin").html('Bal: Ksh 0.00');
		  //window.location.href = "<?php echo site_url(); ?>";
		}

		
		console.log("SUCCESS : ", data);
		$("#register_button").prop("disabled", false);
		
	  },

	  error: function(e) {

		console.log("ERROR : ", e);

	  }

	}); //end ajax
}

function get_user_bal(){
    	var data = new FormData();
        data.append("CSF", "xx5674839");

    	$.ajax({
    
    	  type: "POST",
    	  enctype: 'multipart/form-data',
    	  url: site_url+"/home/get_user_bal",
    	  data: data,
    	  processData: false,
    	  contentType: false,
    	  cache: false,
    	  timeout: 800000,
    	  success: function(data) {
    		const obj = JSON.parse(data);
    		if (obj.code == 1) {
    		    $user_bal = obj.bal
    		    update_game_ui($user_bal)
    		}
    		if (obj.code == 2) {
    		  $("#register_button_spin").html('Bal: Ksh 0.00');
    		  //window.location.href = "<?php echo site_url(); ?>";
    		}

    		
    		console.log("SUCCESS : ", data);
    		$("#register_button").prop("disabled", false);
    		
    	  },
    
    	  error: function(e) {

    		console.log("ERROR : ", e);

    	  }
    
    	}); //end ajax
}// end get user bal

prevChoise = null;
Array.prototype.random = function () {
	var choose = true;
	var choise;
	while (choose)
	{
		choise = Math.floor((Math.random()*this.length))
		if (choise != prevChoise) {
			//console.log('prech is'+prevChoise+' so choose '+choise);
			prevChoise = choise;
			break;
		}
	}
  
  return this[choise];
}

var list = ['#9fff33','#4cdfe3','#d84ce3','#4c6ae3','#e6e600','#a366ff','#E74C3C'];
var selected_amount = 0;


jQuery(document).ready(function($) {
    $('.wheel-horizontal-spin-button').prop('disabled', true);
    get_user_bal();
    
    		
	$(".ui-button").on("click", function() {
	    $(".ui-button").removeClass("ui-button-active");
	    if($(this).hasClass( "disabled" ) ) {
	        $('.wheel-horizontal-spin-button').prop('disabled', true);
	        swal_disabled();
	    }else{
	       $(this).addClass("ui-button-active");
	       selected_amount = parseInt($(this).html());
	       $('.wheel-horizontal-spin-button').prop('disabled', false);
	       $('.wheel-horizontal-spin-button').prop('title', 'Spin to win');
	    }
      
      
    });
    
    
    $('.wheel-horizontal').superWheel({
        slices: [{
			text: 'X1',
			message: 'You have been refunded',
			background: list.random(),
			value: 1
		}, {
			text: 'X2',
			message: 'You win X2',
			background: list.random(),
			value: 1
		}, {
			value: 1,
			text: 'X3',
			message: 'You win X3',
			background: list.random(),
			win: 0
		}, {
			text: 'X4',
			message: 'You win X4',
			background: list.random(),
			color: '#fff',
			value: 1
		}, {
			text: 'X5',
			message: 'You win X5',
			background: list.random(),
			value: 1
		}, {
			text: 'X10',
			message: 'You win X10',
			background: list.random(),
			value: 2
		}, {
			text: 'X20',
			message: 'You win X20',
			background: list.random(),
			value: 1
		}, {
			text: 'X50',
			message: 'You win X50',
			background: list.random(),
			value: 1
		}, {
			text: 'X100',
			message: 'You win X100',
			background: list.random(),
			value: 1
		}, {
			text: 'X0',
			message: 'You Lose, Try Again',
			background: list.random(),
			value: 0
		}],
        text: {
            color: '#fff',
			offset: 8,
			letterSpacing: 0,
			orientation: 'v',
			arc: true
		},

		slice: {
			background: "#333",
		},

		line: {
			width: 6,
			color: "#fefefe",
		},

		outer: {
			width: 10,
			color: "#fefefe",
		},

		inner: {
			width: 8,
			color: "#fefefe",
		},
        marker: {
            background: "#00BCD4"
        },
        selector: "value"
    });
    var tick = new Audio('media/tick.mp3');
    $(document).on('click', '.wheel-horizontal-spin-button', function(e) {
        $("html, body").animate({ scrollTop: "0" }, 700);
        update_user_bal(selected_amount);
        $(".ui-button").removeClass("ui-button-active");
        $('.wheel-horizontal').superWheel('start', 'value', 0);
        $(this).prop('disabled', true);
        
    });
    $('.wheel-horizontal').superWheel('onStart', function(results) {
        $('.wheel-horizontal-spin-button').text('Spinning...');
    });
    $('.wheel-horizontal').superWheel('onStep', function(results) {
        if (typeof tick.currentTime !== 'undefined')
            tick.currentTime = 0;
        tick.play();
    });
    $('.wheel-horizontal').superWheel('onComplete', function(results) {
        get_user_bal();
        
        if (results.value === 1) {
            swal({
                type: 'success',
                title: "Congratulations!",
                html: results.message + ' <br><br><b>Discount : [ ' + results.discount + ' ]</b>'
            });
        } else {
            swal("Try Again", results.message, "error");
        }
        $('.wheel-horizontal-spin-button:disabled').prop('disabled', true).text('Spin');
        $('.wheel-horizontal-spin-button').prop('title', 'Select Amount Above');
    });
	
	
});