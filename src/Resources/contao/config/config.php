<?php

declare(strict_types=1);

use ContaoBootstrap\Templates\EventListener\NavClassListener;
use ContaoBootstrap\Templates\EventListener\TemplateMappingListener;

/*
 * Hooks
 */

$GLOBALS['TL_HOOKS']['parseTemplate'][]    = [TemplateMappingListener::class, 'onParseTemplate'];
$GLOBALS['TL_HOOKS']['parseTemplate'][]    = [NavClassListener::class, 'onParseTemplate'];
$GLOBALS['TL_HOOKS']['isVisibleElement'][] = [NavClassListener::class, 'onIsVisibleElement'];
