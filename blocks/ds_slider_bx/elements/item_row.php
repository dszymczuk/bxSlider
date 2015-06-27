<?php    defined('C5_EXECUTE') or die("Access Denied."); ?> 
<div id="ccm-slideshowBlock-itemRow<?php   echo $itemInfo['itemId']?>" class="ccm-slideshowBlock-itemRow">
	<div class="backgroundRow" style="background: url(<?php   echo $itemInfo['thumbPath']?>) no-repeat left top; padding-left: 100px;">
		<div class="cm-slideshowBlock-itemRowIcons" >
			<div style="float:right">
				<a onclick="SlideshowBlock.moveUp('<?php   echo $itemInfo['itemId']?>')" class="moveUpLink"></a>
				<a onclick="SlideshowBlock.moveDown('<?php   echo $itemInfo['itemId']?>')" class="moveDownLink"></a>
			</div>
			<div style="margin-top:4px"><a onclick="SlideshowBlock.removeItem('<?php   echo $itemInfo['itemId']?>')"><img src="<?php   echo ASSETS_URL_IMAGES?>/icons/delete_small.png" /></a></div>
		</div>
        
		<strong><?php  echo $itemInfo['fileName']?></strong>
        <div style="margin: 10px 0;">
         	<?php  echo $form->label('itemTitle[]', t('Title'),array('style' => 'float: left ; margin-top: 5px; margin-right: 10px;') );?>
        	<?php  echo $form->text('itemTitle[]', $itemInfo['itemTitle'], array('style' => 'width: 350px'));?>
        </div>
		<input type="hidden" name="itemFIDs[]" value="<?php   echo $itemInfo['fID']?>">
		<div class="clearfix" style="margin: 0 ; padding: 0"></div>
	</div>
</div>