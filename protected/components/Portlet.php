<?php

/**
 * Portlet class file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://www.w3gh.ru/
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * Component for Ranking DotA Players using avaible rank methods
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @version $Id:$
 * @package application.components
 */
class Portlet extends CPortlet {
  
	/**
	 * Renders the decoration for the portlet.
	 * The default implementation will render the title if it is set.
	 */
	protected function renderDecoration()
	{
		if($this->title!==null)
		{
			echo "<div class=\"{$this->decorationCssClass}\">\n";
			echo "<div class=\"{$this->titleCssClass}\">".Yii::t("portlets", $this->title)."</div>\n";
			echo "</div>\n";
		}
	}
}
?>
