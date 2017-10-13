jQuery(document).ready(function($) {


	// function buziness_custom_hide_metabox()
	// {
	// 	$('#offerposticondiv').hide();
	// 	$('#categorychecklist input[type="checkbox"]').each(function(i,e){
			
	// 		var id = $(this).attr('id').match(/-([0-9]*)$/i);
	// 		id = (id && id[1]) ? parseInt(id[1]) : null ;

	// 		if ($.inArray(id, []) > -1 && $(this).is(':checked')){

	// 			$('#offerposticondiv').show();
	// 		}
	// 	});
	// }
	// $('#categorychecklist input[type="checkbox"]').live('click', buziness_custom_hide_metabox);

	// buziness_custom_hide_metabox();
	
	$('.buziness_offer_icon_color').wpColorPicker();
	

	// Uploading files
	var file_frame;

	jQuery.fn.upload_listing_image = function( button ) {
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: button.data( 'uploader_title' ),
		  button: {
		    text: button.data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  jQuery("#"+field_id).val(attachment.id);
		  jQuery("#offerposticondiv img").attr('src',attachment.url);
		  jQuery( '#offerposticondiv img' ).show();
		  jQuery( '#' + button_id ).attr( 'id', 'remove_icon_image_button' );
		  jQuery( '#remove_icon_image_button' ).text( 'Remove Icon image' );
		});

		// Finally, open the modal
		file_frame.open();
	};

	jQuery('#offerposticondiv').on( 'click', '#upload_icon_image_button', function( event ) {
		event.preventDefault();
		jQuery.fn.upload_listing_image( jQuery(this) );
	});

	jQuery('#offerposticondiv').on( 'click', '#remove_icon_image_button', function( event ) {
		event.preventDefault();
		jQuery( '#upload_icon_image' ).val( '' );
		jQuery( '#offerposticondiv img' ).attr( 'src', '' );
		jQuery( '#offerposticondiv img' ).hide();
		jQuery( this ).attr( 'id', 'upload_icon_image_button' );
		jQuery( '#upload_icon_image_button' ).text( 'Set Icon image' );
	});



});