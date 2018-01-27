<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="Bootstrap 3 template for corporate business" />
		<!-- css -->
		<link href="/css/index/bootstrap.min.css" rel="stylesheet" />
		<link href="/plugins/flexslider/flexslider.css" rel="stylesheet" media="screen" />	
		<link href="/css/index/cubeportfolio.min.css" rel="stylesheet" />
		<link href="/css/index/style.css" rel="stylesheet" />

		<!-- Theme skin -->
		<link id="t-colors" href="/css/index/skins/default.css" rel="stylesheet" />

		<!-- boxed bg -->
		<link id="bodybg" href="/css/index/bodybg/bg1.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="wrapper">
			@include('index.partials.header')
			@include('index.partials.slider')
			@include('index.partials.intro')
			@include('index.partials.content')
			@include('index.partials.footer')
		</div>
		<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

		<!-- Placed at the end of the document so the pages load faster -->
		<script src="/js/index/jquery.min.js"></script>
		<script src="/js/index/modernizr.custom.js"></script>
		<script src="/js/index/jquery.easing.1.3.js"></script>
		<script src="/js/index/bootstrap.min.js"></script>

		<!-- Slide -->
		<script src="/plugins/flexslider/jquery.flexslider-min.js"></script> 
		<script src="/plugins/flexslider/flexslider.config.js"></script>
	
		<!-- Image list -->
		<script src="/js/index/jquery.appear.js"></script>
		<script src="/js/index/stellar.js"></script>

		<!-- Appear search box -->
		<script src="/js/index/classie.js"></script>

		<!-- Search box -->
		<script src="/js/index/uisearch.js"></script>

		<script src="/js/index/jquery.cubeportfolio.min.js"></script>

		<!-- <script src="js/google-code-prettify/prettify.js"></script> -->
		
		<!-- 	<script src="js/animate.js"></script> -->
		<script src="/js/index/custom.js"></script>
	</body>
</html>