<?php
/**************************
* Metaboxes config        *
* Created by Brackets.    *
* User: slitefull         *
* Date: 29/05/2020        *
* Time: 17:28 AM          *
***************************/

$meta_box = new MTMetaBox();
$meta_box
/** ========================================== Metabox ============================================ **/
->add('', 'page', 'Additional params', 'Additional params', function ($post) { ?>
<div class="wrapperAllBlocks">
    <div class=fullMetaBox>
        <h3>MetaBox</h3>
        <input type="text" name="MT_metabox" value="<?php echo get_post_meta($post->ID, 'MT_metabox', true); ?>">
    </div>
</div>
<?php })    
->addMetaBoxInit();
/** =============================================================================================== **/
