<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="<?php echo base_url('assets/spinwheel/');?>assets/css/bootstrap.css?<?php echo md5(uniqid(rand(), true)); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/spinwheel/');?>vendor/font-awesome/css/font-awesome.min.css?<?php echo md5(uniqid(rand(), true)); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/spinwheel/');?>vendor/spectrum/spectrum.css?<?php echo md5(uniqid(rand(), true)); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/spinwheel/');?>vendor/prism.css?<?php echo md5(uniqid(rand(), true)); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/spinwheel/');?>dist/superwheel.css?<?php echo md5(uniqid(rand(), true)); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/spinwheel/');?>assets/css/builder.css?<?php echo md5(uniqid(rand(), true)); ?>">
<script src="<?php echo base_url('assets/spinwheel/');?>assets/js/jquery-3.3.1.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>assets/js/bootstrap.bundle.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>vendor/serializejson.min.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>assets/js/jquery.easing.1.3.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>vendor/spectrum/spectrum.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>vendor/jquery.colourbrightness.min.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>vendor/prism-min.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>dist/superwheel.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>assets/js/builder.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>assets/js/main.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
<script src="<?php echo base_url('assets/spinwheel/');?>assets/js/scripts2.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>


<title></title>
</head>
<body>
<style>

</style>
<div id="wrapper" class="open">
<div class="container-fluid">
<div class="row">
<div class="col-md-3 sidebar">
<div class="sidebar-sticky builder">
<div class="list-group list-group-flush card" id="menu">
<a class="list-group-item list-group-item-action accord" href="#slices">
Slices
</a>
<a class="list-group-item list-group-item-action accord" href="#slices-settings">
Slices Settings
</a>
<a class="list-group-item list-group-item-action accord" href="#text">
Text Settings
</a>
<a class="list-group-item list-group-item-action accord" href="#line">
Slice Line
</a>
<a class="list-group-item list-group-item-action accord" href="#outer">
Outer Line
</a>
<a class="list-group-item list-group-item-action accord" href="#inner">
Inner Line
</a>
<a class="list-group-item list-group-item-action accord" href="#center">
Center
</a>
<a class="list-group-item list-group-item-action accord" href="#marker">
Marker
</a>
<a class="list-group-item list-group-item-action accord" href="#settings">
Settings
</a>
</div>
<div id="form_holder">
  <?php echo $backend_form; ?>  
</div>
 
</div>
</div>
<main role="main" id="content" class="col-md-9 ml-sm-auto col-lg-9 pt-3 px-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<h1 class="h2">Wheel Settings</h1>
<div class=" mb-2">

</div>
</div>
<div class="text-center">
<div class="wheel"></div>
<button type="button" class="btn btn-success spin_button spin-to-win" style="box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);">Test Spin</button>
<button type="button" class="btn btn-success save-data" style="box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);">Save Data</button>
<div class="statusMsg"></div>
</div>
<div class="panel-body code-generated" style="height: 1px; overflow: hidden;">
<pre><code class="language-javascript"><?php echo $frontend_script; ?></code></pre>
</div>
</main>
</div>
</div>
<div class="col-md-3 col-lg-3 mr-0 customize-footer-actions">
<a href="#" class="hide-sidebar text-bold">
<span class="collapse-sidebar-label s-hide"><i class="fa fa-arrow-left fa-fw"></i></span>
<span class="collapse-sidebar-label s-show"><i class="fa fa-arrow-right fa-fw"></i></span>

</a>
</div>
</div>
<script type="text/javascript">
var log = console.log;

jQuery(document).ready(function($){
    
     <?php //echo $frontend_script; ?>

	$('.wheel').superWheel('onStep',function(results){
		
		if (typeof tick.currentTime !== 'undefined')
			tick.currentTime = 0;
        
		tick.play();
		
	});
    
$('.save-data').on('click', function(e){
        $('.statusMsg').html('');
        //alert('clicked');
        //console.log($('.code-generated>pre>code').text());
        var res = $('#form_holder').html();
        //console.log(res);
        //alert(res);
        e.preventDefault();
        jsondata= new FormData();
		jsondata.append("frontend_script", $('.code-generated>pre>code').text());
		jsondata.append("backend_form", res);
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url().'/admin/spin_wheel_settings/save_demo_wheel'; ?>',
			data: jsondata,
			dataType: 'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){
				$('.submitBtn').attr("disabled","disabled");
				$('#orderform').css("opacity",".5");
			},
			success: function(response){ //
			    console.log(response);
				$('.statusMsg').html('');
				if(response.status == 'saved'){
					$('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
				}else{
					$('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
				}
				$('#orderform').css("opacity","");
				$(".submitBtn").removeAttr("disabled");
			}
		});
    });
   
	
});


</script>
</body>

</html>
