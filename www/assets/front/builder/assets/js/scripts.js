function objectifyForm(formArray) {
	var returnArray = {};
	for (var i = 0; i < formArray.length; i++) {
		returnArray[formArray[i]['name']] = formArray[i]['value'];
	}
	return returnArray;
}
var ewrandomColor = function() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

	function objectFixer(obj) {
		for (var x in obj) {
			x = x;
			if (obj[x] === 'true') {
				obj[x] = true;
			} else if (obj[x] === 'false') {
				obj[x] = false;
			} else if (obj[x] === 'undefined') {
				obj[x] = undefined;
			} else if (!isNaN(Number(obj[x]))) {
				obj[x] = Number(obj[x]);
			}
		}
		return obj;
	}

	function copyToClipboard(element) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}
jQuery(document).ready(function($) {
	var tick = new Audio('assets/media/tick.mp3');
	var color_paletts = ["#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d", "#333", "#424242"];
	if (jQuery().spectrum) {
		$(".colorPicker").each(function() {
			$(this).before('<div class="colorPicker-helper form-control" style="background: ' + $(this).val() + ';">' + $(this).val() + '</div>');
			$(this).closest('.form-group').find('div.colorPicker-helper').colourBrightness();
		})
		$(".colorPicker,#ew-colors").spectrum({
			showPalette: true,
			palette: [color_paletts],
			change: function() {
				if ($(this).is(".colorPicker"))
					$(this).closest('.form-group').find('div.colorPicker-helper').text($(this).val()).css('background', $(this).val()).colourBrightness();
			},
		});
	}
	var onComplete = function(results, count, now) {
		if (typeof results.win !== 'undefined') {
			if (results.win === true) {
				console.log(results.message);
				setTimeout(function() {
					alert(results.message);
				}, 100);
			} else if (results.win === false) {
				console.log(results.message);
				setTimeout(function() {
					alert(results.message);
				}, 100);
			}
		}
	};
	var demoParams = {
		items: [{
				name: '20% OFFz',
				message: 'You win 20% off',
				color: '#3498db',
				win: true
			}, {
				name: 'No luck',
				message: 'You have No luck today',
				color: '#ffc107',
				win: false
			}, {
				name: '30% OFF',
				message: 'You win 30% off',
				color: '#f44336',
				win: true
			}, {
				name: 'Lose',
				message: 'You Lose :(',
				color: '#3498db',
				win: false
			}, {
				name: '40% OFF',
				message: 'You win 40% off',
				color: '#ffc107',
				win: true
			}, {
				name: 'Nothing',
				message: 'You get Nothing :(',
				color: '#f44336',
				win: false
			}
		],
		centerImage: "./assets/images/easyWheelText.png",
		selected: $('select.select-winner'),
		onStep: function(item, slicePercent, circlePercent) {
			if (typeof tick.currentTime !== 'undefined')
				tick.currentTime = 0;
			tick.play();
		},
		onComplete: onComplete
	};
	$('select.select-winner').html('');
	$.each(demoParams.items, function(i, item) {
		$('select.select-winner').append('<option value="' + i + '">' + item.name + '</option>');
	});
	$('.home_spinner').easyWheel(demoParams);
	var demo_spinner = $('.demo_spinner');
	demo_spinner.easyWheel(demoParams);
	$('body').on('click', '.start', function(e) {
		
		demo_spinner.easyWheel('start');
		alert("started");
	});
	$('body').on('click', '.finish', function(e) {
		demo_spinner.easyWheel('finish');
	});
	var applyChanges = function(form) {
		var items = [];
		var colors = [];
		$('select.select-winner').html('');
		form.find('input.items').each(function(i) {
			var item = {};
			item.name = $.trim($(this).val()) === '' ? 'Unspecified' : $(this).val();
			item.color = $.trim($(this).closest('._item').find('input#ew-colors').val()) === '' ? '#333' : $(this).closest('._item').find('input#ew-colors').val();
			item.message = $.trim($(this).closest('._item').find('input#ew-message').val()) === '' ? '#333' : $(this).closest('._item').find('input#ew-message').val();
			items.push(item);
			$('select.select-winner').append('<option value="' + i + '">' + item.name + '</option>');
		});
		form.find('input.disabled').prop('disabled', false);
		var formObj = objectifyForm(form.serializeArray());
		form.find('input.disabled').prop('disabled', true);
		var newParams = $.extend({}, demoParams, formObj);
		newParams = objectFixer(newParams);
		newParams.items = items;
		newParams.onComplete = onComplete;
		delete newParams.colors;
		delete newParams.messages;
		$('.demo_spinner').easyWheel('destroy', true);
		$('.demo_spinner').easyWheel(newParams);
		delete newParams.selected;
		delete newParams.centerImage;
		var string = JSON.stringify(newParams, null, 4).replace(/\\"/g, '');
		string = string.replace(/"(\w+)"\s*:/g, '$1:');
		$('pre.code>code').text('$(".easyWheel").easyWheel( ' + string + ');');
		Prism.highlightElement($('pre.code>code')[0]);
		$('.testarcprogress').css('width', '0%').attr('aria-valuenow', '0').text('0%');
		$('.testprogress').css('width', '0%').attr('aria-valuenow', '0').text('0%');
	};
	$('#WheelGenForm').on('submit', function(e) {
		e.preventDefault();
	}).on('blur', 'select,input', function(e) {
		applyChanges($(this).closest('form#WheelGenForm'));
	}).on('click', '.wheelGenBtn', function(e) {
		e.preventDefault();
		applyChanges($(this).closest('form#WheelGenForm'));
	});
	$('.addSlice').on('click', function(e) {
		e.preventDefault();
		var i = $('.slices-list>._item').length;
		if (i >= 20) {
			alert('limit reached');
			return;
		}
		var html = '<div class="_item col-sm-6">' +
			'<div class="form-group">' +
			'<div class="input-group">' +
			'<input type="text" value="Slice text" name="items" id="ew-centerImage" class="form-control items" placeholder="Slice Text here">' +
			'<div class="input-group-btn">' +
			'<input class="_color color_new" id="ew-colors" name="colors" value="' + ewrandomColor() + '">' +
			'<div class="btn-group">' +
			'<a href="#0" class="btn btn-danger remove"><i class="glyphicon glyphicon-trash"></i></a>' +
			'</div>' +
			'</div>' +
			'</div>' +
			'</div>' +
			'</div>';
		$('.slices-list>._item').eq(i - 1).after(html);
		if (jQuery().spectrum) {
			$('.slices-list>._item').eq(i).find('.color_new').spectrum({
				showPalette: true,
				palette: [color_paletts]
			}).removeClass('.color_new');
		} else {
			$('.slices-list>._item').eq(i).find('.color_new').removeClass('.color_new');
		}
		applyChanges($(this).closest('form#WheelGenForm'));
	});
	$('.slices-list').on('click', '.remove', function(e) {
		e.preventDefault();
		var form = $(this).closest('form#WheelGenForm');
		$(this).closest('._item').remove();
		applyChanges(form);
	});
	$('#WheelGenForm').on('click', '.copyCode', function(e) {
		e.preventDefault();
		copyToClipboard('pre.code>code');
	});
});