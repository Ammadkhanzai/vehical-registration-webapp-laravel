<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Lifestyle Timeline Responsive Widget Template :: W3layouts</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	
	<style>
			/*
	Author: W3layouts
	Author URL: http://w3layouts.com
	*/
	html {
	scroll-behavior: smooth;
	}

	body,
	html {
	margin: 0;
	padding: 0;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
		Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
	background-image: url("/front-page/images/73c9ce9e937b8eaca3f737be241a9736.webp");
	background-repeat: no-repeat;
	background-attachment: fixed;
	}
	ul.timeline li{
		background-color:#00000075;
		margin-bottom: 5px;
	}
	* {
	box-sizing: border-box;
	}

	.d-grid {
	display: grid;
	}

	.d-flex {
	display: flex;
	display: -webkit-flex;
	}

	.text-center {
	text-align: center;
	}

	.text-left {
	text-align: left;
	}

	.text-right {
	text-align: right;
	}

	button,
	input,
	select {
	-webkit-appearance: none;
	outline: none;
	}

	button,
	.btn,
	select {
	cursor: pointer;
	}

	a {
	text-decoration: none;
	}

	iframe {
	border: none;
	}

	ul {
	margin: 0;
	padding: 0
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	p {
	margin: 0;
	padding: 0
	}


	.btn,
	button,
	.actionbg,
	input {
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-o-border-radius: 4px;
	-ms-border-radius: 4px;
	}

	.btn:hover,
	button:hover {
	transition: 0.5s ease;
	-webkit-transition: 0.5s ease;
	-o-transition: 0.5s ease;
	-ms-transition: 0.5s ease;
	-moz-transition: 0.5s ease;
	}

	/*--/wrapper--*/
	.wrapper {
	width: 100%;
	padding-right: 15px;
	padding-left: 15px;
	margin-right: auto;
	margin-left: auto;
	}

	@media (min-width: 576px) {
	.wrapper {
		max-width: 540px;
	}
	}

	@media (min-width: 768px) {
	.wrapper {
		max-width: 720px;
	}
	}

	@media (min-width: 992px) {
	.wrapper {
		max-width: 960px;
	}
	}

	@media (min-width: 1200px) {
	.wrapper {
		max-width: 1140px;
	}
	}

	.wrapper-full {
	width: 100%;
	padding-right: 15px;
	padding-left: 15px;
	margin-right: auto;
	margin-left: auto;
	}

	/*--//wrapper--*/
	.w3l-timeline-main {
	/* background:#202025; */
	padding:4em 0;
	}
	.w3l-timeline-main h1 {
	margin-bottom: 40px;
	font-size: 40px;
	color: #fff;
	text-align:center;
	}
	.timeline-content-6 .timeline {
	position: relative;
	width: 860px;
	margin: 0 auto;
	padding: 4.5em 0;
	list-style-type: none;
	}

	.timeline-content-6 .timeline:before {
	position: absolute;
	left: 50%;
	top: 0;
	content: ' ';
	display: block;
	width: 6px;
	height: 100%;
	margin-left: -3px;
	background: #0b334a;
	z-index: 5;
	}

	.timeline-content-6 .timeline li {
	padding: 1em 0;
	}

	.timeline-content-6 .timeline li:after {
	content: "";
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
	}

	.timeline-content-6 .direction-l {
	position: relative;
	width: 400px;
	float: left;
	text-align: right;
	}

	.timeline-content-6 .direction-r {
	position: relative;
	width: 400px;
	float: right;
	}

	.timeline-content-6 .flag-wrapper {
	position: relative;
	display: inline-block;
	text-align: center;
	}

	.timeline-content-6 .flag {
	position: relative;
	display: inline;
	background:#0b334a;
	padding: 6px 10px;
	border-radius: 0px;
	font-weight: 600;
	text-align: left;
	font-size: 16px;
	color: #fff;
	letter-spacing: 1px;
	}

	.timeline-content-6 .direction-l .flag {
	box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
	}

	.timeline-content-6 .direction-r .flag {
	box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
	}

	.timeline-content-6 .direction-l .flag:before,
	.timeline-content-6 .direction-r .flag:before {
	position: absolute;
	top: 50%;
	right: -40px;
	content: ' ';
	display: block;
	width: 12px;
	height: 12px;
	margin-top: -10px;
	background: #fff;
	border-radius: 10px;
	border: 4px solid #ff6150;
	z-index: 10;
	}


	.timeline-content-6 .direction-r .flag:before {
	left: -40px;
	}

	.timeline-content-6 .direction-l .flag:after {
	content: "";
	position: absolute;
	left: 100%;
	top: 50%;
	height: 0;
	width: 0;
	margin-top: -8px;
	border: solid transparent;
	border-left-color: #0b334a;
	border-width: 8px;
	pointer-events: none;
	}

	.timeline-content-6 .direction-r .flag:after {
	content: "";
	position: absolute;
	right: 100%;
	top: 50%;
	height: 0;
	width: 0;
	margin-top: -8px;
	border: solid transparent;
	border-right-color: #0b334a;
	border-width: 8px;
	pointer-events: none;
	}

	.timeline-content-6 .time-wrapper {
	display: inline;
	line-height: 1em;
	font-size: 0.66666em;
	color:#1ac0c6;
	vertical-align: middle;
	}

	.timeline-content-6 .direction-l .time-wrapper {
	float: left;
	}

	.timeline-content-6 .direction-r .time-wrapper {
	float: right;
	}

	.timeline-content-6 .time {
	display: inline-block;
	padding: 6px 6px;
	background: rgba(156, 197, 220, 0.32);
	color: #fff;
	}

	.timeline-content-6 .desc {
	margin: 1em 0.75em 0 0;
	color: #c2e0f3;                                    
	font-size: 15px;
	line-height: 25px;
	}

	.timeline-content-6 .direction-r .desc {
	margin: 1em 0 0 0.75em;
	}

	/*/w3l-copy-right*/
	.w3l-copy-right.text-center {
	margin-top: 2em;
	}

	.w3l-copy-right p {
	font-size: 15px;
	line-height: 29px;
	color: #fff;
	}

	.w3l-copy-right p a {
	color: #ff6150;
	}

	.w3l-copy-right p a:hover {
	color: #fff;
	text-decoration: none;
	transition: all 0.2s ease;
	-moz-transition: all 0.2s ease;
	-webkit-transition: all 0.2s ease;
	-ms-transition: all 0.2s ease;
	-o-transition: all 0.2s ease;
	}

	/*//w3l-copy-right*/
	@media screen and (max-width:992px) {
	.timeline-content-6 .timeline {
		width: 100%;
		padding: 4em 0 1em 0;
	}

	.timeline-content-6 .timeline li {
		padding: 2em 0;
	}

	.timeline-content-6 .direction-l,
	.timeline-content-6 .direction-r {
		float: none;
		width: 100%;
		text-align: center;
	}

	.timeline-content-6 .flag-wrapper {
		text-align: center;
	}

	.timeline-content-6 .flag {
		z-index: 15;
	}

	.timeline-content-6 .direction-l .flag:before,
	.timeline-content-6 .direction-r .flag:before {
		position: absolute;
		top: -30px;
		left: 50%;
		content: ' ';
		display: block;
		width: 12px;
		height: 12px;
		margin-left: -9px;
		background: rgb(255, 255, 255);
		border-radius: 10px;
		z-index: 10;
	}

	.timeline-content-6 .direction-l .flag:after,
	.timeline-content-6 .direction-r .flag:after {
		content: "";
		position: absolute;
		left: 50%;
		top: -8px;
		height: 0;
		width: 0;
		margin-left: -8px;
		border: solid transparent;
		border-bottom-color: #0b334a;
		border-width: 8px;
		pointer-events: none;
	}

	.timeline-content-6 .time-wrapper {
		display: block;
		position: relative;
		margin: 4px 0 0 0;
		z-index: 14;
	}

	.timeline-content-6 .direction-l .time-wrapper {
		float: none;
	}

	.timeline-content-6 .direction-r .time-wrapper {
		float: none;
	}

	.timeline-content-6 .desc {
		position: relative;
		margin: 1em 0 0 0;
		padding: 1em;
		background: #0b334a;
		box-shadow: 0 0 1px rgba(0, 0, 0, 0.2);
		z-index: 15;
	}

	.timeline-content-6 .direction-l .desc,
	.timeline-content-6 .direction-r .desc {
		position: relative;
		margin: 1em 1em 0 1em;
		padding: 1em;
		z-index: 15;
	}
	.w3l-timeline-main h1 {
		margin-bottom: 26px;
		font-size: 36px;
	}
	}



	@media all and (max-width:568px) {
	.w3l-timeline-main {
		padding: 2em 0;
	}
	.w3l-timeline-main h1 {
		margin-bottom: 26px;
		font-size: 32px;
	}
	}

	@media all and (max-width: 440px) {}

	@media all and (max-width: 410px) {}




	/* new */

	@import url("https://fonts.googleapis.com/css?family=Nunito:400,700");
	* {
		transition: all 0.3s ease-out;
	}
	html, body {
		height: 100%;
		font-family: "Nunito", sans-serif;
		font-size: 16px;
	}
	.container {
		width: 100%;
		height: 100%;
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: center;
	}
	h3 {
		color: #000000;
		font-size: 17px;
		line-height: 24px;
		font-weight: 700;
		margin-bottom: 4px;
	}
	p {
		font-size: 17px;
		font-weight: 400;
		line-height: 20px;
		color: rgb(32, 31, 31);
	}
	p.small {
		font-size: 14px;
	color: #000000;
	}
	.go-corner {
		display: flex;
		align-items: center;
		justify-content: center;
		position: absolute;
		width: 32px;
		height: 32px;
		overflow: hidden;
		top: 0;
		right: 0;
		background-color: #00838d;
		border-radius: 0 4px 0 32px;
	}
	.go-arrow {
		margin-top: -4px;
		margin-right: -4px;
		color: white;
		font-family: courier, sans;
	}
	
	.card2 {
		display: block;
		top: 0px;
		position: relative;
		/* max-width: 262px; */
		min-width: 262px;
		background-color: #f2f8f9;
		border-radius: 4px;
		padding: 32px 24px;
		margin: 12px;
		text-decoration: none;
		z-index: 0;
		overflow: hidden;
		border: 1px solid #f2f8f9;
	}
	.card2:hover {
		transition: all 0.2s ease-out;
		box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
		top: -4px;
		border: 1px solid #ccc;
		background-color: white;
	}
	.card2:before {
		content: "";
		position: absolute;
		z-index: -1;
		top: -16px;
		right: -16px;
		background: #0b334a;
		height: 32px;
		width: 32px;
		border-radius: 32px;
		transform: scale(2);
		transform-origin: 50% 50%;
		transition: transform 0.15s ease-out;
	}
	.card2:hover:before {
		transform: scale(2.15);
	}
	
	</style>
</head>

<body>
	<!--/timeline-->
	{{-- dd(array($vehical,$record,$history))  --}}
	<section class="w3l-timeline-main">

		<div class="wrapper">
			<div class="w3l-copy-right text-center">
				<h1>Vehicle Details</h1>
				<div class="container">

					
					<div class="card2">
						<h3>Maker</h3>
						<p class="small">{{ $record->manufacturerName }}</p>
					</div>
					<div class="card2">
						<h3>Engine No</h3>
						<p class="small">{{ $record->engineNumber }}</p>
					</div>
					<div class="card2">
						<h3>Chassis Number</h3>
						<p class="small">{{ $record->chassisNumber}}</p>
					</div>
					<div class="card2">
						<h3>Type</h3>
						<p class="small">{{ $vehical->vehical_class }}</p>
					</div>
					<div class="card2">
						<h3>Model Year</h3>
						<p class="small">{{ date("F Y ",$record->manufactureDate) }}</p>
					</div>
					<div class="card2">
						<h3>Seating</h3>
						<p class="small">{{ $vehical->seating_capacity }}</p>
					</div>
					<div class="card2">
						<h3>current owner</h3>
						<p class="small">{{ ucwords($record->ownerName) }}</p>
					</div>
					<div class="card2">
						<h3>Registration Date</h3>
						<p class="small">{{ date("l jS \of F Y",$record->registrationDate) }}</p>
					</div>
					<div class="card2">
						<h3>Number plate</h3>
						<p class="small">{{ $record->numberplate }}</p>
					</div>



				</div>
			</div>

			<div class="timeline-content-6">
				<h1>Life-Time</h1>
				<ul class="timeline">
					<!-- Item 1 -->
					
					<?php $count = 2;?>
					@foreach ( $history as $v)
						@if($v->Value->state == "UNDER_MANUFACTURER" && $v->Value->clientIdentity != "null")
					<li>
							@if($count % 2 == 0)
								<div  class="direction-l" {{$count}}>
								
							@else
								
								<div  class="direction-r" {{$count}}>
								
							@endif
								
								<?php  $count = $count+1; ?>
							<div class="flag-wrapper">
								<span class="flag">Manufacture</span>
								<span class="time-wrapper"><span class="time">{{ date("l jS \of F Y h:i:s A",$v->Value->manufactureDate) }}</span></span>
								
							</div>
							<div class="desc" >
								<p><small style="color:#fff;">{{ $manufacturer->company_name}}</small></p>
								<p><small style="color:#fff;">{{ $manufacturer->company_phone}}</small></p>
								<p><small style="color:#fff;">{{ $manufacturer->company_email}}</small></p>
								<p><small style="color:#fff;">{{ $manufacturer->company_website}}</small></p>
								<p><small style="color:#fff;">{{ $manufacturer->company_address}}</small></p>

							</div>
								
						</div>
					</li>
						@endif
						@if($v->Value->state == "UNDER_DEALER" && $v->Value->clientIdentity != "null")
						<li>
							@if($count % 2 == 0)
								<div  class="direction-l" {{$count}}>
								
							@else
								
								<div  class="direction-r" {{$count}}>
								
							@endif
								
								<?php  $count = $count+1; ?>
								<div class="flag-wrapper">
									<span class="flag">Dealer</span>
									<span class="time-wrapper"><span class="time">{{__(date("l jS \of F Y h:i:s A",strtotime($vehical->vehical_dealer_join->created_at)))   }} </span></span>
									
								</div>
								<div class="desc" >
									<p><small style="color:#fff;">{{ $dealer->business_name}}</small></p>
									<p><small style="color:#fff;">{{ $dealer->business_phone}}</small></p>
									<p><small style="color:#fff;">{{ $dealer->business_email}}</small></p>
									<p><small style="color:#fff;">{{ $dealer->business_website}}</small></p>
									<p><small style="color:#fff;">{{ $dealer->business_address}}</small></p>

								</div>
									
							</div>
						</li>
						@endif
						@if($v->Value->state == "UNDER_CUSTOMER" && $v->Value->clientIdentity != "null")
						
						<li>
						<?php echo $count;?>
						@if($count % 2 == 0)
							<div  class="direction-l" {{$count}}>
							
						@else
							
							<div  class="direction-r" {{$count}}>
							
						@endif
							
							<?php  $count = $count+1; ?>
							
								<div class="flag-wrapper">
									<span class="flag">{{ ucwords($v->Value->ownerName)}}</span>
									<span class="time-wrapper"><span class="time">{{__(date("l jS \of F Y h:i:s A",$v->Value->registrationDate))   }} </span></span>
									<div class="desc" >
									<p><small style="color:#fff; display:inline-flex; font-size:12px;"><b>Reg No: </b>
									{{ $v->Value->registrationNumber}}
									
									</small></p>
									</div>
								</div>
									
							</div>
						</li>
						
						
						@endif
					@endforeach
					

				</ul>

			</div>

		</div>
	</section>
	<!--//timeline-->
</body>
</html>