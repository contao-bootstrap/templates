<?php

/**
 * Contao Bootstrap templates.
 *
 * @package    contao-bootstrap
 * @subpackage Templates
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2018 netzmacht David Molineus. All rights reserved.
 * @license    https://github.com/contao-bootstrap/templates/blob/master/LICENSE LGPL 3.0-or-later
 * @filesource
 */

declare(strict_types=1);

use ContaoBootstrap\Templates\EventListener\NavClassListener;
use ContaoBootstrap\Templates\EventListener\TemplateMappingListener;

/*
 * Hooks
 */

$GLOBALS['TL_HOOKS']['parseTemplate'][]    = [TemplateMappingListener::class, 'onParseTemplate'];
$GLOBALS['TL_HOOKS']['parseTemplate'][]    = [NavClassListener::class, 'onParseTemplate'];
$GLOBALS['TL_HOOKS']['isVisibleElement'][] = [NavClassListener::class, 'onIsVisibleElement'];
