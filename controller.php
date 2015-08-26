<?php     
/**
 * @author Damian Szymczuk
 * @link https://github.com/dszymczuk/dsSliderBx
 * @link http://dszymczuk.pl
 */
defined('C5_EXECUTE') or die(_("Access Denied."));

class dsSliderBxPackage extends Package {

	protected $pkgHandle = 'dsSliderBx';
    protected $appVersionRequired = '5.5.0';
    protected $pkgVersion = '0.9.3';
    
	public function getPackageDescription() {
    	return t("dsSliderBx - slider for your website support by Bx Slider");
    }

    public function getPackageName() {
    	return t("dsSliderBx");
    }

    public function install() {
    	$pkg = parent::install();
	    // install block
        BlockType::installBlockTypeFromPackage('ds_slider_bx', $pkg);
    }   

	public function uninstall() {
		parent::uninstall();
		
		//drop tables
		$db = Loader::db();
		$db->Execute('DROP TABLE IF EXISTS `dsSliderBx`');
		$db->Execute('DROP TABLE IF EXISTS `dsSliderBxItems`');

	} 
	
}
?>
