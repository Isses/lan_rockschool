$(document).ready( function(){
	var w 	= $(window);
	var ww 	= w.width();
	var wh 	= w.height();
	var doc = $(document);

	var nav = $('header');
	var transitionEl = $('section.transition');

	var hiddenBlocks = $('.hiddenBlock');


	var mediators = $('.mediators .mediator');
	if( mediators.length > 0 ) var mediatorParentPos = $('.mediators').parents('section').first().offset().top;


	setTimeout( function() { window.scrollTo(0,0); }, 200 );
	$("body").css({opacity:1});

	$(window).on('beforeunload', function() {
		$("body").css({opacity:0});
	    window.scrollTo(0,0); 
	});

	$(window).on("load", function(){
		

	setTimeout( 
	function() {
		var intro = $('.pageIntro');
		var loader = $('.pageLoader');	
		var primary 	= intro.find('.primary');
		var secondary 	= intro.find('.secondary');
		var hand 		= intro.find('.hand');

		primary.transition({ x: 0}, 700, "easeInOutExpo");
		secondary.transition({ x: 0, delay: 100}, 750, "easeInOutExpo");
		hand.transition({ x: 0, delay: 200}, 800, "easeInOutExpo", function() {
			loader.hide();
			hand.transition({ x: "100%", delay: 400}, 700, "easeInOutExpo");
			secondary.transition({ x: "100%", delay: 500}, 750, "easeInOutExpo");
			primary.transition({ x: "100%", delay: 600}, 800, "easeInOutExpo", function() {
				intro.hide();
				$('body').addClass('loaded');
				$(".scrolldown").transition({ scale:1 }, 500, "easeOutBack");
			});
		});

		

	}, 1000 );
	})

w.scroll(function(e) {
	if( !$('body').hasClass('loaded') ){
		e.originalEvent.preventDefault();
	}
	//window.scrollTo(0, 0);
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
			$(item).find('.content').css({ y: (-1+ratio)*diff });
		});		
	}
	if( hiddenBlocks.length > 0 ) {
		var keepShowing = true;
		while( keepShowing ) {
			if( hiddenBlocks.length > 0 && hiddenBlocks.first().offset().top - scrollValue - wh + 100 < 0 ) {
				hiddenBlocks.first().addClass('visible');
				hiddenBlocks.splice(0,1);
			} else {
				keepShowing = false;
			}
		}
	}

	if( mediators.length > 0 ) {
		mediators.each( function( index, item ) {
			var mediatorPos = $(item);
			$(item).css({ y: (scrollValue-mediatorParentPos)*.1*(index%2==0?1.5:3) });
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

// CUSTOM BLOCKS FOR ANIMATION
$('section>h2').each( function(index, item) {
	var html = $(item).html();
	var content = "";
	for (var i in html) {
		if( html[i] == ' ' ) content += '<span style="display: inline">'+html[i]+'</span>';
		else content += "<span>"+html[i]+"</span>";
	}
	$(item).html(content);
});

$('section .button').each( function(index, item) {
	var html = $(item).html();
	$(item).html('<div class="primary"></div><div class="secondary"></div><div class="buttonText">'+html+'</div>');
});
//

// ==================
// 		BLOC MEDIAS
// ==================
var blocMedias = $('section.action');
var blocMediasPrev = blocMedias.find('.arrow.prev');
var blocMediasNext = blocMedias.find('.arrow.next');
var blocMediasSlider = blocMedias.find('.slider .albums');
var albums = blocMedias.find('.slider .albums .album');
var nbAlbums = albums.length;
var blocMediasIndex = 0;

blocMediasPrev.css({ opacity:0 });

function mediasPrev() {
	--blocMediasIndex;
	if( blocMediasIndex < 0 ) blocMediasIndex = 0;
	setMediasIndex(blocMediasIndex);
}

function mediasNext() {
	++blocMediasIndex;
	if( blocMediasIndex > (nbAlbums-3) ) blocMediasIndex = (nbAlbums-3);
	setMediasIndex(blocMediasIndex);	
}

function setMediasIndex( index ) {
	if( index == 0 ) { 
		blocMediasPrev.stop(true).animate({ opacity:0 }, 300);
	} else { 
		blocMediasPrev.stop(true).animate({ opacity:1 }, 300);
	}

	if( index == nbAlbums-3 ) {
		blocMediasNext.stop(true).animate({ opacity:0 }, 300);
	} else { 
		blocMediasNext.stop(true).animate({ opacity:1 }, 300);
	}

	blocMediasSlider.stop(true).animate({ 'margin-left': -(index*33.33333)+'%' });
}

function initBlicMedias() {
	blocMediasPrev.click( mediasPrev );
	blocMediasNext.click( mediasNext );
}

albums.click( function() {
	openAlbum( $(this).data('link') );
})

initBlicMedias();

//PAGE MEDIAS
$('.medias .moreinfosbtn .button,.medias .wall .smallAlbum' ).click( function() {
	openAlbum( $(this).data('link') );
})

$('.medias .morepictures.button').click( function() {
	$('.medias .wall .smallAlbum').each( function( index, item) {
		$(this).show().css({opacity: 0, y:30 }).transition({ opacity: 1, y: 0, delay: 100*index }, 700 );
	})

	$(this).unbind('click');
	$(this).hide();

})

// ==================
// 		POPIN MEDIAS
// ==================

var albumViewer 	= $('#albumViewer');
var avTitle 		= albumViewer.find('.title');
var avCount 		= albumViewer.find('.count');
var avClose 		= albumViewer.find('.close');
var avPrev 			= albumViewer.find('.arrow.prev');
var avNext 			= albumViewer.find('.arrow.next');
var albumContainer 	= albumViewer.find('ul.albumsList');
var avIndex = 0;
var avMaxIndex = 0;
var avPictures;
var avCurrentDatas;

function initAlbumViewer() {
	avClose.click( closeAlbumViewer );
	avPrev.click( prevViewer );
	avNext.click( nextViewer );
	albumViewer.find('.share.facebook').click(shareFacebookViewer);
	albumViewer.find('.share.twitter').click(shareTwitterViewer);
}

function prevViewer() {
	if( --avIndex < 0 ) avIndex = 0;
	else setPictureViewer(avIndex,true);
}

function nextViewer() {
	if( ++avIndex >= avMaxIndex ) avIndex = avMaxIndex-1;
	else setPictureViewer(avIndex,true);
}

function setPictureViewer(avindex, animated) {
	avCount.find('b').html(avindex+1);
	avPictures.each( function(index, item) {
		$(item).stop(true).animate({ scale:(avindex==index)?1:.75, x:((index-avindex)*125)+"%" },(animated?700:0), "easeInOutExpo")
	});
}

function shareFacebookViewer() {
	var link = 'https://www.facebook.com/sharer/sharer.php?u=';
	link += encodeURIComponent( 'http://rockschool.paris/medias/?albumID='+ avCurrentDatas.ID );
	window.open( link, 'Share Rockschool', 'width=626,height=436');return false;
}

function shareTwitterViewer() {
	var link = 'https://www.twitter.com/share';
	link += '?text='+encodeURIComponent( avCurrentDatas.title );
	link += '?url='+encodeURIComponent( 'http://rockschool.paris/medias/?albumID='+ avCurrentDatas.ID );
	window.open( link, 'Share Rockschool', 'width=626,height=436');return false;
}

function closeAlbumViewer() {
	albumViewer.hide().css({ opacity: 0 });
}

function closeAlbumViewer() {
	albumViewer.hide().css({ opacity: 0 });
}

function openAlbum(albumID) {
	var data = {
	    'action': 'openAlbum',
	    'album-ID': albumID
	};
	$.post(ajaxurl, data, function(response) {
		avCurrentDatas = response;
		albumViewer.data('albumID', albumID);
		avCount.find('b').html('1');
		avCount.find('span').html(response.count);
		avTitle.html( response.title );
		albumContainer.empty();
		if( response.type == "Photos" ) {
			for( var i in response.medias) {
				albumContainer.append( "<li style='background-image:url(\""+response.medias[i]+"\");'></li>");
			}
		} else if( response.type == "Videos" ) {
			for( var i in response.medias) {
				albumContainer.append( "<li>"+response.medias[i]+"</li>");
			}
		}
		avIndex = 0;
		avMaxIndex = response.count;
		avPictures = albumContainer.find('li');
		setPictureViewer(0);
		albumViewer.show().css({ opacity: 1 });
		if( response.count==1) {
			avPrev.hide();
			avNext.hide();
			avCount.hide();
		} else {
			avPrev.show();			
			avNext.show();
			avCount.show();
		}
	});
}

initAlbumViewer();

// AUTO OPEN 
var RS_searchURL = decodeURIComponent(window.location.search );
// Si il y a des paramètres GET
if( RS_searchURL != "" ) { 
	RS_URLVariables = RS_searchURL.substr(1).split('&');
	for (i = 0; i < RS_URLVariables.length; i++) {
        RS_param = RS_URLVariables[i].split('=');

        if (RS_param[0] == 'albumID' && !isNaN(RS_param[1])) {
            openAlbum(RS_param[1]);
        }
    }
}

// ==================
//        HOME
// ==================
var homeNewsNbNews 		= 0;
var homeNewsCurrent		= 0;
var homeNewPictures 	= $('.home .news .pictures');
var homeNewTexts 	 	= $('.home .news .texts');
var homeNewPicturesList = $('.home .news .pictures .picture');
var homeNewTextsList	= $('.home .news .texts .text');
var homeNewsCount	 	= $('.home .news .pictures .navigation .count');
var homeNewsPrevBtn 	= $('.home .news .pictures .navigation .prevBtn');
var homeNewsNextBtn 	= $('.home .news .pictures .navigation .nextBtn');

function homeInitNews() {
	homeNewsCount.html( '1 / '+ homeNewsNbNews );
	homeNewsPrevBtn.click( homePrevNews );
	homeNewsNextBtn.click( homeNextNews );
	//homeSetNews(0)
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
		$(homeNewPicturesList[homeNewsCurrent]).stop(true).animate({ opacity: 0, x: 100 }, 1300, 'easeInOutExpo', function() { $(this).hide() ;} );
		$(homeNewTextsList[homeNewsCurrent]).stop(true).delay(100).animate({ opacity: 0, x: 100 }, 1300, 'easeInOutExpo', function() { $(this).hide() ;} );
		$(homeNewPicturesList[index]).stop(true).show().css({ opacity: 0, x: -100 });
		$(homeNewTextsList[index]).stop(true).show().css({ opacity: 0, x: -100 });
	} else {
		$(homeNewPicturesList[homeNewsCurrent]).stop(true).animate({ opacity: 0, x: -100 }, 1300, 'easeInOutExpo', function() { $(this).hide() ;} );
		$(homeNewTextsList[homeNewsCurrent]).stop(true).delay(100).animate({ opacity: 0, x: -100 }, 1300, 'easeInOutExpo', function() { $(this).hide() ;} );
		$(homeNewPicturesList[index]).stop(true).show().css({ opacity: 0, x: 100 });
		$(homeNewTextsList[index]).stop(true).show().css({ opacity: 0, x: 100 });
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

})