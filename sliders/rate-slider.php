<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#owl-demo .item{
		  background: #3fbf79;
		  padding: 30px 0px;
		  margin: 10px;
		  color: #FFF;
		  -webkit-border-radius: 3px;
		  -moz-border-radius: 3px;
		  border-radius: 3px;
		  text-align: center;
		}
	
	</style>
	<script type="text/javascript">
		$(document).ready(function() {

		  var owl = $("#owl-demo");		 
		  owl.owlCarousel({
		      items : 5, //10 items above 1000px browser width
		      itemsDesktop : [1000,5], //5 items between 1000px and 901px
		      itemsDesktopSmall : [900,3], // betweem 900px and 601px
		      itemsTablet: [600,2], //2 items between 600 and 0
		      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
		  });
		 
		});
	</script>
</head>
<body>
	<div id="owl-demo" class="owl-carousel owl-theme">
	  <div class="item"><h1>1</h1></div>
	  <div class="item"><h1>2</h1></div>
	  <div class="item"><h1>3</h1></div>
	  <div class="item"><h1>4</h1></div>
	  <div class="item"><h1>5</h1></div>
	  <div class="item"><h1>6</h1></div>
	  <div class="item"><h1>7</h1></div>
	  <div class="item"><h1>8</h1></div>
	  <div class="item"><h1>9</h1></div>
	  <div class="item"><h1>10</h1></div>
	  <div class="item"><h1>11</h1></div>
	  <div class="item"><h1>12</h1></div>
	  <div class="item"><h1>13</h1></div>
	  <div class="item"><h1>14</h1></div>
	  <div class="item"><h1>15</h1></div>
	  <div class="item"><h1>16</h1></div>
	</div>
	 
	
</body>
</html>