var hit_img_id = 0;
function hit_right() {
	img_all = $('.hit_prod img');

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');

	img_shown.animate({opacity:0},500);
	text_shown.animate({opacity:0},500);

	if(hit_img_id == img_all.length-1) {
		hit_img_id = 0;
	} else {
		hit_img_id = hit_img_id+1;
	}

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');
	img_shown.animate({opacity:1},500);
	text_shown.animate({opacity:1},500);
}

function hit_left() {
	img_all = $('.hit_prod img');

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');

	img_shown.animate({opacity:0},500);
	text_shown.animate({opacity:0},500);

	if(hit_img_id == 0) {
		hit_img_id =  img_all.length - 1;
	} else {
		hit_img_id = hit_img_id-1;
	}

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');
	img_shown.animate({opacity:1},500);
	text_shown.animate({opacity:1},500);
}

function interval () {
	hit_right();
}

$(document).ready(function() {
	setInterval(interval, 5000);

	if(window.location.href == 'http://jacauto.localhost/'){
		$('.menu_block a[href="/"]').attr({class:'current'});
	};
	if(window.location.href == 'http://jacauto.localhost/catalog'){
		$('.menu_block a[href="/catalog"]').attr({class:'current'});
	};
});