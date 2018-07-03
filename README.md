Contao-Bootstrap Templates
==========================

[![Build Status](http://img.shields.io/travis/contao-bootstrap/templates/master.svg?style=flat-square)](https://travis-ci.org/contao-bootstrap/templates)
[![Version](http://img.shields.io/packagist/v/contao-bootstrap/templates.svg?style=flat-square)](http://packagist.com/packages/contao-bootstrap/templates)
[![License](http://img.shields.io/packagist/l/contao-bootstrap/templates.svg?style=flat-square)](http://packagist.com/packages/contao-bootstrap/templates)
[![Downloads](http://img.shields.io/packagist/dt/contao-bootstrap/templates.svg?style=flat-square)](http://packagist.com/packages/contao-bootstrap/templates)
[![Contao Community Alliance coding standard](http://img.shields.io/badge/cca-coding_standard-red.svg?style=flat-square)](https://github.com/contao-community-alliance/coding-standard)

This extension provides Bootstrap integration into Contao. 

Contao-Bootstrap is a modular integration. The templates module provides several modified or additional templates.

It's possible to use this extension in an installation where the default templates are required. To avoid wrong templates
being loaded theres a feature called *template automapping*. Each bootstrap template has a different name (usually <em>_bs</em>)
prefix than the default one. On runtime the template name get changed so you don't have to select the modified templates
everywhere.

The automapping is only active if a page layout has the type *bootstrap* and you did not disable the automapping in the
theme settings.

Following templates are provided:

 - `com_bs_media` comment template based on the Bootstraps media component (**Note:** It's using gravatar.com as a third party service).
 - `gallery_bs_carousel` for a gallery using the carousel.
 - `gallery_bs_grid` for a grid based gallery.
 - `member_default_bs` for the member form using bootstrap form layout.
 - `member_grouped_bs` for the member form using bootstrap form layout.
 - `mod_breadcrumb_bs` for the breadcrumb module.
 - `mod_comment_form_bs` for a bootstrap based comment form.
 - `mod_login_bs` for the login form module.
 - `mod_search_bs` for the search module.
 - `pagination_bs` for the paginations (always mapped, even if automapping is disabled).
