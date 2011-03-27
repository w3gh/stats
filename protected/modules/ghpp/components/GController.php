<?php
/* 
 * GController class file
 *
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 * @link http://artkost.ru
 * @copyright Copyright &copy; 2010-2012 Nikolay Kostyurin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

class GController extends Controller {

  public function  init()
  {
    parent::init();
    $schema = Yii::app()->db->getSchema();
    
    $validTables = array(
      'admins','bans','bots','servers','dotagames','dotaplayers','downloads','gameplayers','games','servers','w3mmdplayers','w3mmdvars',
    );

    if(!in_array($schema->getTableNames(), $validTables))
    {
      throw new CHttpException(500, Yii::t('Ghpp.module','One of needed tables not exists in database'));
    }

  }

}
