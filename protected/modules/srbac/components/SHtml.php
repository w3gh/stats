<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of SHtml
 *
 * @author lordovol
 */
class SHtml extends CHtml {
  
  
  /**
   * Generates a button.
   * @param string the button label
   * @param array additional HTML attributes. Besides normal HTML attributes, a few special
   * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
   * @return string the generated button tag
   * @see clientChange
   */
  public static function button($label='button',$htmlOptions=array()) {
    if(!isset($htmlOptions['name']))
      $htmlOptions['name']=self::ID_PREFIX.self::$count++;
    if(!isset($htmlOptions['type']))
      $htmlOptions['type']='button';
    if(!isset($htmlOptions['value']))
      $htmlOptions['value']=$label;
    self::clientChange('click',$htmlOptions ,false);
    return self::tag('input',$htmlOptions);
  }

 
  /**
   * Generates a link that can initiate AJAX requests.
   * @param string the link body (it will NOT be HTML-encoded.)
   * @param mixed the URL for the AJAX request. If empty, it is assumed to be the current URL. See {@link normalizeUrl} for more details.
   * @param array AJAX options (see {@link ajax})
   * @param array additional HTML attributes. Besides normal HTML attributes, a few special
   * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
   * @return string the generated link
   * @see normalizeUrl
   * @see ajax
   */
  public static function ajaxLink($text,$url,$ajaxOptions=array(),$htmlOptions=array()) {
    if(!isset($htmlOptions['href']))
      $htmlOptions['href']='#';
    $ajaxOptions['url']=$url;
    $htmlOptions['ajax']=$ajaxOptions;
    self::clientChange('click',$htmlOptions,false);
    return self::tag('a',$htmlOptions,$text);
  }

  /**
   * Generates a push button that can initiate AJAX requests.
   * @param string the button label
   * @param mixed the URL for the AJAX request. If empty, it is assumed to be the current URL. See {@link normalizeUrl} for more details.
   * @param array AJAX options (see {@link ajax})
   * @param array additional HTML attributes. Besides normal HTML attributes, a few special
   * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
   * @return string the generated button
   */
  public static function ajaxButton($label,$url,$ajaxOptions=array(),$htmlOptions=array()) {
    $ajaxOptions['url']=$url;
    $htmlOptions['ajax']=$ajaxOptions;
    return self::button($label,$htmlOptions,false);
  }

}
?>
