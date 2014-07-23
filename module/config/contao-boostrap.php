<?php

return array(
	'templates' => array(
		'modifiers' => array(
			'callback.replaceImageClasses' => array(
				'type'      => 'callback',
				'callback'  => array('Netzmacht\Bootstrap\Templates\Modifier', 'replaceImageClasses'),
				'templates' => array('ce_*'),
			),

			'callback.replaceTableClasses' => array(
				'type'      => 'callback',
				'callback'  => array('Netzmacht\Bootstrap\Templates\Modifier', 'replaceTableClasses'),
				'templates' => array('ce_*'),
			),
		),
	),
);
