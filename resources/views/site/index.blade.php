
<!DOCTYPE html>
<html lang="en">
<head>
<title>IEI Anchor Pensions | Data-Recapture</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Data Recapture, recapture, IEI Anchor, IEI, IEI Anchor Pensions, PENCOM" />

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
	
	<!-- css files -->
    <link rel="stylesheet" href="{{asset('/css/home/css_slider.css')}}"  type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('/css/home/bootstrap.css')}}"  type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('/css/home/style.css')}}"  type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('/css/home/font-awesome.min.css')}}"  type="text/css" media="all" />    
	<!-- //css files -->
	
	<!-- google fonts -->
    <link rel="stylesheet" href="{{asset('/css/home/fonts_googleapis.css')}}"  type="text/css" media="all" />
	<!-- //google fonts -->
	
</head>
<body>


<!-- header -->
<header>
	<div class="container">
		<!-- nav -->
		<nav class="py-3 d-lg-flex">
			<div id="logo">
				<h1> <a href="{{route('home')}}"><img style="max-width:35%;"  src="{{ asset('/css/images/iei_anchor.jpg')}}" /> Data Recapture </a></h1>
			</div>
			<label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
			<input type="checkbox" id="drop" />
			<ul class="menu ml-auto mt-1">
				<li class="active"><a href="{{route('home')}}">Downloads</a></li>
			</ul>
		</nav>
		<!-- //nav -->
	</div>
</header>
<!-- //header -->


<!-- banner -->
<div class="banner" id="home">
	<div class="layer">
		<div class="container">
			<div class="banner-text-w3pvt">
				<!-- banner slider-->
				<div class="csslider infinity" id="slider1">
					<input type="radio" name="slides" checked="checked" id="slides_1" />
					<input type="radio" name="slides" id="slides_2" />
					<input type="radio" name="slides" id="slides_3" />
					<ul class="banner_slide_bg">
						<li>
							<div class="w3ls_banner_txt">
								<h2 class="b-w3ltxt text-capitalize mt-md-4">Data <span>Recapture</span> </h2>
								<h4 class="b-w3ltxt text-capitalize">Mandatory Capture of Clients Data</h4>
								<p class="w3ls_pvt-title my-3">An initiative by the National Pensions Commission to update all Pension clients accounts</p>
								
								<a href="{{route('login')}}" class="btn btn-banner my-3 mr-2">Get Started</a>
							</div>
						</li>
						
					</ul>
					
				</div>
				<!-- //banner slider-->
			</div>
		</div>
	</div>
</div>
<!-- //banner -->



<!-- copyright -->
<section class="copy-right py-4">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<p class="">© <?php echo date('Y');?> IEI Anchor Pensions. All rights reserved
				</p>
			</div>
			
		</div>
	</div>
</section>
<!-- //copyright -->

<!-- move top -->
<div class="move-top text-right">
	<a href="#home" class="move-top"> 
		<span class="fa fa-angle-up  mb-3" aria-hidden="true"></span>
	</a>
</div>
<!-- move top -->

</body>
</html>