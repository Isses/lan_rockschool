var w 	= $(window);
var ww 	= w.width();
var wh 	= w.height();
var doc = $(document);

var nav = $('header');
var transitionEl = $('section.transition');

w.scroll(function() {
	var scrollValue = w.scrollTop();
	var headSize = (ww > 1200)?65:42;
	if(scrollValue >= wh - headSize) {	
		nav.addClass('collapsed');
	} else {
		nav.removeClass('collapsed');
	}

	if( transitionEl.length > 0 ) {
		transitionEl.each( function( index, item ) {
			var transitionElPos = $(item).data('position');
			var min = transitionElPos - wh;
			var max = min + 600;
			var size= (ww > 1200)?800:600;
			var ratio = Math.max( 0, Math.min( (scrollValue - min)/(wh+size), 1 ));
			var diff= (ww > 1200)?200:130;
			$(item).find('.content').css({ y: -ratio*diff });
		});		
	}
});

// Resize window
w.resize(function(){ 
	wh 	= w.height();
	ww = w.width();
	if( transitionEl.length > 0 ) {
		transitionEl.each( function( index, item ) { 
			$(item).data('position',$(item).position().top ); 
		})
	}
	w.scroll();

});
w.resize();


//
//
//




// ==================
//        HOME
// ==================
var homeNewsNbNews 		= 0;
var homeNewsCurrent		= -1;
var homeNewPictures 	= $('.home .news .pictures');
var homeNewTexts 	 	= $('.home .news .texts');
var homeNewPicturesList = $('.home .news .pictures .picture');
var homeNewTextsList	= $('.home .news .texts .text');
var homeNewsCount	 	= $('.home .news .pictures .navigation .count');
var homeNewsPrevBtn 	= $('.home .news .pictures .navigation .prevBtn');
var homeNewsNextBtn 	= $('.home .news .pictures .navigation .nextBtn');

function homeInitNews() {
	homeNewPicturesList.each( function( index, item){
		$(item).css({ opacity: 0, x: -100 });
	});

	homeNewTextsList.each( function( index, item){
		$(item).css({ opacity: 0, x: -100 });
	});

	homeNewsCount.html( '0 / '+ homeNewsNbNews );
	homeNewsPrevBtn.click( homePrevNews );
	homeNewsNextBtn.click( homeNextNews );
	homeSetNews(0)
}

function  homeNextNews() {
	if( homeNewsCurrent < homeNewsNbNews - 1 ) homeSetNews( homeNewsCurrent + 1 )
}

function homePrevNews() {
	if( homeNewsCurrent > 0 ) homeSetNews( homeNewsCurrent -1 )
}

function homeSetNews( index ) {
	if( homeNewsCurrent == index ) return;
	if( homeNewsCurrent < index ) {
		$(homeNewPicturesList[homeNewsCurrent]).stop(true).animate({ opacity: 0, x: 100 }, 1300, 'easeInOutExpo' );
		$(homeNewTextsList[homeNewsCurrent]).stop(true).delay(100).animate({ opacity: 0, x: 100 }, 1300, 'easeInOutExpo' );
		$(homeNewPicturesList[index]).stop(true).css({ opacity: 0, x: -100 });
		$(homeNewTextsList[index]).stop(true).css({ opacity: 0, x: -100 });
	} else {
		$(homeNewPicturesList[homeNewsCurrent]).stop(true).animate({ opacity: 0, x: -100 }, 1300, 'easeInOutExpo' );
		$(homeNewTextsList[homeNewsCurrent]).stop(true).delay(100).animate({ opacity: 0, x: -100 }, 1300, 'easeInOutExpo' );
		$(homeNewPicturesList[index]).stop(true).css({ opacity: 0, x: 100 });
		$(homeNewTextsList[index]).stop(true).css({ opacity: 0, x: 100 });
	}
	homeNewsCurrent = index;
	$(homeNewPicturesList[homeNewsCurrent]).stop(true).animate({ opacity: 1, x: 0 }, 1300, 'easeInOutExpo' );
	$(homeNewTextsList[homeNewsCurrent]).stop(true).delay(100).animate({ opacity: 1, x: 0 }, 1300, 'easeInOutExpo' );
	homeNewsCount.html( homeNewsCurrent+1 + ' / '+ homeNewsNbNews );
}

if( $('body.home').length == 1 ) {
	homeNewsNbNews = homeNewPicturesList.length;
	homeInitNews();
}