RSortDropDownListWidget
===============
RSortDropDownListWidget display a dropDownList with sort link for CSort class

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