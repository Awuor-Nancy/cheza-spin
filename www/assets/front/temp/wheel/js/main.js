prevChoise = null;
Array.prototype.random = function () {
	var choose = true;
	var choise;
	while (choose)
	{
		choise = Math.floor((Math.random()*this.length))
		if (choise != prevChoise) {
			console.log('prech is'+prevChoise+' so choose '+choise);
			prevChoise = choise;
			break;
		}
	}
  
  return this[choise];
}

var list = ['#364C62','#9575CD','#E67E22','#364C62','#9575CD','#E67E22','#E74C3C'];


jQuery(document).ready(function($) {
    $('.wheel-horizontal').superWheel({
        slices: [{
			text: 'X0.5',
			message: 'You win 50%',
			background: list.random(),
			value: 1
		}, {
			text: 'X1',
			message: 'You have been refunded',
			background: list.random(),
			value: 0
		}, {
			text: 'X2',
			message: 'You win X2',
			background: list.random(),
			value: 1
		}, {
			value: 2,
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
        $('.wheel-horizontal').superWheel('start', 'value', 2);
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
        if (results.value === 1) {
            swal({
                type: 'success',
                title: "Congratulations!",
                html: results.message + ' <br><br><b>Discount : [ ' + results.discount + ' ]</b>'
            });
        } else {
            swal("Congratulations", results.message, "success");
        }
        $('.wheel-horizontal-spin-button:disabled').prop('disabled', false).text('Spin');
    });
	
	
});