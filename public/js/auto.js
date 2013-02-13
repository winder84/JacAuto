var hit_img_id = 0;
function hit_right() {
	img_all = $('.hit_prod img');

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');

	img_shown.animate({opacity:0});
	text_shown.animate({opacity:0});

	if(hit_img_id == img_all.length-1) {
		hit_img_id = 0;
	} else {
		hit_img_id = hit_img_id+1;
	}

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');
	img_shown.animate({opacity:1});
	text_shown.animate({opacity:1});
}

function hit_left() {
	img_all = $('.hit_prod img');

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');

	img_shown.animate({opacity:0});
	text_shown.animate({opacity:0});

	if(hit_img_id == 0) {
		hit_img_id =  img_all.length - 1;
	} else {
		hit_img_id = hit_img_id-1;
	}

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');
	img_shown.animate({opacity:1});
	text_shown.animate({opacity:1});
}