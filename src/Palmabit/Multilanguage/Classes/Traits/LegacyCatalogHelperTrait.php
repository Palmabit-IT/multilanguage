<?php  namespace Palmabit\Multilanguage\Classes\Traits; 

use Session;
use Config;

trait LegacyCatalogHelperTrait {
  /**
   * Variable name to save in session for admin panel handling
   * @var String
   */
  protected $session_var_admin;

  /**
   * Obtain the current admin language:default if not set
   *
   * @return String
   */
  public function get_admin()
  {
    return Session::get($this->session_var_admin, Config::get("multilanguage::base.anonymous_default") );
  }

  /**
   * {@inheritdoc}
   */
  public function get_descrizione_admin()
  {
    $prefix = $this->get_admin();
    return Config::get('multilanguage::base.languages.'.$prefix);
  }

  /**
   * Sets the current admin language
   *
   * @param String $lingua
   * @return mixed
   */
  public function set_admin($lang)
  {
    Session::set($this->session_var_admin, $lang);
  }

  public function get_lista()
  {
    return $this->getList();
  }
} 