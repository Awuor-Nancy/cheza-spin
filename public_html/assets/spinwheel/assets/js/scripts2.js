 var log = console.log; jQuery(document).ready(function($){  
$('.wheel').superWheel({
	slices: [
		{
			text: "20% OFF",
			value: 1,
			message: "You win 20% off",
			background: "#424242",
			color: "#e74c3c"
		},
		{
			text: "No luck",
			value: 0,
			message: "You have No luck today",
			background: "#333",
			color: "#fff"
		},
		{
			text: "30% OFF",
			value: 1,
			message: "You win 30% off",
			background: "#424242",
			color: "#fff"
		},
		{
			text: "Lose",
			value: 0,
			message: "You Lose :(",
			background: "#333",
			color: "#fff"
		},
		{
			text: "40% OFF",
			value: 1,
			message: "You win 40% off",
			background: "#424242",
			color: "#fff"
		},
		{
			text: "Nothing",
			value: 0,
			message: "You get Nothing :(",
			background: "#333",
			color: "#fff"
		}
	],
	width: 400,
	frame: 1,
	type: "spin",
	text: {
		color: "#ccc",
		size: 14,
		offset: 8,
		arc: false
	},
	line: {
		color: "#939393"
	},
	outer: {
		color: "#939393"
	},
	inner: {
		color: "#939393"
	},
	center: {
		rotate: true
	},
	marker: {
		animate: "true"
	}
});


$(document).on('click','.spin_button',function(e){
  e.preventDefault();
  $('.wheel').superWheel('start','value',0);
});	
	var tick = new Audio('assets/media/tick.mp3');
	$('.wheel').superWheel('onStep',function(results){
		
		if (typeof tick.currentTime !== 'undefined')
			tick.currentTime = 0;
        
		tick.play();
		
	});
	
});