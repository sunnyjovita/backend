<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel CRUD using AJAX</title>
	<link rel="icon" href="icon_path" type="image/icon type">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
	integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">

	

</head>
<body>
	 <header id="header" class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="header_logo">
                    <a href="/">Laravel CRUD using AJAX</a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header_menu">
                    <ul>
                        <li class="active"><a href="/">My Products</a></li>
                        <li><a href="sell-product">Sell</a></li>
                    </ul>
                </nav>

                <!-- <form action="search" class="navbar-form navbar-left">
                <div class="input-group" style="padding-left:65px;">

                    <input type="search" name="query" class="form-control rounded search-box" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
           
                    <button style="outline-color: black" type="submit" class="btn btn-outline-primary">search</button>

                </div>

            </form> -->
            <br>

            </div>


        </div>
    </div>
</header>

	@yield('content')

	<!-- {{View::make('footer')}} -->
	 <div id="footer" class="footer">
<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>Sunny Jovita</h6>
            
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Categories</h6>
            <ul class="footer-links">
              <li><a href="#">my products</a></li>
              <li><a href="#">sell product</a></li>
        
            </ul>
          </div>

          <!-- <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="#">About Us</a></li>
              <li><a href='contact-us'>Contact Us</a></li>
              <li><a href="#">Categories</a></li>
              <li><a href='privacy-policy'>Privacy Policy</a></li>
             
            </ul>
          </div> -->
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by 
         <a href="/">Sunny Jovita</a>.
            </p>
          </div>

        </div>
      </div>
</footer>
</div>

	<!--jQuery Library-->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<!--Popper JS-->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
	<!--compiled Javascript-->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
	<!--owl carousel-->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
	<!--javascript-->
	<!-- <script type="text/javascript" src="/js/main.js"></script> -->

</body>


</html>