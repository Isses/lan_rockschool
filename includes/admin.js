jQuery(document).ready( function() {

	//--------------------- CHAMPS MEDIAS
	var _custom_media = true,
    _orig_send_attachment = wp.media.editor.send.attachment;
    
    initClickMedia = function( el ) {
        jQuery( el ).click(function(e) {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = jQuery(this);
            var field = button.parent().find('.fileField');
            var img = button.parent().find('img');
            _custom_media = true;
            wp.media.editor.send.attachment = function(props, attachment){
                if ( _custom_media ) {
                    img.attr('src', attachment.url);
                    field.val(attachment.url);
                } else {
                    return _orig_send_attachment.apply( this, [props, attachment] );
                };
            }
            wp.media.editor.open(button);
            return false;
        });
    }

	function initBlocks() {
		// switch tabs
		jQuery('.tableList .tabs .tab').click( function() {
			var parent = jQuery(jQuery(this).parents('.tableList')[0]);
			var link = jQuery(this).data('link');
			parent.find('.tab.current').removeClass('current');
			jQuery(this).addClass('current');
			parent.find('.content.current').removeClass('current');
			parent.find('.content[data-link='+link+']').addClass('current');
		});

		jQuery('#album-type input[type=radio]').change( function() {
			var parent = jQuery(jQuery(this).parents('.content')[0]);
			var blocVideo = jQuery('#album-videos').hide();
			var blocImage = jQuery('#album-photos').hide();
			if( this.value == 'Photos') blocImage.show();
			else if( this.value == 'Vidéos') blocVideo.show();
		});

		if( jQuery('#album-type input[type=radio]:checked').length == 0 ) {
			jQuery('#album-type input[type=radio]').first().prop("checked", true);
		} 
		jQuery('#album-type input[type=radio]:checked').change();
		

		jQuery('.tableList .content .header .blocposition input').change( function() {
			var parent = jQuery(jQuery(this).parents('.blocposition').first());
			parent.css({ opacity: 1 })
		});

		
		jQuery('.mediaBtn').each( function( index, item){ initClickMedia( item ); });
		jQuery('.removeMediaBtn').click( function(index,item){ 
			var parent = jQuery(jQuery(this).parents('.content')[0]);
		   	parent.find('img').attr('src',defaultImage);
		   	parent.find('.fileField')[0].value = "";
		});
	    jQuery('.add_media').on('click', function(){ _custom_media = false; });
	}

	initBlocks();
	
    

    wp.media.view.Modal.prototype.on('close', function(){ console.log('triggered close'); });
    //---------------------

	jQuery('.tableList .tabs .add-btn').click(function(e) {
	    var that = jQuery(this);
	    var parent 	= jQuery(jQuery(this).parents('.tableList')[0]);
	    var clone 	= parent.find('.content').first().clone();
	    var type 	= parent.data("type");
	    var count 	= parent.data("count");
	    parent.data("count",++count);

	    // on deselctionne les current
	    parent.find('.tab.current').removeClass('current');
	    parent.find('.content.current').removeClass('current');

	    // on insert la nouvelle tabulation
	    var newTab = jQuery('<div class="tab current" data-link="'+type+'-'+count+'" >'+type+'-'+count+'</div>');
	    newTab.insertBefore(that);

	    // on insert le nouveau contenu
	    clone.attr('data-link', type+'-'+count);
	    clone.find('[data-type]').each(function() {
            var el = jQuery(this);
            var types = el.attr('data-type').split(' ');
            for(var i in types) {
                switch(types[i]) {
                	case 'activable':
                        el.removeClass('active');
                        break;
                    case 'activated':
                        el.addClass('active');
                        break;
                    case 'title':
                        el.html(type+'-'+count);
                        break;
                    case 'src':
                        el.attr('src',defaultImage);
                        break;
                     case 'for':
                        el.attr('for',el.attr('for').replace(new RegExp('('+type+'-[0-9]*)'), type+'-'+count));
                        break;
                    case 'id':
                        el.attr('id',el.attr('id').replace(new RegExp('('+type+'-[0-9]*)'), type+'-'+count));
                        break;
                    case 'name':
                    	el.attr('name',el.attr('name').replace(new RegExp('('+type+'-[0-9]*)'), type+'-'+count));
                        break;
                    case 'value':
                        el.attr('value','');
                        break;
                    case 'html':
                        el.html('');
                        break;
                    case 'unchecked':
                       	el.prop('checked',false);
                        break;
                    case 'checked':
                       	el.prop('checked',true);
                        break;
                    case 'wysiwyg':
                       	
                       	var name = el.data('name').replace(new RegExp('('+type+'-[0-9]*)'), type+'-'+count);
                       	el.attr('name',el.data('name').replace(new RegExp('('+type+'-[0-9]*)'), type+'-'+count));
                       	el.html('<textarea class="mceEditor" name="'+name+'" id="'+name+'"></textarea>');
	                    
	                    setTimeout( function(){
		                    tinyMCE.init({
							        mode : "textareas",
							        theme:"modern",
							        skin:"lightgray",language:"fr",
							        formats:{
										alignleft: [
											{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'left'}},
											{selector: 'img,table,dl.wp-caption', classes: 'alignleft'}
										],
										aligncenter: [
											{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'center'}},
											{selector: 'img,table,dl.wp-caption', classes: 'aligncenter'}
										],
										alignright: [
											{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'right'}},
											{selector: 'img,table,dl.wp-caption', classes: 'alignright'}
										],
										strikethrough: {inline: 'del'}
									},
							        block_formats:"Paragraph=p;Pre=pre;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6",
							        relative_urls:false,
							        remove_script_host:false,
							        convert_urls:false,
							        browser_spellcheck:true,
							        fix_list_elements:true,
							        entities:"38,amp,60,lt,62,gt",
							        entity_encoding:"raw",
							        keep_styles:false,
							        cache_suffix:"wp-mce-4107-20150505",
							        preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",
							        wpeditimage_disable_captions:false,
							        wpeditimage_html5_captions:false,
							        plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpgallery,wplink,wpdialogs,wpview,image",
							        content_css:"http://localhost/wp-includes/css/dashicons.min.css?ver=4.1.5,http://localhost/wp-includes/js/tinymce/skins/wordpress/wp-content.css?ver=4.1.5",
							        resize:"vertical",
							        menubar:false,
							        wpautop:true,
							        indent:false,
							        toolbar1:"bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv",
							        toolbar2:"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
							        toolbar3:"",
							        toolbar4:"",
							        tabfocus_elements:":prev,:next",
							        body_class: name + " post-type-projets post-status-publish locale-fr-fr",
							        editor_selector : "mceEditor"
							});
							el.find('textarea').removeClass('mceEditor');
	                    }, 1000 );

                        break;

                }
            }
        });
        parent.find('.container').append(clone);
        clone.addClass('current');
	    // on reinitialise les boutons
	    initBlocks();
	});

	jQuery('.tableList .tabs .remove-btn').click(function(e) {
		var parent = jQuery(jQuery(this).parents('.tableList')[0]);
	    var numTabs = parent.find('.tabs .tab').length;
	    if( numTabs == 1 ) return;

	    parent.find('.tab.current').remove();
	    parent.find('.content.current').remove();
	    parent.find('.tab').first().addClass('current');
	    parent.find('.content').first().addClass('current');
	});
});