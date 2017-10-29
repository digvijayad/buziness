/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function( $ ) {

	wp.customize.bind( 'ready', function() {

		// All the settings activation checkboxes and the control ids
		var settingsIds = {
			"buziness_testimonials_setting_activate" : {
				"searchTerm" : 1,
			 	"controls": [
					'buziness_testimonial_shortcode',
					'buziness_testimonials_title',
					'buziness_testimonails_dropdown_types',
					'buziness_testimonials_background_image',
					'buziness_testimonails_dropdown_categories'
				]},
			"buziness_call_to_action_activate": {
				'searchTerm' : 1,
				"controls": [
					'buziness_call_to_action_title',
					'buziness_call_to_action_desc'
				]},
			"buziness_counter_activate" :{
				'searchTerm' : 1,
				"controls": [
					'buziness_counter_1',
					'buziness_counter_background_image'
				]},
			"buziness_services_setting_activate": {
				'searchTerm' : 1,
				"controls": [
					'buziness_services_title',
					'buziness_services_desc',
					'buziness_services_dropdown_categories'
				]},
			"buziness_testimonial_shortcode": {
				'searchTerm' : "",
				"controls":[
					'buziness_testimonials_title',
					'buziness_testimonails_dropdown_types',
					'buziness_testimonials_background_image',
					'buziness_testimonails_dropdown_categories'
				]},
			"buziness_testimonails_dropdown_types" : {
				"searchTerm": 2,
				"controls" : [
					"buziness_testimonials_background_image"
				]}
		};
		//loop through each setting id
		$.each(settingsIds, function(i, value){

			//find the setting id customize object
			wp.customize(i, function( setting ){
				//loop through the controls ids for each settings
				$.each(value["controls"], function(i, controlIds){

					//find the control customize object
					wp.customize.control( controlIds, function( control ){
						var visibility = function(){
							//set visibility of controls if setting is activated
							// console.log(controlIds +  setting.get());
							if ( (value["searchTerm"]) == setting.get() ) {
								control.container.slideDown( 180 );
							} else {
								control.container.slideUp( 180 );
							}
						}
						//bind the function to trigger visibilty each time.
						setting.bind(visibility);
						visibility();
					});
				});
			});
		});

	});
})( jQuery );
