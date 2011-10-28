<?php

/**
 * RSortDropDownListWidget class file.
 *
 * @author Slava Rudnev <slava.rudnev@gmail.com>
 * @link https://github.com/RSol/RSortDropDownListWidget
 */

/**
 * RSortDropDownListWidget display a dropDownList with sort link for CSort class
 *
 * Using:
 *
 * <pre>
 *
 * <?php $this->widget('ext.RSortDropDownListWidget.RSortDropDownListWidget', array(
 *     'sort'=>$sort,
 *     'labels'=>array(
 *         'product_price'=>array(
 *             'asc'=>'Price up',
 *             'deck'=>'Price down',
 *         ),
 *         'product_title'=>array(
 *             'asc'=>'Alpabet',
 *             'deck'=>'Alphabet desc',
 *         ),
 *     ),
 * ));?>
 * </pre>
 *
 * Additional 
 * 
 * @author Slava Rudnev <slava.rudnev@gmail.com>
 * @version 0.1
 */

class RSortDropDownListWidget extends CWidget
{
	/**
	 * @var CSort
	 */
	public $sort;
	
	/**
	 * @var array labels for dropDownList items
	 * <pre>
	 * 'labels'=>array(
	 *     'product_price'=>array(
	 *         'asc'=>'Price up',
	 *         'deck'=>'Price down',
	 *     ),
	 *     'product_title'=>array(
	 *         'asc'=>'Alpabet',
	 *         'deck'=>'Alphabet desc',
	 *     ),
	 * ),
	 * </pre>
	 */
	public $labels = array();
	
	static $counter;

	public function init()
	{
		if(!($this->sort instanceof CSort))
		{
			throw new CException('Attribute sort must be instance of CSort');
		}
		
		if(!$this->sort->modelClass)
		{
			throw new CException('Model class of CSort must be set');
		}
		
		self::$counter = self::$counter ? (self::$counter+1) : 1;
	}

	public function run()
	{
		$items = array();
		$selected = '';
		foreach($this->sort->attributes as $attribute)
		{
			foreach(array(0,1) as $direction)
			{
				if(isset($this->labels[$attribute], $this->labels[$attribute][$direction ? 'deck':'asc']))
				{
					$id = "{$attribute}_sort_{$direction}";
					$items[] = array(
						'id'=>$id,
						'link'=>$this->sort->createUrl($this->getController(), array($attribute=>$direction)),
						'title'=>$this->labels[$attribute][$direction ? 'deck':'asc'],
					);
					
					if(!is_null($this->sort->getDirection($attribute)) && $this->sort->getDirection($attribute)==$direction)
					{
						$selected = $id;
					}
				}
			}
		}
		
		$id = __CLASS__ . self::$counter;
		
		echo CHtml::dropDownList($id, $selected, CHtml::listData($items, 'id', 'title'), array(
			'id'=>$id,
			'empty'=>'',
		));
		
		$this->registerScript($id, $items);
	}
	
	protected function registerScript($id, $items)
	{
		$options = CHtml::listData($items, 'id', 'link');
		$js = 'var '.$id.'_option = '.  CJavaScript::encode($options);
		
		Y::script()->registerScript($id.'_vars', $js, CClientScript::POS_HEAD);
		
		$js = '$("#'.$id.'").bind("change",function(){
			window.location = '.$id.'_option[$(this).val()];
//			alert('.$id.'_option[$(this).val()]);
		})';
		Y::script()->registerScript($id.'_go', $js);
	}
}

