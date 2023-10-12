<?php
$user = '';
$phone = '';
if(isset($_SESSION['logged_in_user'])) {
    //echo "running live".$_SESSION['logged_in_user_phone'];
    $user = $_SESSION['logged_in_user_name'];
    $phone = $_SESSION['logged_in_user_phone'];
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Spin And Win Kenya - Spin the Wheel, Earn Real Cash - SpinToWin</title>
	<meta name="description" content="Spin and Win in Kenya. Free spins on registration, no deposit required. Choose your stake and Spin to Win cash instantly. Join Now!">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!---Font Icon-->
	<link href="<?php echo base_url('assets/front/');?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/');?>font/flaticon.css" rel="stylesheet">
	<!-- / -->

	<!-- Plugin CSS -->
	<link href="<?php echo base_url('assets/front/');?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/');?>css/slick.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/');?>css/animate.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/');?>css/magnific-popup.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/');?>css/YouTubePopUp.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/front/');?>css/menu.css?74839jj">
	<!-- / -->
	<!-- Favicon -->
	<link rel="icon" href="<?php echo base_url('');?>new-tpl/imgs/favicon.png" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
	<link href='https://fonts.googleapis.com/css2?family=Lato:wght@300;400;900&amp;family=Roboto+Condensed:wght@300;700&amp;display=swap' rel='stylesheet' type='text/css'>
	<!-- / -->
	<!-- Theme Style -->
	<link href="<?php echo base_url('assets/front/');?>css/style.css?<?php echo md5(uniqid(rand(), true)); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/');?>css/responsive.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/');?>css/marquee.css?<?php echo md5(uniqid(rand(), true)); ?>" rel="stylesheet">
	
	<!-- wheel of fortune Style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/front/');?>wheel/css/reset.css"> 
	<link rel="stylesheet" href="<?php echo base_url('assets/front/');?>wheel/css/sweetalert2.min.css"> 
	<link rel="stylesheet" href="<?php echo base_url('assets/front/');?>wheel/css/superwheel.min.css"> 
	<link rel="stylesheet" href="<?php echo base_url('assets/front/');?>wheel/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/front/');?>wheel/css/new.css">

	<!-- Google Analitics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-54021233-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-54021233-4');
    </script>
</head>

<body>
	<!-- Header -->
	<section id="header">
		<!-- NAV AREA CSS -->
		<nav id="nav-part" class="navcss2 navbar header-nav other-nav custom_nav full_nav sticky-top navbar-expand-md hidden-main">
			<div class="container">
				<a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url(); ?>new-tpl/imgs/swgame.png" class="img-fluid" width="200"  alt="SPINTOWINKENYA"></a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<div class="nav-res">
						<ul class="nav navbar-nav m-auto menu-inner fa-time">
							<!-- <li><a href="#banner" class="active">Spin Now</a></li> -->
							<li><a href="#how">How to play</a></li>
							<!-- <li><a href="#contact">Help</a> </li>
							<li><a href="https://spintowinkenya.com/blog/">Blog</a></li> -->
					
							<?php if(isset($_SESSION['logged_in_user'])) { ?>
								<li><a href="#">Withdraw</a> </li>
								<li><span  class="ml-5 wallet__contents user_bal" style="padding: .5em .4em;">Bal: Ksh 0</span> </li>
                            <?php } else { ?>
                                <li><span  class="ml-5x" style="padding: .5em .4em;"></span>  </li>
                            <?php } ?>
							<li style="visibility: hidden;color: #593af0">
								<i class="more-less fa fa-align-right"></i>
								<i class="fa fa-times"></i>
							</li>
						</ul>
					</div>

					<ul class="login_menu navbar-right nav-sign">
						<?php if(isset($_SESSION['logged_in_user'])) {  ?>
							<li class="login">
								<a href="<?php echo site_url('authentication/logout'); ?>" class="btn-4 green-bg yellow-btn"><i class="fa fa-sign-out-alt mr-2"></i> Logout</a>
							</li>
						<?php } else { ?>
							<li class="login" data-toggle="modal" data-target="#signupModal">
								<a href="#" class="btn-4 yellow-btn"> Signup</a>
							</li>
							<li class="login" data-toggle="modal" data-target="#loginModal">
								<a href="#" class="btn-4 pink-bg">Login</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
		
		<!-- mobile menu -->
        <nav id='cssmenu' class="hidden mobile">
            <div id="head-mobile">
                <?php if(isset($_SESSION['logged_in_user'])) { ?>
					<a href="<?php echo site_url('authentication/logout'); ?>" class="btn-4 green-bg yellow-btn">Logout</a>
					<a href="#" class="btn-4 green-bg yellow-btn">Withdraw</a>
				<?php } else { ?>
					<a href="#"  data-toggle="modal" data-target="#signupModal" class="btn-4 green-bg yellow-btn">Signup</a>
					<a href="#"  data-toggle="modal" data-target="#loginModal"  class="btn-4 green-bg">Login</a>
				<?php } ?>
				
                <?php if(isset($_SESSION['logged_in_user'])) { ?>
					<a href="#"  data-toggle="modal" data-target=""  class="btn-4 green-bg user_bal green__btn">Bal: Ksh 0</a>
				<?php } ?>
            </div>

            <div class="button"><i class="more-less fa fa-align-right" style="font-size: 30px;"></i></div> 
            <ul class="d-none">
                <li><a  style="padding: 4px; font-size: 14px;" href="#banner" class="active">Spin Now</a></li>
				<li><a  style="padding: 4px; font-size: 14px;" href="#how">How to Play</a></li>
				<li><a style="padding: 4px; font-size: 14px;" href="https://spintowinkenya.com/blog/">Blog</a></li>
				<li><a style="padding: 4px; font-size: 14px;" href="#contact">Contact</a> </li>

				<?php if(isset($_SESSION['logged_in_user'])) { ?>
					<li style="text-align: right;"><a  style="padding: 4px; font-size: 14px;" href="#">Withdraw</a> </li>
				<?php } ?>
             
                <?php if(isset($_SESSION['logged_in_user'])) { ?>
					<li class="login"><a  style="padding: 4px; font-size: 14px;" href="#" class="btn-4 green-bg yellow-btn">Logout</a></li>
				<?php } else { ?>
					<li class="login"><a  style="padding: 4px; font-size: 14px;" href="#" class="btn-4 green-bg yellow-btn">Signup</a></li>
					<li class="login"><a  style="padding: 4px; font-size: 14px;" href="#" class="btn-4 green-bg">Login</a></li>
				<?php } ?>
            </ul>
        </nav>
		<!-- End mobile menu -->
	</section>
	<!-- Header End -->

	<section id="banner" class="banner-inner main_page">
		<div class="container">
		    
		    <div class="row">
    	        <div class="col-12 mt-4 d-block d-sm-none">
    			    <h3 class="font-weight-bold text-white text-center mb-2">Our Daily Winers!</h3>
    			    <div class="col-lg-12">
    				  <div class="promo-carousel grouploop-1">
    					<div class="item-wrap"> </div>
    				  </div>
    			    </div>
    			</div>
    	    </div>
    	    
			<div class="row">
				<div class="col-lg-5 col-md-12 m-md-0" style="position: relative;">
					<main class="cd-main-content text-center">
						<div class="wheel-horizontal" data-anijs="if: mouseover, do: swing animated, to: .logo-color"></div>
					</main> 
					<a href="#spinButton" class="btn-4 green-bg yellow-btn btn-sm text-white d-md-none" style="position: absolute;z-index: 99;top: 40px;">Spin Now!</a>
				</div>
				
				<div id="spinButton" class="col-lg-7 col-md-12">
					<div class="row banner_text spin_banner" style="">
							<h1 class="title2" style="">Spin And Win Kenya</h1>
							<!-- <h3 style="text-align: center; color: white; text-transform: uppercase;" data-anijs="if: mouseover, do: hinge animated, to: .logo-color">Spin and Win. <br> Earn Upto <span class="cash">Ksh 50,000</span> Instantly</h3>							 -->
						</div>
					<div class="row">
						<div class="col-lg-5 player"> </div>
						<div class="col-lg-7 spinn__area" style="position: relative;text-align: center;">
							<h4 class="spinn__area--title my-4" style="text-align: center" data-anijs="if: mouseover, do: hinge animated, to: .logo-color"> DEPOSIT YOUR STAKE AND PLAY TO WIN</h4>
							<hr class="hr__separator">
							<b class="spinn__area--title2">THE HIGHER YOUR STAKE THE HIGHER YOUR WIN</b>
							<p>
								<div style="text-align: center;" id="grpbtn" class="horizontalButtonGroup"  data-anijs="if: mouseover, do: swing animated, to: .player">
									<!--div class="ui-button fifty">50</div-->
									<div class="ui-button one_h">100</div>
									<div class="ui-button two_h">200</div>
									<div class="ui-button five_h">500</div>
									<div class="ui-button one_t">1000</div>
								</div>
							</p>

							<div class="scroll-prompt d-none" scroll-prompt="" ng-show="showPrompt" style="opacity: 1;">
								<div class="scroll-prompt-arrow-container">
									<div class="scroll-prompt-arrow"><div></div></div>
									<div class="scroll-prompt-arrow"><div></div></div>
								</div>
							</div>

							<div class="casino-btn" style="text-align: center;margin-bottom: 50px !important;">
								<?php if(isset($_SESSION['logged_in_user'])) { ?>
									<button type="button" class="button btn-4 yellow-btn wheel-horizontal-spin-button" title="Select amount above.">Spin</button>
									<button type="button" data-toggle="modal" data-target="#depositModal" class="button btn-4 yellow-btn deposit-button">Deposit</button>
								<?php } else { ?>
									<button type="button" class="button btn-4 yellow-btn wheel-horizontal-spin-button" data-anijs="if: mouseover, do: swing animated, to: .user_bal">Spin Demo</button>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-12 d-none d-sm-block">
				  <div class="promo-carousel grouploop-1">
					<div class="item-wrap"> </div>
				  </div>
			    </div>
			    
			</div>
		</div>
	</section>

	<!-- Banner End -->
	<!-- Counter -->

	<section id="counter" class="back-light">
		<div class="container">
			<div class="row">
				<div class="col-md-12 counter-left text-center">
					<h4>Welcome to Spin And Win Kenya. Spin the lucky wheel and win real money.</h4>
				</div>
			</div>
		</div>
	</section>
	<!-- Control Start -->

	<section id="control" class="control section">
		<div class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="facilities col-12">
						<h3 class="mb-5 facilities__title">Facilities</h3>
					</div>

					<div class="col-12 col-md-3">
						<div class="facility" style="text-align: center;">
							<div class="icon mx-auto">
								<img src="<?= site_url() ?>new-tpl/imgs/coins.svg" alt="SpinToWin free spins" />
							</div>
							<div class="contents">
								Free spins on registration, no deposit required
							</div>
						</div>
					</div>

					<div class="col-12 col-md-3">
						<div class="facility" style="text-align: center;">
							<div class="icon mx-auto">
								<img src="<?= site_url() ?>new-tpl/imgs/ios.svg" alt="SpinToWin withdrawals" />
							</div>
							<div class="contents">
								Instant withdrawals. Sell your credits for instant cash.
							</div>
						</div>
					</div>

					<div class="col-12 col-md-3">
						<div class="facility" style="text-align: center;">
							<div class="icon mx-auto">
								<img src="<?= site_url() ?>new-tpl/imgs/bars.png" alt="SpinToWin stakes" />
							</div>
							<div class="contents">
								Minimum stake of Ksh. 50 and a high multiplier of X1000!
							</div>
						</div>
					</div>

					<div class="col-12 col-md-3">
						<div class="facility" style="text-align: center;">
							<div class="icon mx-auto">
								<img src="<?= site_url() ?>new-tpl/imgs/levels-facility.png" alt="SpinToWin levels" />
							</div>
							<div class="contents">
								New levels equals more cash and free spins.
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- Control End -->

	<!-- How to Start -->
	<a id="how"></a>
	<section id="start" class="back-light">
		<div class="container px-0">
			<div class="row">
				<div class="col-12 col-md-6">
					<img src="<?= site_url() ?>new-tpl/imgs/payment.jpg" class="img-fluid d-none d-lg-block" />
					<img src="<?= site_url() ?>new-tpl/imgs/payment.jpg" class="img-fluid d-block d-sm-none" />
				</div>
				<div class="d-flex col-12 col-md-6 payment_contents bg-blue h-auto justify-content-center">
					<div class="align-self-center w-100 mpesa__image">
						<h4 class="text-uppercase mb-0 d-none d-lg-block">
							Get payment in the <br /> most convenient way
						</h4>
						<h4 class="text-uppercase mb-0 d-block d-sm-none">Get payment in the most convenient way</h4>
						<img src="<?= site_url() ?>new-tpl/imgs/pesa.png" class="img-fluid" /><br>
						<div class="register__button" data-toggle="modal" data-target="#signupModal">
							<a href="javascript:;" class="btn btn-lg btn-4 yellow-btn text-white" style="border-radius: 0 !important;">Register now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- How to Start -->
	
	<!-- Spintowinkenya reviews -->
	<section id="start" class=" section">
		<div class="container px-0">
			<div class="row mb-5">
				<div class="col-12 facilities">
					<h5 class="mb-5 pb-3 reviews__title">User Reviews</h5>
				</div>

				<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
					<div class="row">
						<div class="col-12 col-md-6 text-center">
							<div class="review">
								<div class="icon mx-auto">
									<i class="fa fa-user"></i>
								</div>
								<p>SpinToWin spin and win game is the best game to play and earn some money. Withdrawal is very good. We can withdraw the money instantly.</p>
								<p class="name"><span class="text-black">- Kelvo,</span></p>
							</div>
						</div>
						<div class="col-12 col-md-6 text-center">
							<div class="review">
								<div class="icon mx-auto">
									<i class="fa fa-user"></i>
								</div>
								<p>SpinToWin spin to win real money is a really very good application. I have won X100 on a Ksh. 20 stake. Good for making money by spin..</p>
								<p class="name"><span class="text-black">- Oti</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Spintowinkenya reviews end -->

	
	<!-- Casino Contact start -->
	<section id="contact-us" class="contact-us back-dark contact pt-3">
		<footer class="bg-blue">
            <div class="container text-white">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3 d-none d-lg-block">
						<div class="bg-white footer__logo mb-2">
							<a href="<?= site_url() ?>">
								<img src="<?php echo base_url(); ?>new-tpl/imgs/logo.png" alt="footer-logo">
							</a>
						</div>
                        <div class="logo">
                            <p class="mb-0">SpinToWin lucky wheel is a fun spin game to play and win real money. Choose your stake and spin the wheel to try your luck.</p>
                        </div>
                    </div>
					<div class="col-sm-6 col-md-6 col-lg-3 d-block d-md-none">
                        <div class="bg-white footer__logo mb-2">
							<a href="<?= site_url() ?>">
								<img src="<?php echo base_url(); ?>new-tpl/imgs/logo.png" alt="footer-logo">
							</a>
						</div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <ul class="list-unstyled text-white">
                            <li><a href="" class="text-white footer__links">How to play</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 text-white">
                        <ul class="list-unstyled">
                            <li><a class="text-white footer__links" href="<?= site_url() ?>blog/" target="_blank" rel="noopener">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="bottom__footer--line"/>
                <div class="copyright text-center footer__copyright">
                    &copy; Copyright <?= date('Y') ?> - 2022 spin to win kenya.
                </div>
            </div>
        </footer>

		<!-- Audio Files -->
		<audio id="myAudio" controls style="visibility: hidden; height: 0px;">
			<source src="<?= site_url("media/audio.mp3") ?>" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio><br>
	</section>
	<!-- Casino Contact End -->

	<!-- Login modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-blue border-0 rounded-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
              <div class="modal-body">
                <div class="form-title text-center mb-4">
                  <h4 class="mb-3 text-white modal-title">Login now</h4>
                </div>
                <div class="d-flex flex-column text-center">
                  <form id="login_form">
                    <div class="form-group">
                      <input type="email" class="form-control" id="phone_num" name="phone_num" placeholder="Your Phone Number e.g. 0722******">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="user_login_password" name="user_login_password" placeholder="Your password...">
                    </div>
                    <button type="button" class="btn btn-info btn-block btn-round" id="login_button">Login</button>
                  </form>
                  <span id="output" style="margin-top: 2px; font-size: 12px;"></span>
              </div>
            </div>
              <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section text-white">Not a member yet? <a href="javascript:;" onclick="launchSignupModal()" class="text-info"> Sign Up</a>. Or <a href="javascript:;" onclick="launchRecoveryModal()" class="text-info"> Reset password</a></div>
              </div>
          </div>
        </div>
    </div>
    <!-- Login Modal End -->
    
    <!-- reset modal -->
	<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-blue border-0 rounded-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
              <div class="modal-body">
                <div class="form-title text-center">
                  <h4 class="mb-3 text-white modal-title">Password Recovery</h4>
                </div>
                <div class="d-flex flex-column text-center">
                  <form id="reset_form">
                    <div class="form-group">
                      <input type="email" class="form-control" id="phone_num_reset" name="phone_num_reset" placeholder="Your Phone Number...">
                    </div>
                    <button type="button" class="btn btn-info btn-block btn-round" id="reset_button">Reset</button>
                  </form>
                  <span id="output4" style="margin-top: 2px; font-size: 12px;"></span>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- reset Modal End -->
    
    <!-- sign up modal -->
	<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-blue border-0 rounded-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
              <div class="modal-body py-5">
                <div class="form-title text-center">
                  <h4 class="mb-3 text-white modal-title">SIGN UP</h4>
                </div>
                <div class="d-flex flex-column text-center">
                  <form id="register_form">
                    <div class="form-group">
                      <input type="name" class="form-control reg_form" id="cust_name" name="cust_name" placeholder="Your Name...">
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control reg_form" id="cust_phone_number" name="cust_phone_number" placeholder="Your Phone Number...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control reg_form" id="cust_password1" name="cust_password1" placeholder="Your password...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control reg_form" id="cust_password2" name="cust_password2" placeholder="Confirm Your password...">
                    </div>
                    <button type="button" id="register_button" class="btn btn-info btn-block btn-round">Sign Up <span id="register_button_spin"></span></button>
                  </form>
                  <span id="output2" style="margin-top: 2px; font-size: 12px;"></span>
              </div>
            </div>
              <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section text-white">Already a member? <a href="javascript:;" onclick="launchSigninModal()" class="text-info"> Sign In</a>.</div>
              </div>
          </div>
        </div>
    </div>
    <!-- sign up Modal End -->
    
    
    <!-- deposit modal -->
	<div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-blue border-0 rounded-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
              <div class="modal-body">
                <div class="form-title text-center">
                  <h4 class="mb-3 text-white modal-title">DEPOSIT</h4>
                </div>
                <div class="d-flex flex-column text-center">
                    <form id="deposit_form">
                    <div class="form-group" style="margin-top:20px; margin-bottom:20px;">
                      <input type="text" class="form-control reg_form" id="cust_amount" name="amount" placeholder="Enter Amount">
                      <span style="color: red;">Minimum Ksh 100</span>
                    </div>
                 
                    <button type="button" id="deposit_proceed_button" class="btn btn-info btn-block btn-round">Proceed <span id="deposit_button_spin"></span></button>
                  </form>
                <span id="output3" style="margin-top: 2px; font-size: 12px;">
                    
                </span>
                <hr>
                <h3>Deposit tips</h3>
                <span style="text-align: left;">
                1) make your initial deposit and win instantly<br/>
                2) Contact us +254720634775
                </span>
                
              </div>
            </div>
              <div class="modal-footer d-flex justify-content-center">
              </div>
          </div>
        </div>
    </div>
    <!-- deposit Modal End -->
    
    <!-- deposit confirmation modal -->
	<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-blue border-0 rounded-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
              <div class="modal-body">
                <div class="form-title text-center">
                  <h4 class="mb-3 text-white modal-title">Confirm Payment</h4>
                </div>
                <div class="d-flex flex-column text-center text-white">
                    <form id="deposit_form">
                    <div class="form-group deposit_confirm_text" style="margin-top:20px; margin-bottom:20px;font-size:18px;">
                      A request has been sent to your phone. Please wait for Mpesa prompt to deposit then click button below after deposit confirmation from Mpesa.
                    </div>
                    
                    <div class="w-100 text-left error_payment d-none">
                        <p class="mb-3" style="color: white;">We are having an issue sending payment requests to your phone. Please follow the instructions below to make a payment.</p>
                        <ul class="mb-3" style="text-decoration: double;list-style: decimal;color: white;font-family: 'Nunito', sans-serif;padding-left: 30px;">
                            <li>Go to Safaricom SIM Tool Kit, select the M-PESA menu, and select "Lipa na M-PESA".</li>
                            <li>Select "Pay Bill."</li>
                            <li>Enter Paybill No.4110765.</li>
                            <li>Enter account no <span class="customerNumber"></span> as your registered phone number.</li>
                            <li>Enter the amount.</li>
                            <li>Enter your M-PESA PIN and press "OK."</li>
                            <li>Once you receive the MPESA confirmation message. Click on SPIN NOW yellow button below to start playing. And your balance will be automatically updated</li>
                        </ul>
                    </div>
                 
                    <div class="counteer">Do not close this window. Please wait. <span class="countdown"></span> </div>
                    <button type="button" id="deposit_confirm_button" class="btn btn-info btn-block btn-round hidden2">Confirm Deposit <span id="deposit_button_spin"></span></button>
                    <button type="button" id="deposit_goto_play_button" class="btn btn-warning btn-block btn-round hidden2" style="font-size: 28px;font-weight: 800;text-transform: uppercase;color: #fff;">Spin Now <span id=""></span></button>
                  </form>
                <span id="output3" style="margin-top: 2px; font-size: 12px;"></span>
              </div>
            </div>
              <div class="modal-footer d-flex justify-content-center">
              </div>
          </div>
        </div>
    </div>
    <!-- deposit confirmation Modal End -->

	
	<!-- jQuery -->
	<script src="<?php echo base_url('assets/front/');?>js/jquery-3.2.1.min.js"></script>
	<!--script src="js/jquery-migrate-3.0.0.min.js"></script --> <!--  removed for conflicting with wheel -->

	<!-- Plugins -->
	<script src="<?php echo base_url('assets/front/');?>js/popper.min.js"></script>
	<script src="<?php echo base_url('assets/front/');?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/front/');?>js/slick.min.js"></script>
	<script src="<?php echo base_url('assets/front/');?>js/counter.js"></script>
	<script src="<?php echo base_url('assets/front/');?>js/jquery.countdown.min.js"></script>
	<script src="<?php echo base_url('assets/front/');?>js/menu-opener.js"></script>
	<!--script src="js/waypoints.js"></script --> <!-- requires jquery-migrate-3.0.0.min.js -->
	<script src="<?php echo base_url('assets/front/');?>js/YouTubePopUp.jquery.js"></script>
	<script src="<?php echo base_url('assets/front/');?>js/jquery.event.move.js"></script>
	<script src="<?php echo base_url('assets/front/');?>js/SmoothScroll.js"></script>
	<!-- custom -->
	<script src="<?php echo base_url('assets/front/');?>js/custom.js"></script>
	<script src="<?php echo base_url('assets/front/');?>js/menu.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
	
	
		<!-- wheel of fortune-->
	<!--script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script-->
	<script src="<?php echo base_url('assets/front/');?>wheel/js/jquery.superwheel.min.js"></script> 
	<script src="<?php echo base_url('assets/front/');?>wheel/js/sweetalert2.min.js?ghj"></script> 
	<script src="<?php echo base_url('assets/front/');?>wheel/js/randomColor.js"></script>
    <script src="<?php echo base_url('assets/front/');?>wheel/js/confettiKit.js"></script>
	<?php if(isset($_SESSION['logged_in_user'])) { ?>
    <script src="<?php echo base_url('assets/front/');?>wheel/js/main.js?<?php echo md5(uniqid(rand(), true)); ?>"></script> 
    <?php } else { ?>
    <script src="<?php echo base_url('assets/front/');?>wheel/js/main2.js?<?php echo md5(uniqid(rand(), true)); ?>"></script>
    <?php } ?>
	
	
	<!-- AniJS core library -->
	<script src="https://anijs.github.io/lib/anijs/anijs-min.js"></script> 
	<!-- Include to use $addClass, $toggleClass or $removeClass -->
	<script src="https://anijs.github.io/lib/anijs/helpers/dom/anijs-helper-dom-min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/front/');?>js/grouploop-1.0.3.min.js"></script>

	<script>
	    function launchRecoveryModal() {
	        $('#loginModal').modal('hide')
	        $('#resetModal').modal('show')
	    }
	    
	    function launchSignupModal() {
	        $('#loginModal').modal('hide')
	        $('#signupModal').modal('show')
	    }
	    
	    function launchSigninModal() {
	        $('#signupModal').modal('hide')
	        $('#loginModal').modal('show')
	    }
	
		var CheckoutRequestID = '';
		function swal_disabled(){
			Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'You have low balance. Deposit to continue!'
			});
		} //end of swal disabled
		
		$(document).ready(function(){
			var aux = document.getElementById("myAudio");
			aux.loop = true;
			aux.load();
			
			
			var items = Array(100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1500, 2000, 2500, 3000, 4000, 5000, 6000, 6500, 7000, 7500, 8000, 9000, 20000);
			for (let i = 0; i < 100; i++) {
				if (i% 2 === 0) {
					
					$('.item-wrap').append('<div class="item active"><a href="#">' + Math.floor((Math.random() * 49) + 10) + ' Minutes ago. <br/> 07' + Math.floor((Math.random() * 89) + 10) + ' ***'+ Math.floor((Math.random() * 899) + 100) +' won Ksh '+ items[Math.floor(Math.random()*items.length)] +'</a></div>');
			
				}else{
					$('.item-wrap').append('<div class="item"><a href="#">' + Math.floor((Math.random() * 49) + 10) + ' Minutes ago. <br/> 07' + Math.floor((Math.random() * 89) + 10) + ' ***'+ Math.floor((Math.random() * 899) + 100) +' won Ksh '+ items[Math.floor(Math.random()*items.length)] +'</a></div>');
			
				}
			}

			$('body').mouseover(function(){
				// aux.play();
			});
			
			$('.grouploop-1').grouploop({
				velocity: 1,
				forward: false,
				pauseOnHover: true,
				childNode: ".item",
				childWrapper: ".item-wrap",
				complete: function () { console.log("Initialized a grouploop with id: " + $(this).attr('id')) }
			});
			
			//================================================================handle reset==================================================//
			$("#reset_button").click(function(event) {
			$("#output4").html('');
			$("#reset_button").html('Processing');
			$("#submitbtn_spin").append('<div class="spinner-border text-light"></div>');
		
			//stop submit the form, we will post it manually.
		
			event.preventDefault();
			// Get form
		
			var form = $('#reset_form')[0];
			// FormData object 
		
			var data = new FormData(form);
			// If you want to add an extra field for the FormData
			//data.append("CustomField", "This is some extra data, testing");
		
			// disabled the submit button
			$("#reset_button").prop("disabled", true);
		
			$.ajax({
		
			type: "POST",
			enctype: 'multipart/form-data',
			url: "<?php echo site_url().'/authentication/reset'; ?>",
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 800000,
			success: function(data) {
				const obj = JSON.parse(data);
				if (obj.code == 1) {
				$("#reset_button").html('Reset');
				$("#submitbtn_spin").html('');
				$("#output4").html('<div class="alert alert-danger">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> '+ obj.desc +
												'</div>');
				setTimeout(() => {
	                $('#loginModal').modal('show')
	                $('#resetModal').modal('hide')
	            }, 3000)
				} else if (obj.code == 2) {

				$("#reset_button").html('Reset');
				$("#submitbtn_spin").html('');		
				$("#output4").html('<div class="alert alert-success">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
												'</div>');
				
				}else{
					$("#reset_button").html('Reset');
				$("#submitbtn_spin").html('');		
				$("#output4").html('<div class="alert alert-success">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> Password has been reset. Check your SMS'+
												'</div>');
				}
				
				console.log("SUCCESS : ", data);
				$("#reset_button").prop("disabled", false);
		
				
			},
		
			error: function(e) {
				$("#submitbtn_txt").html('Error ! Click to try again');
				$("#submitbtn_spin").html('');
				$("#output4").html('<div class="alert alert-danger">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> An error has occured while submitting data. Please try again. '+
													'If problem persists, contact system administrator'+ 
												'</div>');
				console.log("ERROR : ", e);
				$("#reset_button").prop("disabled", false);
		
			}
		
			});
		
		}); //end handle ogin
		
		
			//================================================================handle login==================================================//
			$("#login_button").click(function(event) {
			$("#output").html('');
			$("#submitbtn_txt").html('Processing');
			$("#submitbtn_spin").append('<div class="spinner-border text-light"></div>');
		
			//stop submit the form, we will post it manually.
		
			event.preventDefault();
			// Get form
		
			var form = $('#login_form')[0];
			// FormData object 
		
			var data = new FormData(form);
			// If you want to add an extra field for the FormData
			//data.append("CustomField", "This is some extra data, testing");
		
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);
		
			$.ajax({
		
			type: "POST",
			enctype: 'multipart/form-data',
			url: "<?php echo site_url().'authentication/login_validate'; ?>",
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 800000,
			success: function(data) {
				const obj = JSON.parse(data);
				if (obj.code == 1) {
					if(obj.placeholder == 1){
						$('#cust_name').addClass("error"); 
					}
				$("#submitbtn_txt").html('Sign In');
				$("#submitbtn_spin").html('');
				$("#output").html('<div class="alert alert-danger">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> '+ obj.desc +
												'</div>');
				}
				if (obj.code == 2) {
					//window.location.href = "<?php echo 'https://spin-pesa.com/#'; ?>";
					//alert(obj.desc);
				location.reload();
				$("#submitbtn_txt").html('Verified');
				$("#submitbtn_spin").html('');		
				$("#outputs").html('<div class="alert alert-success">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
												'</div>');
				
				}
				
				if (obj.code == 3) {
				$("#submitbtn_txt").html('Verified');
				$("#submitbtn_spin").html('');		
				$("#output").html('<div class="alert alert-success">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
												'</div>');
				window.location.href = "<?php echo site_url().'/admin/dashboard'; ?>";
				}
				
				console.log("SUCCESS : ", data);
				$("#btnSubmit").prop("disabled", false);
				
			},
		
			error: function(e) {
				$("#submitbtn_txt").html('Error ! Click to try again');
				$("#submitbtn_spin").html('');
				$("#output").html('<div class="alert alert-danger">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> An error has occured while submitting data. Please try again. '+
													'If problem persists, contact system administrator'+ 
												'</div>');
				console.log("ERROR : ", e);
				$("#btnSubmit").prop("disabled", false);
		
			}
		
			});
		
		}); //end handle ogin
		
		//============================================================handle register=========================================//
			$("#register_button").click(function(event) {
			$('.reg_form').removeClass("input_error");
			$("#output").html('');
			$("#register_button").html('Processing');
			$("#submitbtn_spin").append('<div class="spinner-border text-light"></div>');

			event.preventDefault();
			// Get form
		
			var form = $('#register_form')[0];
			// FormData object 
		
			var data = new FormData(form);
			//	data.append("CustomField", "This is some extra data, testing");
		
			// disabled the submit button
			$("#register_button").prop("disabled", true);
		
			$.ajax({
		
			type: "POST",
			enctype: 'multipart/form-data',
			url: "<?php echo site_url().'/authentication/register_validate'; ?>",
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 800000,
			success: function(data) {
				const obj = JSON.parse(data);
				//bypass
				$("#submitbtn_txt").html('Verified');
				$("#submitbtn_spin").html('');		
				$("#output2").html('<div class="alert alert-success">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
												'</div>');
				window.location.href = "<?php echo site_url(); ?>";
				
				if (obj.code == 1) {
					if(obj.placeholder == 1){
						$('#cust_name').addClass("input_error");
					}
					if(obj.placeholder == 2){
						$('#cust_phone_number').addClass("input_error");
					}
					if(obj.placeholder == 3){
						$('#cust_password1').addClass("input_error");
					}
					if(obj.placeholder == 4){
						$('#cust_password1').addClass("input_error");
						$('#cust_password2').addClass("input_error");
					}
				$("#register_button").html('Sign Up');
				$("#register_button_spin").html('');
				$("#output2").html('<div class="alert alert-danger">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h5 class="text-danger" style="font-size:12px;><i class="fa fa-exclamation-circle"></i> Error</h5> '+ obj.desc +
												'</div>');
				}
				if (obj.code == 2) {
				$("#submitbtn_txt").html('Verified');
				$("#submitbtn_spin").html('');		
				$("#output2").html('<div class="alert alert-success">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
												'</div>');
				window.location.href = "<?php echo site_url(); ?>";
				}
				
				if (obj.code == 3) {
				$("#submitbtn_txt").html('Verified');
				$("#submitbtn_spin").html('');		
				$("#output2").html('<div class="alert alert-success">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-success"><i class="fa fa-exclamation-circle"></i> Success</h4> '+ obj.desc +
												'</div>');
				window.location.href = "<?php echo site_url().'/admin/dashboard'; ?>";
				}
				
				console.log("SUCCESS : ", data);
				$("#register_button").prop("disabled", false);
				
			},
		
			error: function(e) {
				$("#submitbtn_txt").html('Error ! Click to try again');
				$("#submitbtn_spin").html('');
				$("#output2").html('<div class="alert alert-danger">'+
													'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
													'<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> An error has occured while submitting data. Please try again. '+
													'If problem persists, contact system administrator'+ 
												'</div>');
				console.log("ERROR : ", e);
				$("#btnSubmit").prop("disabled", false);
		
			}
		
			}); //end ajax
		
		});//end register validate
		}); //edn document ready
			
		var element = $('#square');

		// when mouseover execute the animation
		element.mouseover(function(){
		
		// the animation starts
		element.toggleClass('hinge animated');
		
		// do something when animation ends
		element.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(e){
		
		// trick to execute the animation again
			$(e.target).removeClass('hinge animated');
		
		});
		
		});
		
			//==========================================================handle deposit 2=======================================================//
			$('#deposit_proceed_button').click(function(e) {
			e.preventDefault();
			const amount = $("#cust_amount").val();
			const phone = "<?= $phone ?>"
			const depositUrl = "<?php echo site_url().'/mpesa_payment/initiate_stk_pusher'; ?>";

			if(!$.isNumeric(amount)){
            	$("#output3").html('<div class="alert alert-danger">'+
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                '<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> Incorrect Amount'+
                                            '</div>');
             }else if(amount < 100){
                 $("#output3").html('<div class="alert alert-danger">'+
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'+
                                                '<h4 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error</h4> Minimum deposit is Ksh 100'+
                                            '</div>');
             }else{
				var timer2 = "0:30";
                var interval = setInterval(function() {
                var timer = timer2.split(':');
                  //by parsing integer, I avoid all extra string processing
                  var minutes = parseInt(timer[0], 10);
                  var seconds = parseInt(timer[1], 10);
                  --seconds;
                  minutes = (seconds < 0) ? --minutes : minutes;
                  seconds = (seconds < 0) ? 59 : seconds;
                  seconds = (seconds < 10) ? '0' + seconds : seconds;
                  //minutes = (minutes < 10) ?  minutes : minutes;
                  $('.countdown').html(minutes + ':' + seconds);
                  if (minutes < 0) clearInterval(interval);
                  //check if both minutes and seconds are 0
                  if ((seconds <= 0) && (minutes <= 0)) {
                      clearInterval(interval);
                      $('#deposit_confirm_button').removeClass("hidden2");
                      $('.counteer').addClass("hidden2");
                      $('.wait').addClass("hidden2");
                      $("#deposit_confirm_button").click();
                  }
                  
                  timer2 = minutes + ':' + seconds;
                }, 1000);
				// Send data to the Server
				 $.ajax({
					 url: depositUrl,
					 type: "POST",
					 dataType: "JSON",
					 data: { phone_number: phone, amount: amount},
					 beforeSend: function() {
						 $('#deposit_proceed_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Connecting...');
					 },
					 success: function(data) {
						if (data.status == 'success') {
							CheckoutRequestID = data.CheckoutRequestID;
							$('#depositModal').modal('hide');
							$('#deposit_proceed_button').html(data.message);
                            $('.customerNumber').text(phone)
							$('#confirmationModal').modal({backdrop: 'static', keyboard: false},'show');
						} else {
				// 			alert('There was some error performing the Mpesa STK Push');
						}
					 }
				 })
			 }
		})
		
		//handle confirm deposit
		$('#confirmationModal').on('hidden.bs.modal', function () {
          location.reload();
        });
        $('#deposit_goto_play_button').click(function(event){
           location.reload(); 
        });
        		
		$("#deposit_confirm_button").click(function(event){
		    event.preventDefault();
			// New Code 
			const checkoutData = {
				user_name: '<?= $user ?>',
				phone: '<?= $phone ?>',
				CheckoutRequestID: CheckoutRequestID
			}
			const url = '<?= site_url('mpesa_payment/validate_payment') ?>'
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: checkoutData,
				beforeSend: function() {
					$('#deposit_confirm_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Checking. Please wait...');
				},
				success: function(data) {
					if (data.status == 'success') {
						$('.deposit_confirm_text').html('<span style="color:green;font-size:28px;">Balance Update successful</span>');
            			$('#deposit_goto_play_button').removeClass("hidden2");
            			setTimeout(function() {
                            location.reload();
                        }, 2000);
					} else { // There was an error
					    $('.error_payment').removeClass('d-none');
						$('.deposit_confirm_text').html('<span style="color:red;font-size:28px;"><b>Payment unsuccessful</b></span>');
            			$('#deposit_goto_play_button').removeClass("hidden2");
            			$('#deposit_confirm_button').addClass('d-none');
            // 			$('#deposit_goto_play_button').addClass('d-none');
            			$('.counteer').addClass('d-none');
					}
					$('#deposit_confirm_button').html('Check Again');
				},
				error: function() {
                // 	alert('There was some error performing check');
            	}
			})
		});
	</script>
		

	<script async src='https://d2mpatx37cqexb.cloudfront.net/delightchat-whatsapp-widget/embeds/embed.min.js'></script>
	<script>
		var wa_btnSetting = {"btnColor":"#16BE45","ctaText":"WhatsApp Us","cornerRadius":40,"marginBottom":20,"marginLeft":20,"marginRight":20,"btnPosition":"right","whatsAppNumber":"+254720634775","welcomeMessage":"","zIndex":999999,"btnColorScheme":"light"};
		window.onload = () => {
		_waEmbed(wa_btnSetting);
		};
	</script>
</body>

</html>
