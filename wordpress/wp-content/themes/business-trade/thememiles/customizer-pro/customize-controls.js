( function( api ) {

	// Extends our custom "business-trade" section.
	api.sectionConstructor['business-trade'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
