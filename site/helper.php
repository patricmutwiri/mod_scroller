<?php
/**
 *
 * @package    Joomla
 * @subpackage Modules
 * @license        GNU/GPL, see LICENSE.php
 * mod_scroller is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModScrollerHelper
{
	/**
	 * Retrieves the articles
	 *
	 * @param   array  $params An object containing the module parameters
	 *
	 * @access public
	 */
	public static function getArticles($params)
	{
		$db      = JFactory::getDbo();
		$app     = JFactory::getApplication();
		$user    = JFactory::getUser();
		$params = $app->getParams();
		$catid = $params->get('catid');
		JLoader::import('joomla.application.component.model');
		JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');
		$model = JModelLegacy::getInstance('Articles', 'ContentModel');
		$model->getState();
		$model->setState('list.limit', 10);
		$model->setState('filter.category_id',$catid);
		$articles = $model->getItems();
		$html = '';
		foreach ($articles as $key => $value) {
			$link = JRoute::_('index.php?option=com_content&view=article&id='.$value->id.'&Itemid=576');
			$html .= '<a>>&nbsp;</a><a class="scrolltext" href="'.$link.'">'.$value->title.'</a><a>&nbsp;</a>';
		}
		
		echo '<div class="col-xs-12 scrolldiv"><div class="col-xs-2 redd">News</div><div class="mmarquee col-xs-10"><marquee>'.$html.'</marquee></div></div>';
	?>
	<script type="text/javascript">
		jQuery(function() {
		    jQuery('a.scrolltext').mouseover(function() {
		        jQuery('marquee').attr('scrollamount',0);
		    }).mouseout(function() {
		         jQuery('marquee').attr('scrollamount',5);
		    });
		});
	</script>
	<style>
		.scrolldiv {
			padding:0 
		}
		.mmarquee { 
		  padding: 10px 5px; 
		}
		.redd {
			text-align: center;
			color:white;
			padding:10px 5px;
			background:red;
			
		}
		#camera_wrap_162 {
		   margin: 40px 0px;
		}
	</style>
	<?php
	}
}
