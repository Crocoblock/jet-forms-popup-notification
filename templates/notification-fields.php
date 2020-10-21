<?php
/**
 * Notifications fields template
 */
?>
<div v-if="'<?php echo $type_slug; ?>' === currentItem.type">
    <keep-alive>
        <jet-forms-popup-notification v-model="currentItem.popup" :prop-providers="<?php echo $providers; ?>"></jet-forms-popup-notification>
    </keep-alive>
</div>