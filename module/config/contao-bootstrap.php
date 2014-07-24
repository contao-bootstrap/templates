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

			'replace.paginationActiveClass' => array
			(
				'type'        => 'replace',
				'key'         => 'items',
				'search'      => '<li><span class="current">',
				'replace'     => '<li class="active"><span>',
				'templates'   => array('pagination'),
			),
		),
	),
);
