<?php   
/**
 * @author Damian Szymczuk
 * @link https://github.com/dszymczuk/dsSliderBx
 * @link http://dszymczuk.pl
 */
defined('C5_EXECUTE') or die("Access Denied.");
class dsSliderBxBlockController extends BlockController {
	
	protected $btTable = 'dsSliderBx';
	protected $btInterfaceWidth = "850";
	protected $btInterfaceHeight = "600";
	
	// Allow full caching
	// DEVNOTE: The cache may need to be cleared or the block resaved if
	// file titles/descriptions are changed.
	/*protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;*/
	
    /*
    General
    */
    public $default_mode = 0; //Type of transition between slides
    public $default_modeArray  =array('horizontal', 'vertical', 'fade');
    public $default_speed = 500; //Slide transition duration (in ms)
    public $default_slideMargin = 0; //Margin between each slide
    public $default_startSlide = 0; //Starting slide index (zero-based)
    public $default_randomStart = 0; // false ; Start slider on a random slide
    public $default_infiniteLoop = 1; // true; If true, clicking "Next" while on the last slide will transition to the first slide and vice-versa
    public $default_hideControlOnEnd = 0; //false;  If true, "Next" control will be hidden on last slide and vice-versa ; Note: Only used when infiniteLoop: false
    /*
	The type of "easing" to use during transitions. If using CSS transitions, include a value for the transition-timing-function property. If not using CSS transitions, you may include plugins/jquery.easing.1.3.js for many options.
	See http://gsgd.co.uk/sandbox/jquery/easing/ for more info.
    */
    public $default_easing = 0; //
    public $default_easingArray = array('null','linear', 'ease', 'ease-in', 'ease-out', 'ease-in-out', 'cubic-bezier(n,n,n,n)','swing', 'linear');

	public $default_captions = 0; // false ; Include image captions. Captions are derived from the image's title attribute

    public $default_adaptiveHeight = 0; // false; Dynamically adjust slider height based on each slide's height
    public $default_adaptiveHeightSpeed = 500; //Slide height transition duration (in ms). Note: only used if adaptiveHeight: true

    public $default_responsive = 1; // true ; Enable or disable auto resize of the slider. Useful if you need to use fixed width sliders.
    /*
	If 'all', preloads all images before starting the slider. If 'visible', preloads only images in the initially visible slides before starting the slider (tip: use 'visible' if all slides are identical dimensions)
    */
    public $default_preloadImages = 1; //
    public $default_preloadImagesArray = array('all', 'visible'); //

    public $default_touchEnabled = 1; // true; If true, slider will allow touch swipe transitions
    public $default_swipeThreshold = 50; //Amount of pixels a touch swipe needs to exceed in order to execute a slide transition. Note: only used if touchEnabled: true
    public $default_oneToOneTouch = 1; // true ;  If true, non-fade slides follow the finger as it swipes

	/*
    Pager
    */
	public $default_pager = 1; //true ; If true, a pager will be added
    public $default_pagerType = 0; // If 'full', a pager link will be generated for each slide. If 'short', a x / y pager will be used (ex. 1 / 5)
    public $default_pagerTypeArray = array('full', 'short'); //
    public $default_pagerShortSeparator = "/"; // If pagerType: 'short', pager will use this value as the separating character

    /*
    Controls
    */
	public $default_controls = 1; // true ; If true, "Next" / "Prev" controls will be added
    public $default_nextText = 'Next'; //Text to be used for the "Next" control
    public $default_prevText = 'Prev'; //Text to be used for the "Prev" control
    public $default_autoControls = 0; // false ; If true, "Start" / "Stop" controls will be added
    public $default_startText = "Start"; // Text to be used for the "Start" control
    public $default_stopText = "Stop"; // Text to be used for the "Stop" control
    public $default_autoControlsCombine = 0; // false ; When slideshow is playing only "Stop" control is displayed and vice-versa

    /*
    Auto
    */
	public $default_auto = 0; // false ; Slides will automatically transition
	public $default_stopAutoOnClick = 0; // false ; Auto will stop on interaction with controls
    public $default_pause = 4000; // The amount of time (in ms) between each auto transition
    public $default_autoStart = 1; // true ; Auto show starts playing on load. If false, slideshow will start when the "Start" control is clicked
    public $default_autoDirection = 0; // The direction of auto show slide transitions
    public $default_autoDirectionArray = array('next', 'prev'); //
    public $default_autoHover = 0; // false ; Auto show will pause when mouse hovers over slider
    public $default_autoDelay = 0; // Time (in ms) auto show should wait before starting

    /*
    Carousel
    */
    public $default_minSlides = 1; //The minimum number of slides to be shown. Slides will be sized down if carousel becomes smaller than the original size.
    public $default_maxSlides = 1; //The maximum number of slides to be shown. Slides will be sized up if carousel becomes larger than the original size.
    public $default_moveSlides = 0; //The number of slides to move on transition. This value must be >= minSlides, and <= maxSlides. If zero (default), the number of fully-visible slides will be used.
    public $default_slideWidth = 0; //The width of each slide. This setting is required for all horizontal carousels!


	public function getBlockTypeDescription() {
		return t("dsSliderBx");
	}
	
	public function getBlockTypeName() {
		return t("dsSliderBx");
	}
		
	public function getJavaScriptStrings() {
		return array(
			'choose-min-2' => t('Please choose at least two images.'),
			'no-image' => t('No images selected yet.')
		);
	}
	
	function __construct($obj = null) {		
		parent::__construct($obj);
	    
	
	}	

	function view() {
		$this->set('pageID', $this->pageID);
		$this->setVariables();
		$this->getItems();
	}

	function add() {
		$this->includeUIElements();
		$this->setVariables();
		$this->getItems();
		$this->set('pageID', $this->pageID);
		$this->set('bID', $this->bID);		
		
	}
	
	function edit() {
		$this->includeUIElements();
		$this->setVariables();
		$this->getItems();
		$this->set('pageID', $this->pageID);
		$this->set('bID', $this->bID);		
	}
	
	function delete(){
		$db = Loader::db();
		$item_data = array( 
						  (int)$this->bID
						  );
		$db->query("DELETE FROM `dsSliderBxItems` WHERE bID=? ", $item_data);
		parent::delete();
	}
	
	function duplicate($nbID) {
       parent::duplicate($nbID);
       $this->getItems();
       $db = Loader::db();
       foreach($this->items as $item) {
         $db->Execute('INSERT INTO `dsSliderBxItems` (`bID`, `fID`, `itemTitle`, `itemDesc`, `itemUrl`, `position`) VALUES
                  (?,?,?,?,?,?)', 
            array($nbID, $item['fID'], $item['itemTitle'], $item['itemDesc'], $item['itemURL'], $item['position'])
         );      
       }
    }	
	
	function save($data) {
		$data['mode'] = (int)$data['mode'];
		$data['speed'] = (int)$data['speed'];
		$data['slideMargin'] = (int)$data['slideMargin'];
		$data['startSlide'] = (int)$data['startSlide'];
		$data['randomStart'] = $data['randomStart'] ? 1 : 0;
		$data['infiniteLoop'] = $data['infiniteLoop'] ? 1 : 0;
		$data['hideControlOnEnd'] = $data['hideControlOnEnd'] ? 1 : 0;
		$data['easing'] = (int)$data['easing'];
		$data['captions'] = (int)$data['captions'] ? 1 : 0;
		$data['adaptiveHeight'] = (int)$data['adaptiveHeight'] ? 1 : 0;
		$data['adaptiveHeightSpeed'] = $data['adaptiveHeightSpeed'];
		$data['responsive'] = (int)$data['responsive'] ? 1 : 0;
		$data['preloadImages'] = (int)$data['preloadImages'];
		$data['touchEnabled'] = $data['touchEnabled'] ? 1 : 0;
		$data['swipeThreshold'] = (int)$data['swipeThreshold'];
		$data['oneToOneTouch'] = $data['oneToOneTouch'] ? 1 : 0;
		$data['pager'] = $data['pager'] ? 1 : 0;
		$data['pagerType'] = $data['pagerType'];
		$data['pagerShortSeparator'] = $data['pagerShortSeparator'];
		$data['controls'] = $data['controls'] ? 1 : 0;
		$data['nextText'] = (string)substr(trim($data['nextText']), 0, 48);
		$data['prevText'] = (string)substr(trim($data['prevText']), 0, 48);
		$data['autoControls'] = $data['autoControls'] ? 1 : 0;
		$data['startText'] = (string)substr(trim($data['startText']), 0, 48);
		$data['stopText'] = (string)substr(trim($data['stopText']), 0, 48);
		$data['autoControlsCombine'] = $data['autoControlsCombine'] ? 1 : 0;
		$data['auto'] = $data['auto'] ? 1 : 0;
		$data['stopAutoOnClick'] = $data['stopAutoOnClick'] ? 1 : 0;
		$data['pause'] = (int)$data['pause'];
		$data['autoStart'] = $data['autoStart'] ? 1 : 0;
		$data['autoDirection'] = (int)$data['autoDirection'];
		$data['autoHover'] = $data['autoHover'] ? 1 : 0;
		$data['autoDelay'] = (int)$data['autoDelay'];
		$data['minSlides'] = (int)$data['minSlides'];
		$data['maxSlides'] = (int)$data['maxSlides'];
		$data['moveSlides'] = (int)$data['moveSlides'];
		$data['slideWidth'] = (int)$data['slideWidth'];

		parent::save($data);
			
		//save selected images at the child table ( dsSliderBxImg )
		$db = Loader::db();
		//delete existing images
		$item_data = array( 
						  (int)$this->bID
						  );
		$db->query("DELETE FROM `dsSliderBxItems` WHERE bID=?", $item_data);
		
		//loop through and add the images
		$pos=0;
		foreach($data['itemFIDs'] as $itemFID){ 
			if(intval($itemFID)==0 || $data['fileNames'][$pos]=='tempFilename') continue; //do not conside temp one
			//make inputs safe[in terms of length], befor insert to db
			$item_title = (string)substr(trim($data['itemTitle'][$pos]), 0, 255);
			$item_desc = (string)trim($data['itemDesc'][$pos]);
			$item_url = (string)substr(trim($data['itemUrl'][$pos]), 0, 255);
			$item_data = array( 
							  (int)$this->bID,
							  (int)$itemFID, 
							  $item_title,
							  $item_desc,
							  $item_url,
							  $pos
							  );
			$db->query("INSERT INTO `dsSliderBxItems`
					   (`bID`, `fID`, `itemTitle`, `itemDesc`, `itemUrl`, `position`) VALUES 
					   (?,?,?,?,?,?)"
					   ,$item_data
					   );
			$pos++;
		}
	}


    function validate($args) {

    $error = Loader::helper('validation/error');
    $isNotEmptyNumberMsg = t(' is empty or not number');
    $isNotEmptyNumberMoreZeroMsg = t(' is empty, not number or under zero');
    $isNotEmptyMsg = t(' is empty');

    if($this->isNotEmptyNumberMoreZero($args['speed']))
        $error->add(t('Speed').$isNotEmptyNumberMsg);

    if($this->isNotEmptyNumberMoreZero($args['slideMargin']))
        $error->add(t('Slide Margin').$isNotEmptyNumberMoreZeroMsg);

    if($this->isNotEmptyNumberMoreZero($args['startSlide']))
        $error->add(t('Start Slide').$isNotEmptyNumberMoreZeroMsg);

    if($this->isNotEmptyNumberMoreZero($args['adaptiveHeightSpeed']))
        $error->add(t('Adaptive Height Speed').$isNotEmptyNumberMoreZeroMsg);

    if($this->isNotEmptyNumberMoreZero($args['swipeThreshold']))
        $error->add(t('Swipe Threshold').$isNotEmptyNumberMsg);

    if($this->isNotEmpty($args['pagerShortSeparator']))
        $error->add(t('Pager Short Separator').$isNotEmptyMsg);

    if($this->isNotEmpty($args['nextText']))
        $error->add(t('Next Text').$isNotEmptyMsg);

    if($this->isNotEmpty($args['prevText']))
        $error->add(t('Prev Text').$isNotEmptyMsg);

    if($this->isNotEmpty($args['startText']))
        $error->add(t('Start Text').$isNotEmptyMsg);

    if($this->isNotEmpty($args['stopText']))
        $error->add(t('Stop Text').$isNotEmptyMsg);

    if($this->isNotEmptyNumberMoreZero($args['pause']))
        $error->add(t('Pause').$isNotEmptyNumberMoreZeroMsg);

    if($this->isNotEmptyNumberMoreZero($args['autoDelay']))
        $error->add(t('Auto Delay').$isNotEmptyNumberMoreZeroMsg);

    if($this->isNotEmptyNumberMoreZero($args['minSlides']))
        $error->add(t('Min Slides').$isNotEmptyNumberMoreZeroMsg);
        
    if($this->isNotEmptyNumberMoreZero($args['maxSlides']))
        $error->add(t('Max Slides').$isNotEmptyNumberMoreZeroMsg);

    if($this->isNotEmptyNumberMoreZero($args['moveSlides']))
        $error->add(t('Move Slides').$isNotEmptyNumberMoreZeroMsg);

    if($this->isNotEmptyNumberMoreZero($args['slideWidth']))
        $error->add(t('Slide Width').$isNotEmptyNumberMoreZeroMsg);

        return $error;
    }

	private function getItems(){
		if(intval($this->bID) == 0) {
			$this->items = array();
			$this->set('items', $this->items);
			return;
		}
		$sql = sprintf("SELECT * FROM dsSliderBxItems WHERE bID=%d ORDER BY position", $this->bID);
		$db = Loader::db();
		$this->items = $db->getAll($sql); 
		
        //prepare images:
        foreach ($this->items as $key => $value) {
            //image:
            $f = File::getByID($value['fID']);
            $this->items[$key]['itemImageSrc'] = $f->getRelativePath();
            $this->items[$key]['itemImageAlt'] = (strlen($value['itemTitle'])>0)?$value['itemTitle']:$f->getTitle(); //image alt tag
            $this->items[$key]['itemImageTitle'] = (strlen($value['itemTitle'])>0)?$value['itemTitle']:$f->getDescription(); //image title tag
            //if you always want file title/desc attribute as image alt/title attribute, uncomment this two line 
            //$this->items[$key]['itemImageAlt'] = $f->getTitle(); //image alt tag
            //$this->items[$key]['itemImageTitle'] = $f->getDescription(); //image title tag
        }
		
		$this->set('items', $this->items);
		return;
	}
	private function setVariables(){
		/*
		Arrays
		*/

		$this->set('modeArray', $this->default_modeArray);
		$this->set('easingArray', $this->default_easingArray);
		$this->set('preloadImagesArray', $this->default_preloadImagesArray);
		$this->set('pagerTypeArray', $this->default_pagerTypeArray);
		$this->set('autoDirectionArray', $this->default_autoDirectionArray);

		/*
		General
		*/
		$this->set('mode', isset($this->mode)?$this->mode:$this->default_mode);
		$this->set('speed', isset($this->speed)?$this->speed:$this->default_speed);
		$this->set('slideMargin', isset($this->slideMargin)?$this->slideMargin:$this->default_slideMargin);
		$this->set('startSlide', isset($this->startSlide)?$this->startSlide:$this->default_startSlide);
		$this->set('randomStart', isset($this->randomStart)?$this->randomStart:$this->default_randomStart);
		$this->set('infiniteLoop', isset($this->infiniteLoop)?$this->infiniteLoop:$this->default_infiniteLoop);
		$this->set('hideControlOnEnd', isset($this->hideControlOnEnd)?$this->hideControlOnEnd:$this->default_hideControlOnEnd);
		$this->set('easing', isset($this->easing)?$this->easing:$this->default_easing);
		$this->set('captions', isset($this->captions)?$this->captions:$this->default_captions);
		$this->set('easingArray', isset($this->easingArray)?$this->easingArray:$this->default_easingArray);
		$this->set('adaptiveHeight', isset($this->adaptiveHeight)?$this->adaptiveHeight:$this->default_adaptiveHeight);
		$this->set('adaptiveHeightSpeed', isset($this->adaptiveHeightSpeed)?$this->adaptiveHeightSpeed:$this->default_adaptiveHeightSpeed);
		$this->set('responsive', isset($this->responsive)?$this->responsive:$this->default_responsive);
		$this->set('preloadImages', isset($this->preloadImages)?$this->preloadImages:$this->default_preloadImages);
		$this->set('touchEnabled', isset($this->touchEnabled)?$this->touchEnabled:$this->default_touchEnabled);
		$this->set('swipeThreshold', isset($this->swipeThreshold)?$this->swipeThreshold:$this->default_swipeThreshold);
		$this->set('oneToOneTouch', isset($this->oneToOneTouch)?$this->oneToOneTouch:$this->default_oneToOneTouch);

		/*
		Pager
		*/
		$this->set('pager', isset($this->pager)?$this->pager:$this->default_pager);
		$this->set('pagerType', isset($this->pagerType)?$this->pagerType:$this->default_pagerType);
		$this->set('pagerShortSeparator', isset($this->pagerShortSeparator)?$this->pagerShortSeparator:$this->default_pagerShortSeparator);

		/*
		Controls
		*/
		$this->set('controls', isset($this->controls)?$this->controls:$this->default_controls);
		$this->set('nextText', isset($this->nextText)?$this->nextText:$this->default_nextText);
		$this->set('prevText', isset($this->prevText)?$this->prevText:$this->default_prevText);
		$this->set('autoControls', isset($this->autoControls)?$this->autoControls:$this->default_autoControls);
		$this->set('startText', isset($this->startText)?$this->startText:$this->default_startText);
		$this->set('stopText', isset($this->stopText)?$this->stopText:$this->default_stopText);
		$this->set('autoControlsCombine', isset($this->autoControlsCombine)?$this->autoControlsCombine:$this->default_autoControlsCombine);

		/*
		Auto
		*/
		$this->set('auto', isset($this->auto)?$this->auto:$this->default_auto);
		$this->set('stopAutoOnClick', isset($this->stopAutoOnClick)?$this->stopAutoOnClick:$this->default_stopAutoOnClick);
		$this->set('pause', isset($this->pause)?$this->pause:$this->default_pause);
		$this->set('autoStart', isset($this->autoStart)?$this->autoStart:$this->default_autoStart);
		$this->set('autoDirection', isset($this->autoDirection)?$this->autoDirection:$this->default_autoDirection);
		$this->set('autoHover', isset($this->autoHover)?$this->autoHover:$this->default_autoHover);
		$this->set('autoDelay', isset($this->autoDelay)?$this->autoDelay:$this->default_autoDelay);

		/*
		Carousel
		*/
		$this->set('minSlides', isset($this->minSlides)?$this->minSlides:$this->default_minSlides);
		$this->set('maxSlides', isset($this->maxSlides)?$this->maxSlides:$this->default_maxSlides);
		$this->set('moveSlides', isset($this->moveSlides)?$this->moveSlides:$this->default_moveSlides);
		$this->set('slideWidth', isset($this->slideWidth)?$this->slideWidth:$this->default_slideWidth);

	}
	/**
	 * Loads required assets and variables when in edit or add mode.
	 * Called by edit() and add()
	 */
	private function includeUIElements() {

	}


    private function isNotEmptyNumber($value){
        $trimedValue = trim($value);
        if($trimedValue == '' || !is_numeric($trimedValue))
            return true;
        return false;
    }

    private function isNotEmptyNumberMoreZero($value){
        $trimedValue = trim($value);
        if($this->isNotEmptyNumber($trimedValue) || $trimedValue < 0)
            return true;
        return false;
    }

    private function isNotEmpty($value)
    {
        $trimedValue = trim($value);
        if(empty($trimedValue))
            return true;
        return false;
    }

}

?>
