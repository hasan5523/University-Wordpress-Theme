( function( $, api ) {

	/* === Section Manager Control === */
	api.controlConstructor['section-manager'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'input:checkbox', control.container ).change(
				function() {

					// Get all of the checkbox values.
					var checkbox_values = $( 'input[type="checkbox"]:checked', control.container ).map(
						function() {
							return this.value;
						}
					).get();

					// Set the value.
					if ( null === checkbox_values ) {
						control.setting.set( '' );
					} else {
						control.setting.set( checkbox_values );
					}
				}
			);

		}
	} );

	/* === Dropdown Taxonomies Control === */
	api.controlConstructor['dropdown-taxonomies'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'select', control.container ).change(
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );

	/* === Dropdown Sidebars Control === */
	api.controlConstructor['dropdown-sidebars'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'select', control.container ).change(
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );

	/* === Upsell Section === */
	api.sectionConstructor['upsell'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( jQuery, wp.customize );
