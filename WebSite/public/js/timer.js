$(document).ready(function(){
	timer();
	function timer() {
		var dt = new Date();
		console.log(dt.getSeconds());
		window.DEFAULT_VALUE = Math.round(360 - ((dt.getSeconds()%30) * 360) / 30);
		$('#demo').pietimer({
	    seconds: 30 - (dt.getSeconds()%30),
	    color: 'rgba(51,122,183, 1)',
	    height: 60,
	    width: 60
		},
		function(){
			window.DEFAULT_VALUE = 360;
			timer();
			angular.element('#controller').scope().get();
		});
		$('#demo').pietimer('start');
	};
});