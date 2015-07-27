<?php  
/**
 * @author Damian Szymczuk
 * @link https://github.com/dszymczuk/bxSlider
 * @link http://dszymczuk.pl
 */
defined('C5_EXECUTE') or die("Access Denied.");
$ah = Loader::helper('concrete/interface');
?>

<style type="text/css">

</style>

<!-- Begin: Tabs -->
<ul id="ccm-slider-tabs" class="ccm-dialog-tabs">
	<li class="ccm-nav-active"><a id="ccm-slider-tab-items" href="javascript:void(0);"><?php  echo t('Images')?></a></li>
    <li class=""><a id="ccm-slider-tab-general"  href="javascript:void(0);"><?php  echo t('General')?></a></li>
    <li class=""><a id="ccm-slider-tab-pager"  href="javascript:void(0);"><?php  echo t('Pager')?></a></li>
    <li class=""><a id="ccm-slider-tab-controls"  href="javascript:void(0);"><?php  echo t('Controls')?></a></li>
    <li class=""><a id="ccm-slider-tab-auto"  href="javascript:void(0);"><?php  echo t('Auto')?></a></li>
	<li class=""><a id="ccm-slider-tab-carousel"  href="javascript:void(0);"><?php  echo t('Carousel')?></a></li>
</ul>
<!-- End: Tabs -->
	
<div class="bx-slider-ui ccm-ui" style="">
    <!-- Begin: Items Tab -->
	<div class="ccm-sliderPane" id="ccm-sliderPane-items">
          <div class="clearfix" style="width:99%; margin-bottom:10px;">
	            <div id="ccm-slideshowBlock-chooseItem"><?php   echo $ah->button_js(t('Add Image'), 'SlideshowBlock.chooseItem()', 'right', $innerClass='btn-info');?></div>
          </div>
          <div class="clearfix" style="width:99%">
                <div id="ccm-slideshowBlock-itemRows">
	            <?php 
                foreach($items as $itemInfo){ 
                    $f = File::getByID($itemInfo['fID']);
                    $fp = new Permissions($f);
                    $itemInfo['thumbPath'] = $f->getThumbnailSRC(1);
                    $itemInfo['fileName'] = $f->getTitle();
                    if ($fp->canRead()) { 
                        $this->inc('elements/item_row.php', array('itemInfo' => $itemInfo));
                    }
                }
            	?>
		        </div>
          </div>      
    </div>
    <!-- End: Items Tab -->



    <!-- Begin: general Tab -->
    <div class="ccm-sliderPane ccm-general-pager" id="ccm-sliderPane-general" style="clear: both;display: none">
    


<div class="ccm-block-field-group">
    <h4><?php  echo t('Mode')?></h4>
    <p class="muted"><?php  echo t('')?></p>
    <?php  echo $form->select('mode', $modeArray, $mode, array('class'=>'span1', 'style'=>'direction:ltr; text-align:left; width:100px;')); ?>
</div>





<div class="ccm-block-field-group">
    <h4><?php  echo t('Speed')?></h4>
    <p class="muted"><?php  echo t('Slide transition duration (in ms)')?></p>
    <?php  echo $form->text('speed', $speed, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Slide Margin')?></h4>
    <p class="muted"><?php  echo t('Margin between each slide')?></p>
    <?php  echo $form->text('slideMargin', $slideMargin, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Start Slide')?></h4>
    <p class="muted"><?php  echo t('Starting slide index (zero-based)')?></p>
    <?php  echo $form->text('startSlide', $startSlide, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Random Start')?></h4>
    <p class="muted"><?php  echo t('Start slider on a random slide')?></p>
    <?php  echo $form->checkbox('randomStart', 1, $randomStart, array()); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Infinite Loop')?></h4>
    <p class="muted"><?php  echo t('If checked, clicking "Next" while on the last slide will transition to the first slide and vice-versa')?></p>
    <?php  echo $form->checkbox('infiniteLoop', 1, $infiniteLoop, array()); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Hide Control On End')?></h4>
    <p class="muted"><?php  echo t('If checked, "Next" control will be hidden on last slide and vice-versa ; Note: Only used when infiniteLoop is unchecked')?></p>
    <?php  echo $form->checkbox('hideControlOnEnd', 1, $hideControlOnEnd, array()); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Captions')?></h4>
    <p class="muted"><?php  echo t('Include image captions. Captions are derived from the image\'s title attribute')?></p>
    <?php  echo $form->checkbox('captions', 1, $captions, array()); ?>
</div>

    <div class="ccm-block-field-group">
    <h4><?php  echo t('Easing')?></h4>
    <p class="muted"><?php  echo t('The type of "easing" to use during transitions. Null is not easing effect')?></p>
    <?php  echo $form->select('easing', $easingArray, $easing, array('class'=>'span1', 'style'=>'direction:ltr; text-align:left; width:100px;')); ?>
</div>



<div class="ccm-block-field-group">
    <h4><?php  echo t('Adaptive Height')?></h4>
    <p class="muted"><?php  echo t('Dynamically adjust slider height based on each slide\'s height')?></p>
    <?php  echo $form->checkbox('adaptiveHeight', 1, $adaptiveHeight, array()); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Adaptive Height Speed')?></h4>
    <p class="muted"><?php  echo t('Slide height transition duration (in ms). Note: only used if adaptiveHeight is checked')?></p>
    <?php  echo $form->text('adaptiveHeightSpeed', $adaptiveHeightSpeed, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Responsive')?></h4>
    <p class="muted"><?php  echo t('Enable or disable auto resize of the slider. Useful if you need to use fixed width sliders.')?></p>
    <?php  echo $form->checkbox('responsive', 1, $responsive, array()); ?>
</div>

    <div class="ccm-block-field-group">
    <h4><?php  echo t('Preload Images')?></h4>
    <p class="muted"><?php  echo t('If "all", preloads all images before starting the slider. If "visible", preloads only images in the initially visible slides before starting the slider (tip: use "visible" if all slides are identical dimensions)')?></p>
    <?php  echo $form->select('preloadImages', $preloadImagesArray, $preloadImages, array('class'=>'span1', 'style'=>'direction:ltr; text-align:left; width:100px;')); ?>
</div>



<div class="ccm-block-field-group">
    <h4><?php  echo t('Touch Enabled')?></h4>
    <p class="muted"><?php  echo t('If true, slider will allow touch swipe transitions')?></p>
    <?php  echo $form->checkbox('touchEnabled', 1, $touchEnabled, array()); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Swipe Threshold')?></h4>
    <p class="muted"><?php  echo t('Amount of pixels a touch swipe needs to exceed in order to execute a slide transition. Note: only used if touchEnabled is checked')?></p>
    <?php  echo $form->text('swipeThreshold', $swipeThreshold, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>

<div class="ccm-block-field-group">
    <h4><?php  echo t('One To One Touch')?></h4>
    <p class="muted"><?php  echo t('If checked, non-fade slides follow the finger as it swipes')?></p>
    <?php  echo $form->checkbox('oneToOneTouch', 1, $oneToOneTouch, array()); ?>
</div>














    </div>
    <!-- End: general Tab -->

    <!-- Begin: pager Tab -->
	<div class="ccm-sliderPane ccm-pager-pane" id="ccm-sliderPane-pager" style="clear: both;display: none">

        <div class="ccm-block-field-group">
    <h4><?php  echo t('Pager')?></h4>
    <p class="muted"><?php  echo t('If checked, a pager will be added')?></p>
    <?php  echo $form->checkbox('pager', 1, $pager, array()); ?>
</div>

    <div class="ccm-block-field-group">
    <h4><?php  echo t('Pager Type')?></h4>
    <p class="muted"><?php  echo t('If "full", a pager link will be generated for each slide. If "short", a x / y pager will be used (ex. 1 / 5)')?></p>
    <?php  echo $form->select('pagerType', $pagerTypeArray, $pagerType, array('class'=>'span1', 'style'=>'direction:ltr; text-align:left; width:100px;')); ?>
</div>


    <div class="ccm-block-field-group">
    <h4><?php  echo t('Pager Short Separator')?></h4>
    <p class="muted"><?php  echo t('If pagerType: "short", pager will use this value as the separating character')?></p>
    <?php  echo $form->text('pagerShortSeparator', $pagerShortSeparator, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>
    </div>
    <!-- End: pager Tab -->


    <!-- Begin: controls Tab -->
	<div class="ccm-sliderPane ccm-controls-pane" id="ccm-sliderPane-controls" style="clear: both;display: none">
	    <div class="clearfix" style="width:99%">

<div class="ccm-block-field-group">
    <h4><?php  echo t('Controls')?></h4>
    <p class="muted"><?php  echo t('If checked, "Next" / "Prev" controls will be added')?></p>
    <?php  echo $form->checkbox('controls', 1, $controls, array()); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Auto Controls')?></h4>
    <p class="muted"><?php  echo t('If checked, "Start" / "Stop" controls will be added')?></p>
    <?php  echo $form->checkbox('autoControls', 1, $autoControls, array()); ?>
</div>

<div class="ccm-block-field-group">
    <h4><?php  echo t('Auto Controls Combine')?></h4>
    <p class="muted"><?php  echo t('When slideshow is playing only "Stop" control is displayed and vice-versa')?></p>
    <?php  echo $form->checkbox('autoControlsCombine', 1, $autoControlsCombine, array()); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Next Text')?></h4>
    <p class="muted"><?php  echo t('Text to be used for the "Next" control')?></p>
    <?php  echo $form->text('nextText', $nextText, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>

    

<div class="ccm-block-field-group">
    <h4><?php  echo t('Prev Text')?></h4>
    <p class="muted"><?php  echo t('Text to be used for the "Prev" control')?></p>
    <?php  echo $form->text('prevText', $prevText, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>

<div class="ccm-block-field-group">
    <h4><?php  echo t('Start Text')?></h4>
    <p class="muted"><?php  echo t('Text to be used for the "Start" control')?></p>
    <?php  echo $form->text('startText', $startText, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Stop Text')?></h4>
    <p class="muted"><?php  echo t('Text to be used for the "Stop" control')?></p>
    <?php  echo $form->text('stopText', $stopText, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>



        </div>
    </div>
    <!-- End: controls Tab -->
        
        <!-- Begin: auto Tab -->
    <div class="ccm-sliderPane ccm-auto-pane" id="ccm-sliderPane-auto" style="clear: both;display: none">
        <div class="clearfix" style="width:99%">

    <div class="ccm-block-field-group">
        <h4><?php  echo t('Auto')?></h4>
        <p class="muted"><?php  echo t('Slides will automatically transition')?></p>
        <?php  echo $form->checkbox('auto', 1, $auto, array()); ?>
    </div>

    <div class="ccm-block-field-group">
        <h4><?php  echo t('Pause')?></h4>
        <p class="muted"><?php  echo t('The amount of time (in ms) between each auto transition')?></p>
        <?php  echo $form->text('pause', $pause, array('class'=>'span1', 'style'=>'text-align:left;')); ?>
    </div>

    <div class="ccm-block-field-group">
        <h4><?php  echo t('Auto Start')?></h4>
        <p class="muted"><?php  echo t('Auto show starts playing on load. If false, slideshow will start when the "Start" control is clicked')?></p>
        <?php  echo $form->checkbox('autoStart', 1, $autoStart, array()); ?>
    </div>

    <div class="ccm-block-field-group">
        <h4><?php  echo t('Auto Direction')?></h4>
        <p class="muted"><?php  echo t('The direction of auto show slide transitions')?></p>
        <?php  echo $form->select('autoDirection', $autoDirectionArray, $autoDirection, array('class'=>'span1', 'style'=>'direction:ltr; text-align:left; width:100px;')); ?>
    </div>

    <div class="ccm-block-field-group">
        <h4><?php  echo t('Auto Hover')?></h4>
        <p class="muted"><?php  echo t('Auto show will pause when mouse hovers over slider')?></p>
        <?php  echo $form->checkbox('autoHover', 1, $autoHover, array()); ?>
    </div>

    <div class="ccm-block-field-group">
    <h4><?php  echo t('Auto Delay')?></h4>
    <p class="muted"><?php  echo t('Time (in ms) auto show should wait before starting')?></p>
    <?php  echo $form->text('autoDelay', $autoDelay, array('class'=>'span1', 'style'=>'text-align:left;')); ?>
</div>








        </div>
    </div>
    <!-- End: auto Tab -->



    <!-- Begin: carousel Tab -->
    <div class="ccm-sliderPane ccm-carousel-pane" id="ccm-sliderPane-carousel" style="clear: both;display: none">
        <div class="clearfix" style="width:99%">



<div class="ccm-block-field-group">
    <h4><?php  echo t('Min slides')?></h4>
    <p class="muted"><?php  echo t('The minimum number of slides to be shown. Slides will be sized down if carousel becomes smaller than the original size.')?></p>
    <?php  echo $form->text('minSlides', $minSlides, array('class'=>'span1', 'style'=>'text-align:left;')); ?>
</div>

<div class="ccm-block-field-group">
    <h4><?php  echo t('Max slides')?></h4>
    <p class="muted"><?php  echo t('The maximum number of slides to be shown. Slides will be sized up if carousel becomes larger than the original size.')?></p>
    <?php  echo $form->text('maxSlides', $maxSlides, array('class'=>'span1', 'style'=>'text-align:left;', 'maxlength'=>'5')); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Move slides')?></h4>
    <p class="muted"><?php  echo t('The number of slides to move on transition. This value must be >= minSlides, and <= maxSlides. If zero (default), the number of fully-visible slides will be used.')?></p>
    <?php  echo $form->text('moveSlides', $moveSlides, array('class'=>'span1', 'style'=>'text-align:left;')); ?>
</div>


<div class="ccm-block-field-group">
    <h4><?php  echo t('Slide width')?></h4>
    <p class="muted"><?php  echo t('The width of each slide. This setting is required for all horizontal carousels!')?></p>
    <?php  echo $form->text('slideWidth', $slideWidth, array('class'=>'span1', 'style'=>'text-align:left;')); ?>
</div>

        </div>
    </div>
    <!-- End: carousel Tab -->



           
</div>        


<div id="itemRowTemplateWrap" style="display:none">
<?php   
$itemInfo['itemId']='tempItemId';
$itemInfo['fID']='tempFID';
$itemInfo['fileName']='tempFilename';
$itemInfo['origfileName']='tempOrigFilename';
$itemInfo['thumbPath']='tempThumbPath';
$itemInfo['itemTitle']='';
$itemInfo['itemDesc']='';
$itemInfo['itemUrl']='';
$itemInfo['class']='ccm-slideshowBlock-itemRow';
?>
<?php  $this->inc('elements/item_row.php', array('itemInfo' => $itemInfo)); ?> 
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(".launch-tooltip").tooltip();
});
</script>