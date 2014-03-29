<!doctype html>
<html>
    <head>
	<meta charset="utf-8">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- Important stuff for SEO, don't neglect. (And don't dupicate values across your site!) -->
	<title><?php echo $this->pagetitle;?></title>
	<meta name="title" content="<?php echo $this->pagetitle;?>" />
	<meta name="author" content="" />
	<meta name="description" content="" />
	
	<!-- Don't forget to set your site up: http://google.com/webmasters -->
	<meta name="google-site-verification" content="" />
	
	<!-- Who owns the content of this site? -->
	<meta name="Copyright" content="http://www.karpusa.lv" />
	
	<!--  Mobile Viewport
	http://j.mp/mobileviewport & http://davidbcalhoun.com/2010/viewport-metatag
	device-width : Occupy full width of the screen in its current orientation
	initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
	maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width (wrong for most sites)
	-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
        <base href="http://<?php echo $_SERVER['HTTP_HOST'];?>" /><!--[if IE]></base><![endif]-->
        
	<!-- Use Iconifyer to generate all the favicons and touch icons you need: http://iconifier.net -->
	<!--<link rel="shortcut icon" href="favicon.ico" />-->
	
	<!-- concatenate and minify for production -->
	<!--<link rel="stylesheet" href="template/css/reset.css" />-->
	<link rel="stylesheet" href="template/css/bootstrap.min.css" />
	<link rel="stylesheet" href="template/css/bootstrap-theme.css" />       
	<link rel="stylesheet" href="template/css/style.css" />
	
	<!-- Lea Verou's Prefix Free, lets you use un-prefixed properties in your CSS files -->
	<script src="template/js/libs/prefixfree.min.js"></script>
                
	<!-- Application-specific meta tags -->
	<!-- Windows 8: see http://msdn.microsoft.com/en-us/library/ie/dn255024%28v=vs.85%29.aspx for details -->
	<meta name="application-name" content="" /> 
	<meta name="msapplication-TileColor" content="" /> 
	<meta name="msapplication-TileImage" content="" />
	<meta name="msapplication-square150x150logo" content="" />
	<meta name="msapplication-square310x310logo" content="" />
	<meta name="msapplication-square70x70logo" content="" />
	<meta name="msapplication-wide310x150logo" content="" />
	<!-- Twitter: see https://dev.twitter.com/docs/cards/types/summary-card for details -->
	<meta name="twitter:card" content="">
	<meta name="twitter:site" content="">
	<meta name="twitter:title" content="">
	<meta name="twitter:description" content="">
	<meta name="twitter:url" content="">
	<!-- Facebook (and some others) use the Open Graph protocol: see http://ogp.me/ for details -->
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />

</head>

<body>

<div class="wrapper">

    <header>
        <div class="navbar navbar-default navbar-static-top" role="navigation">
             <div class="container">
               <div class="navbar-header">
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                   <span class="sr-only">Toggle navigation</span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                 </button>
                 <a class="navbar-brand" href="/">Тестовое задание</a>
               </div>
               <div class="navbar-collapse collapse">
                 <nav>
                 <ul class="nav navbar-nav navbar-right">
                   <li><a href="post/">Должности</a></li>
                   <li><a href="staff/">Работники</a></li>
                 </ul>
                 </nav>
               </div><!--/.nav-collapse -->
             </div>
        </div>
    </header>
    
    <div id="page-content" class="container">
            <?php echo $wrapper; ?>
    </div>

</div>
    
<footer>
<div id="footer">
  <div class="container">
    <p class="text-muted">&copy; Виталий Карпуша.</p>
  </div>
</div>
</footer>
<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='assets/js/libs/jquery-1.11.0.min.js'>\x3C/script>")</script>

<script src="template/js/libs/bootstrap.min.js"></script>

<!-- this is where we put our custom functions -->
<!-- don't forget to concatenate and minify if needed -->
<script src="template/js/functions.js"></script>

<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	 
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->
  
</body>
</html>
