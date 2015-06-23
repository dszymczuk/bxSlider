<?php     
/**
 * @author Damian Szymczuk
 * @link https://github.com/dszymczuk/bxSlider
 * @link http://dszymczuk.pl
 */
defined('C5_EXECUTE') or die(_("Access Denied."));

class bxSliderPackage extends Package {

	protected $pkgHandle = 'bxSlider';
    protected $appVersionRequired = '5.5.0';
    protected $pkgVersion = '0.1.0';
    
	public function getPackageDescription() {
    	return t("Bx Slider - slider for your website");
    }

    public function getPackageName() {
    	return t("Bx Slider");
    }

    public function install() {
    	$pkg = parent::install();
	    // install block
        BlockType::installBlockTypeFromPackage('bx_slider', $pkg);
    }   

	public function uninstall() {
//		parent::uninstall();
		
		//drop tables
//		$db = Loader::db();
//		$db->Execute('DROP TABLE IF EXISTS `btBxSlider`');
//		$db->Execute('DROP TABLE IF EXISTS `btBxSliderItems`');

	} 
	
}
?>
