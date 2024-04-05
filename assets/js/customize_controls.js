/* eslint-disable no-undef */
//JS for Admin Area

( function() {
	// Slider Control
	wp.customize.bind( 'ready', function() {
		const customize = this;
		
		rangeSlider();
		handleHeaderWidget.call(customize);
	} );

	// eslint-disable-next-line no-var
	var rangeSlider = function() {
		const slider = jQuery( '.range-slider' ),
			range = jQuery( '.range-slider__range' ),
			value = jQuery( '.range-slider__value' );

		slider.each( function() {
			value.each( function() {
				const value = jQuery( this ).prev().attr( 'value' );
				const suffix = ( jQuery( this ).prev().attr( 'suffix' ) ) ? jQuery( this ).prev().attr( 'suffix' ) : '';
				jQuery( this ).html( value + suffix );
			} );

			range.on( 'input', function() {
				const suffix = ( jQuery( this ).attr( 'suffix' ) ) ? jQuery( this ).attr( 'suffix' ) : '';
				jQuery( this ).next( value ).html( this.value + suffix );
			} );
		} );
	};

    function handleHeaderWidget() {
        const headerBtn = this.control('itre_header_widget').container.find('button');
        const headerSidebar = this.section('sidebar-widgets-header');

        if (headerBtn.length !== 0) {
            headerBtn[0].addEventListener('click', () => {
                headerSidebar.focus();
            });
        } 
    };
}( jQuery ) );
