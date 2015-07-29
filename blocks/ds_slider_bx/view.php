<?php   
/**
 * @author Damian Szymczuk
 * @link https://github.com/dszymczuk/bxSlider
 * @link http://dszymczuk.pl
 */
defined('C5_EXECUTE') or die("Access Denied."); 
?>
        <ul id="<?php  echo "bxSlider-".$blockIdentifier; ?>" class="bxslider" style="display:none">
        <?php foreach($items as $item): ?>
                <li><img
                        src="<?php echo $item['itemImageSrc']; ?>" 
                        alt="<?php echo $item['itemImageAlt']; ?>" 
                        title="<?php echo $item['itemImageTitle']; ?>" 
                        data-thumb="<?php echo $item['itemImageSrc']; ?>" ></li>
        <?php endforeach;?>
        </ul>

<?php  if(count($items)>0) { ?>
<script type="text/javascript">
$(document).ready(function() {

        $('<?php  echo "#bxSlider-".$blockIdentifier; ?>').css("display","block");

        $('<?php  echo "#bxSlider-".$blockIdentifier; ?>').bxSlider({
                mode : '<?php echo $modeArray[$mode]; ?>',     
                speed : <?php echo $speed; ?>,
                slideMargin : <?php echo $slideMargin; ?>,
                startSlide : <?php echo $startSlide; ?>,
                startSlide : <?php echo $startSlide; ?>,
                randomStart : <?php echo $randomStart; ?>,
                infiniteLoop : <?php echo $infiniteLoop; ?>,
                hideControlOnEnd : <?php echo $hideControlOnEnd; ?>,
                easing : <?php echo $easing; ?>,
                captions : <?php echo $captions; ?>,
                adaptiveHeight : <?php echo $adaptiveHeight; ?>,
                adaptiveHeightSpeed : <?php echo $adaptiveHeightSpeed; ?>,
                responsive : <?php echo $responsive; ?>,
                preloadImages : <?php echo $preloadImages; ?>,
                touchEnabled : <?php echo $touchEnabled; ?>,
                swipeThreshold : <?php echo $swipeThreshold; ?>,
                oneToOneTouch : <?php echo $oneToOneTouch; ?>,
                pager : <?php echo $pager; ?>,
                pagerShortSeparator : '<?php echo $pagerShortSeparator[$pagerType]; ?>',
                controls : <?php echo $controls; ?>,
                nextText : '<?php echo $nextText; ?>',
                prevText : '<?php echo $prevText; ?>',
                autoControls : <?php echo $autoControls; ?>,
                startText : '<?php echo $startText; ?>',
                stopText : '<?php echo $stopText; ?>',
                autoControlsCombine : <?php echo $autoControlsCombine; ?>,
                auto : <?php echo $auto; ?>,
                pause : <?php echo $pause; ?>,
                autoStart : <?php echo $autoStart; ?>,
                autoDirection : '<?php echo $autoDirectionArray[$autoDirection]; ?>',
                autoHover : <?php echo $autoHover; ?>,
                autoDelay : <?php echo $autoDelay; ?>,
                minSlides : <?php echo $minSlides; ?>,
                maxSlides : <?php echo $maxSlides; ?>,
                moveSlides : <?php echo $moveSlides; ?>,
                slideWidth : <?php echo $slideWidth; ?> 

        });
});
</script>
<?php  } ?>