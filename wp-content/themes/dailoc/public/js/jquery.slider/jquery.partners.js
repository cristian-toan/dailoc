jQuery(document).ready(function ($) {
	var options = {
		$AutoPlay: true,
		$AutoPlaySteps: 5,
		$AutoPlayInterval: 8000,
		$PauseOnHover: 1,

		$ArrowKeyNavigation: true,
		$SlideDuration: 500,
		$MinDragOffsetToSlide: 20,
		$SlideWidth: 115,
		//$SlideHeight: 251,
		$SlideSpacing: 15,
		$DisplayPieces: 5,
		$ParkingPosition: 0,
		$UISearchMode: 1,
		$PlayOrientation: 1,
		$DragOrientation: 1,

		$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$,
			$ChanceToShow: 1,
			$AutoCenter: 2,
			$Steps: 5
		}
	};

	var jssor_slider = new $JssorSlider$("_partners", options);
	function ScaleSlider() {
		var parentWidth = $('#_partners').parent().width();
		if (parentWidth) {
			jssor_slider.$ScaleWidth(parentWidth);
		}
		else
			window.setTimeout(ScaleSlider, 30);
	}
	ScaleSlider();
	if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
		$(window).bind('resize', ScaleSlider);
	}
	if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
		$(window).bind("orientationchange", ScaleSlider);
	}
	$Jssor$.$AddEvent(window, "load", ScaleSlider);
	$Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
	$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
});