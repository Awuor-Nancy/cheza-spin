//function to fetch bal
var site_url = 'https://spin-wingame.com';
var user_bal = 0;
var count_demo = 0;
function update_game_ui($user_bal){
    //update balance
    $(".user_bal").html('Bal: Ksh '+$user_bal);
    
    //update buttons
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

function update_user_bal(amnt, multiplier){
    amnt = parseInt(amnt);
    count_demo++;
    multiplier = parseInt(multiplier);
    demo_bal = parseInt(localStorage.getItem("demo_bal"));
    if(multiplier == 0){
        //Cookies.set('demo_bal', demo_bal - amnt, { expires: 7, path: '' });
        localStorage.setItem("demo_bal", demo_bal - amnt);
    }else{
        amnt = amnt * multiplier;
        localStorage.setItem("demo_bal", demo_bal + amnt);
        //Cookies.set('demo_bal', demo_bal + amnt, { expires: 7, path: '' });
    }
    

}

function get_user_bal(){
    
    //if(Cookies.get('demo_bal') === null){
    if(localStorage.getItem("demo_bal") === null){
        localStorage.setItem("demo_bal", 5000);
	    //Cookies.set('demo_bal', 5000, { expires: 7, path: '' });
	    swal({
            type: 'success',
            title: "Hi there!",
            html: 'We have given you Ksh 5000 for Demo'
        });
	}
	
	if(localStorage.getItem("demo_bal") < 500){
        localStorage.setItem("demo_bal", 5000);
	    //Cookies.set('demo_bal', 5000, { expires: 7, path: '' });
	    swal({
            type: 'success',
            title: "Hi there!",
            html: 'We have given you Ksh 5000 for Demo'
        });
	}
	
	if(localStorage.getItem("demo_bal") > 500000){
	    localStorage.setItem("demo_bal", 5000);
	    //Cookies.set('demo_bal', 5000, { expires: 7, path: '' });
	}
	
	$user_bal = localStorage.getItem("demo_bal");
    update_game_ui($user_bal)

    	
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
    	    	    // Set a cookie
	if(Cookies.get('demo_bal') < 500){
	    Cookies.set('demo_bal', 5000, { expires: 7, path: '' });
	}

    
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
			multiplier: 1,
			value: 1
		}, {
			text: 'X2',
			message: 'You win X2',
			background: list.random(),
			multiplier: 2,
			value: 1
		}, {
			value: 1,
			text: 'X3',
			message: 'You win X3',
			background: list.random(),
			multiplier: 3,
			win: 0
		}, {
			text: 'X4',
			message: 'You win X4',
			background: list.random(),
			color: '#fff',
			multiplier: 4,
			value: 1
		}, {
			text: 'X5',
			message: 'You win X5',
			background: list.random(),
			multiplier: 5,
			value: 1
		}, {
			text: 'X10',
			message: 'You win X10',
			background: list.random(),
			multiplier: 10,
			value: 2
		}, {
			text: 'X20',
			message: 'You win X20',
			background: list.random(),
			multiplier: 20,
			value: 1
		}, {
			text: 'X50',
			message: 'You win X50',
			background: list.random(),
			multiplier: 50,
			value: 1
		}, {
			text: 'X100',
			message: 'You win X100',
			background: list.random(),
			multiplier: 100,
			value: 1
		}, {
			text: 'X0',
			message: 'You Lose, Try Again',
			background: list.random(),
			multiplier: 0,
			value: 1
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

        if(count_demo > 7){
           swal({
                type: 'success',
                title: "Demo is over",
                html: 'Login to continue'
            });
            
            return false;
        }
        $("html, body").animate({ scrollTop: "0" }, 700);
        $(".ui-button").removeClass("ui-button-active");
        $('.wheel-horizontal').superWheel('start', 'value', 1);
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
        update_user_bal(parseInt(selected_amount), results.multiplier);
        get_user_bal();
        if(results.multiplier == 0){
            //Cookies.set('demo_bal', Cookies.get('demo_bal') - amnt, { expires: 7, path: '' });
            swal("Try Again", results.message, "error");
        }else{
            var amnt_won = selected_amount * results.multiplier;
            swal({
                type: 'success',
                title: "Congratulations!",
                html: 'You have won Ksh' + amnt_won
            });
            new confettiKit({
                confettiCount: 70,
                angle: 90,
                startVelocity: 50,
                colors: randomColor({hue: 'blue',count: 18}),
                elements: {
                    'confetti': {
                        direction: 'down',
                        rotation: true,
                    },
                    'star': {
                        count: 10,
                        direction: 'down',
                        rotation: true,
                    },
                    'ribbon': {
                        count: 5,
                        direction: 'down',
                        rotation: true,
                    },
                    'custom': [{
                        count: 1,
                        width: 50,
                        textSize: 15,
                        content: 'https://spin-wingame.com/assets/images/1194986736244974413balloon-red-aj.svg.thumb.png',
                        contentType: 'image',
                        direction: 'up',
                        rotation: false,
                    }]
                },
                position: 'bottomLeftRight',
            });
            
            setTimeout(function(){
                new confettiKit({
                    colors:randomColor({hue:'pink',count: 18}),
                    confettiCount: 70,
                    angle: 90,
                    startVelocity: 50,
                    elements: {
                        'confetti': {
                            direction: 'down',
                            rotation: true,
                        },
                        'star': {
                            count: 10,
                            direction: 'down',
                            rotation: true,
                        },
                        'ribbon': {
                            count: 5,
                            direction: 'down',
                            rotation: true,
                        },
                    },
                    position: 'topLeftRight',
                });
                
            }, 500);
            
        }
        
        if (results.value === 1) {
            
        } else {
            //swal("Try Again", results.message, "error");
        }
        $('.wheel-horizontal-spin-button:disabled').prop('disabled', true).text('Spin');
        $('.wheel-horizontal-spin-button').prop('title', 'Select Amount Above');
    });
	
	
});