$(document).ready(function(){
	$.fn.timer = function () {
		var dt = new Date();
		console.log(dt.getSeconds());
		window.DEFAULT_VALUE = Math.round(360 - ((dt.getSeconds()%30) * 360) / 30);
		$('#demo').pietimer({
	    seconds: 30 - (dt.getSeconds()%30),
	    color: 'rgba(112,112,112, 0.1)',
	    height: 180,
	    width: 180
		},
		function(){
			window.DEFAULT_VALUE = 360;
			$('#timer').click();
		});
		$('#demo').pietimer('start');
	};
});