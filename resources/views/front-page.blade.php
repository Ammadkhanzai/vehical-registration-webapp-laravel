<!doctype html>
<html lang="zxx">

<head>
	<title>VEHICAL REGISTRATION SYSTEM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- fonts -->
	<link href="//fonts.googleapis.com/css?family=Cuprum:400,400i,700,700i" rel="stylesheet">
	<!-- /fonts -->
	<!-- css -->
    <link href="{{ asset('front-page/css/font-awesome.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('front-page/css/style.css')}}" rel='stylesheet' type='text/css' media="all" />

	<!-- <link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel='stylesheet' type='text/css' media="all" /> -->
	<!-- /css -->
</head>

<body>
	<div class="content-w3ls">
		<div class="left-grid">
			<header>
				<h1 class="Flick-grid">
					<a href="{{route('home')}}">VRS</a>
				</h1>
				<ul class="nav">
					<li>
						<a href="{{route('home')}}">home</a>
					</li>
					<li>
						<a href="{{route('user.login')}}">Login</a>
					</li>
					
				</ul>
			</header>
			<div class="sub-grid">
				<h2>Online Vehicle Verification</h2>
				
				<div class="subscribe-w3ls">
					<form action="{{ route('verify-vehical') }}" method="post">
                        @csrf
                        @method('POST')
						<div class="form-group1">
							<input type="text" class="field" name="engineNumber" placeholder="Please Enter Engine no" required>
						</div>
						<div class="form-group1">
							<input type="text" class="field" name="numberPlate" placeholder="Please Enter Number Plate" required>
						</div>
						
						<div class="form-group2">
							<button type="submit" class="btn btn-outline btn-lg">								
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
						<div class="clear"></div>
					</form>
				</div>
				
			</div>
		</div>
		<div class="right-grid">
		</div>
	</div>

</body>

</html>