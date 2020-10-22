Vue.config.devtools = true;

Vue.component( 'jet-forms-popup-notification', {
    template: '#jet-forms-popup-notification',
    props: {
        propProviders: Array,
        value: Object
    },
    data: function() {
        return {
            popups: [],
            providers: {},
            resultData: {},
            isLoading: false
        };
    },
    created: function() {
        this.providers = this.propProviders;
        this.parseValueModel( this.value );

        this.fetchTypeFields();
    },

    methods: {
        parseValueModel: function ( valObject ) {
            if ( typeof valObject === "undefined" ) {
                return;
            }

            let fields = {
                provider: null,
                popup: this.filterPopup
            };

            for (const fieldName in fields) {
                if ( typeof valObject[ fieldName ] !== "undefined"
                    && valObject[ fieldName ] )
                {
                    let value = valObject[ fieldName ];
                    if ( fields[ fieldName ] ) {
                        value = fields[ fieldName ]( value );
                    }

                    this.$set(
                        this.resultData,
                        fieldName,
                        value
                    );
                }
            }
        },
        filterPopup: function ( value ) {
            return parseInt( value, 10 );
        },

        setField: function( $event, key ) {

            var value = $event.target.value;

            this.$set( this.resultData, key, value );
            this.$emit( 'input', this.resultData );

            if ( 'provider' === key ) {
                this.fetchTypeFields();
                this.$set( this.resultData, 'popup', '');
            }

        },
        fetchTypeFields: function () {

            if ( ! this.resultData.provider ) {
                return;
            }
            var self = this;

            this.isLoading = true;

            if ( self.popups ) {
                self.popups.splice( 0, self.popups.length );
            }

            jQuery.ajax({
                url: ajaxurl,
                type: 'GET',
                dataType: 'json',
                data: {
                    action: 'jet_pep_get_popups_by_provider',
                    provider: self.resultData.provider
                },
            }).done( function( response ) {

                if ( response.success && response.data.popups ) {

                    for (let i = 0; i < response.data.popups.length; i++) {
                        self.$set( self.popups, i, response.data.popups[ i ] );
                    }
                }
                self.$set( self,'isLoading', false );
                self.$forceUpdate();

            } ).fail( function( jqXHR, textStatus, errorThrown ) {
                console.log( textStatus, errorThrown );
                self.$set( self,'isLoading', false );
            } );


        },
    },

});
