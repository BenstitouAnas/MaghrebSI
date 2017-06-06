<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
    	<!-- 
    	Boxer Template
    	http://www.templatemo.com/tm-446-boxer
    	-->

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Maghreb-SI</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="">
		<meta name="description" content="">

		<!-- animate css -->
		<link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
		<!-- bootstrap css -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<!-- font-awesome -->
		<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
		<!-- google font -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,800' rel='stylesheet' type='text/css'>

		<!-- custom css -->
		<link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}">

	</head>
	<body>
		<!-- start preloader -->
		<div class="preloader">
			<div class="sk-spinner sk-spinner-rotating-plane"></div>
    	 </div>
		<!-- end preloader -->
		<!-- start navigation -->
		<nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
					</button>
					<a href="{{ url('/') }}" class="navbar-brand">Maghreb-SI</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right text-uppercase">
						<li><a href="#home">Accueil</a></li>
						<li><a href="#feature">À propos</a></li>
						<li><a href="#pricing">Pricing</a></li>
						<li><a href="#download">Download</a></li>
						<li><a href="#contact">Contact</a></li>
                        @if (Route::has('login'))
                            @if (Auth::guest())
                            	<li><a href="{{ url('/login') }}"><button type="button" class="btn btn-info">Se Connecter</button></a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->nom }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endif
					</ul>
				</div>
			</div>
		</nav>
		<!-- end navigation -->
		<!-- start home -->
		<section id="home">
			<div class="overlay">
				<div class="container">
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10 wow fadeIn" data-wow-delay="0.3s">
							<h1 class="text-upper">Software Landing Page</h1>
							<p class="tm-white">Boxer is a fully Responsive, Clean Design, Modern, and Flexible Software Landing Page for startups, businesses and agencies. It is built with HTML5 &amp; CSS3, Bootstrap 3.3.4, Font Awesome 4.3.0, and much more. Designed by <a rel="nofollow" href="http://www.facebook.com/templatemo" target="_parent">templatemo</a>. Images by <a rel="nofollow" href="http://pixabay.com" target="_blank">Pixabay</a></p>
							<img src="{{ asset('images/software-img.png') }}" class="img-responsive" alt="home img">
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</div>
		</section>
		<!-- end home -->
		<!-- start divider -->
		<section id="divider">
			<div class="container">
				<div class="row">
					<div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
						<i class="fa fa-laptop"></i>
						<h3 class="text-uppercase">RESPONSIVE LAYOUT</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
					</div>
					<div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
						<i class="fa fa-twitter"></i>
						<h3 class="text-uppercase">BOOTSTRAP 3.3.4</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
					</div>
					<div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
						<i class="fa fa-font"></i>
						<h3 class="text-uppercase">GOOGLE FONT</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
					</div>
				</div>
			</div>
		</section>
		<!-- end divider -->

		<!-- start feature -->
		<section id="feature">
			<div class="container">
				<div class="row">
					<div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
						<h2 class="text-uppercase">Our Software Features</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						<p><span><i class="fa fa-mobile"></i></span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						<p><i class="fa fa-code"></i>Quis autem velis reprehenderit et quis voluptate velit esse quam.</p>
					</div>
					<div class="col-md-6 wow fadeInRight" data-wow-delay="0.6s">
						<img src="{{ asset('images/software-img.png') }}" class="img-responsive" alt="feature img">
					</div>
				</div>
			</div>
		</section>
		<!-- end feature -->

		<!-- start feature1 -->
		<section id="feature1">
			<div class="container">
				<div class="row">
					<div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
						<img src="images/software-img.png" class="img-responsive" alt="feature img">
					</div>
					<div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
						<h2 class="text-uppercase">More of Your Software</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						<p><span><i class="fa fa-mobile"></i></span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						<p><i class="fa fa-code"></i>Quis autem velis reprehenderit et quis voluptate velit esse quam.</p>
					</div>
				</div>
			</div>
		</section>
		<!-- end feature1 -->

		<!-- start pricing -->
		<section id="pricing">
			<div class="container">
				<div class="row">
					<div class="col-md-12 wow bounceIn">
						<h2 class="text-uppercase">Our Pricing</h2>
					</div>
					<div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
						<div class="pricing text-uppercase">
							<div class="pricing-title">
								<h4>Basic Plan</h4>
								<p>$11</p>
								<small class="text-lowercase">monthly</small>
							</div>
							<ul>
								<li>6 GB Space</li>
								<li>600 GB Bandwidth</li>
								<li>60 More Themes</li>
								<li>Lifetime Support</li>
							</ul>
							<button class="btn btn-primary text-uppercase">Sign up</button>
						</div>
					</div>
					<div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
						<div class="pricing active text-uppercase">
							<div class="pricing-title">
								<h4>Business Plan</h4>
								<p>$22</p>
								<small class="text-lowercase">monthly</small>
							</div>
							<ul>
								<li>15 GB space</li>
								<li>1,500 GB Bandwidth</li>
								<li>150 More Themes</li>
								<li>Lifetime Support</li>
							</ul>
							<button class="btn btn-primary text-uppercase">Sign up</button>
						</div>
					</div>
					<div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
						<div class="pricing text-uppercase">
							<div class="pricing-title">
								<h4>Pro Plan</h4>
								<p>$33</p>
								<small class="text-lowercase">monthly</small>
							</div>
							<ul>
								<li>35 GB space</li>
								<li>3,500 GB bandwidth</li>
								<li>350 more themes</li>
								<li>Lifetime Support</li>
							</ul>
							<button class="btn btn-primary text-uppercase">Sign Up</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- end pricing -->

		<!-- start download -->
		<section id="download">
			<div class="container">
				<div class="row">
					<div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
						<h2 class="text-uppercase">Download Our Software</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
						<button class="btn btn-primary text-uppercase"><i class="fa fa-download"></i> Download</button>
					</div>
					<div class="col-md-6 wow fadeInRight" data-wow-delay="0.6s">
						<img src="{{ asset('images/software-img.png') }}" class="img-responsive" alt="feature img">
					</div>
				</div>
			</div>
		</section>
		<!-- end download -->

		<!-- start contact -->
		<section id="contact">
			<div class="overlay">
				<div class="container">
					<div class="row">
						<div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
							<h2 class="text-uppercase">Contactez-nous</h2>
							<p>Maghreb Services Informatiques </p>
							<address>
								<p><i class="fa fa-map-marker"></i> N° A211, Zone économiques ,Benslimane – Casablanca </p>
								<p><i class="fa fa-phone"></i> (+212)6 33 50 06 80</p>
								<p><i class="fa fa-envelope-o"></i> contact@maghreb-si.net</p>
							</address>
						</div>
						<div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
							<div class="contact-form">
								<form action="#" method="post">
									<div class="col-md-6">
										<input type="text" class="form-control" placeholder="Nom">
									</div>
									<div class="col-md-6">
										<input type="email" class="form-control" placeholder="Email">
									</div>
									<div class="col-md-12">
										<input type="text" class="form-control" placeholder="Sujet">
									</div>
									<div class="col-md-12">
										<textarea class="form-control" placeholder="Message" rows="4"></textarea>
									</div>
									<div class="col-md-8">
										<input type="submit" class="form-control text-uppercase" value="Envoyer">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- end contact -->

		<!-- start footer -->
		<footer>
			<div class="container">
				<div class="row">
					<p>Copyright © 2017 MAGHREB-SI</p>
				</div>
			</div>
		</footer>
		<!-- end footer -->
        
		<script src="{{ asset('js/jquery.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<!--<script src="{{ asset('js/wow.min.js') }}"></script>-->
		<script src="{{ asset('js/jquery.singlePageNav.min.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
	</body>
</html>