RSortDropDownListWidget
===============
RSortDropDownListWidget отображает dropDownList для сортировки по выбранным полям

Using:
-----
~~~
[php]
$this->widget('ext.RSortDropDownListWidget.RSortDropDownListWidget', array(
	'sort'=>$sort,
	'labels'=>array(
		'product_price'=>array(
			'asc'=>'Price up',
			'deck'=>'Price down',
		),
		'product_title'=>array(
			'asc'=>'Alpabet',
			'deck'=>'Alpabet deck',
		),
	),
));
~~~