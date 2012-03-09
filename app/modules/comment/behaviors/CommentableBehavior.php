<?php

/**
 * Add this behavior to AR Models that are commentable
 *
 * @property CommentModule $module
 *
 * @package yiiext.modules.comment
 */
class CommentableBehavior extends CActiveRecordBehavior
{
	/**
	 * @var string name of the table defining the relation with comment and model
	 */
	//public $mapType = 'news';
	/**
	 * @var string name of the table column holding commentId in mapTable
	 */
	//public $mapCommentColumn = 'type_id';
	/**
	 * @var string name of the table column holding related Objects Id in mapTable
	 */
	//public $mapRelatedColumn = 'cid';

	public function attach($owner)
	{
		parent::attach($owner);
		// make sure comment module is loaded so views can be rendered properly
		$this->module;
	}

	/**
	 * @return CommentModule
	 */
	public function getModule()
	{
		return Yii::app()->getModule('comment');
	}

	/**
	 * returns a new comment instance that is related to the model this behavior is attached to
	 *
	 * @return Comment
	 * @throws CException
	 */
	public function getCommentInstance()
	{
		$comment = Yii::createComponent($this->module->commentModelClass);
		$types = array_flip($this->module->commentableModels);
        $type=get_class($this->owner);
		if (!isset($types[$type])) {
			throw new CException('No scope defined in CommentModule for commentable Model ' . $type);
		}
		$comment->setType($types[$type]);
		$comment->setKey($this->owner->id);
		return $comment;
	}

	/**
	 * get all related comments for the model this behavior is attached to
	 *
	 * @return Comment[]
	 * @throws CException
	 */
	public function getComments()
	{
		$comments = Yii::createComponent($this->module->commentModelClass)
					     ->findAll($this->getCommentCriteria());
		// get model type
		$type=get_class($this->owner);

		foreach($this->module->commentableModels as $scope => $model) {
			if ($type == $model) {
				$type = $scope;
				break;
			}
		}

		foreach($comments as $comment) {
			/** @var Comment $comment */
            //type like a game,player,news
			$comment->setType($type);
			$comment->setKey($this->owner->id);
		}
		return $comments;
	}

	/**
	 * count all related comments for the model this behavior is attached to
	 *
	 * @return int
	 * @throws CException
	 */
	public function getCommentCount()
	{
		return Yii::createComponent($this->module->commentModelClass)
					->count($this->getCommentCriteria());
	}

	protected function getCommentCriteria()
	{
        $commentMap=Yii::createComponent($this->module->commentMapModelClass);
        $type=get_class($this->owner);
        //FROM comments t
        //LEFT JOIN comments_map cm ON t.id = cm.cid
        //WHERE cm.type_id = $this->owner->id
        return new CDbCriteria(array(
			'join' => "LEFT OUTER JOIN " . $commentMap->tableName() . " cm ON t.id = cm.cid",
		    'condition' => "cm.type_id=:pk AND cm.type=:type",
			'params' => array(':pk'=>$this->owner->getPrimaryKey(),':type'=>$type),
            'with'=>'user',
		));
	}

	/**
	 * @todo this should be moved to a controller or widget
	 *
	 * @return CArrayDataProvider
	 */
	public function getCommentDataProvider()
	{
		return new CArrayDataProvider($this->getComments());
	}
}
