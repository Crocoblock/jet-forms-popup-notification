<div class="jet-forms-popup-notification">

    <div class="jet-form-editor__row">
        <div class="jet-form-editor__row-label"><?php
            _e( 'Select provider:', 'jet-forms-popup-notification' );
            ?></div>
        <div class="jet-form-editor__row-control">

            <select @input="setField( $event, 'provider' )" :value="resultData.provider">
                <option value="">Select provider...</option>
                <option v-for="provider in providers" :value="provider.value">{{ provider.label }}</option>
            </select>

        </div>
    </div>

    <div :class="{ 'jet-form-editor__row': true, 'jet-forms-popup-notification-loading': isLoading }">
        <div class="jet-form-editor__row-label"><?php
            _e( 'Select popup:', 'jet-forms-popup-notification' );
            ?></div>
        <div class="jet-form-editor__row-control">
            <div class="jet-form-editor__row-control">
                <select @input="setField( $event, 'popup' )" :value="resultData.popup">
                    <option value="">Select...</option>
                    <option v-for="popup in popups" :value="popup.value" :selected="popup.value === resultData.popup">
                        {{ popup.label }}
                    </option>
                </select>
            </div>
        </div>
    </div>

</div>
