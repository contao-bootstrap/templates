Bootstrap 4 Contao Templates Component
======================================

[![Version](http://img.shields.io/packagist/v/contao-bootstrap/templates.svg?style=for-the-badge&label=Latest)](http://packagist.org/packages/contao-bootstrap/templates)
[![GitHub issues](https://img.shields.io/github/issues/contao-bootstrap/templates.svg?style=for-the-badge&logo=github)](https://github.com/contao-bootstrap/templates/issues)
[![License](http://img.shields.io/packagist/l/contao-bootstrap/templates.svg?style=for-the-badge&label=License)](http://packagist.org/packages/contao-bootstrap/templates)
[![Build Status](https://img.shields.io/github/workflow/status/contao-bootstrap/templates/Code%20Quality%20Diagnostics?logo=githubactions&logoColor=%23fff&style=for-the-badge)](https://github.com/contao-bootstrap/templates/actions)
[![Downloads](http://img.shields.io/packagist/dt/contao-bootstrap/templates.svg?style=for-the-badge&label=Downloads)](http://packagist.org/packages/contao-bootstrap/templates)

Features
--------

This extension provides several Bootstrap 4 based templates Contao CMS.

It's possible to use this extension in an installation where the default templates are required. To avoid wrong
templates being loaded theres a feature called *template automapping*. Each bootstrap template has a different name
(usually <em>_bs</em>) prefix than the default one. On runtime the template name get changed so you don't have to select
the modified templates everywhere.

The automapping is only active if a page layout has the type *bootstrap* and you did not disable the *automapping* in
the theme settings.

Following templates are provided:

** With configurable automapping **
 - `com_bs_media` comment template based on the Bootstraps media component (**Note:** It's using gravatar.com as a third party service).
 - `member_default_bs` for the member form using bootstrap form layout.
 - `member_grouped_bs` for the member form using bootstrap form layout.
 - `mod_breadcrumb_bs` for the breadcrumb module.
 - `mod_comment_form_bs` for a bootstrap based comment form.
 - `mod_login_bs` for the login form module.
 - `mod_search_bs` for the search module.

** Always mapped **
 - `pagination_bs` for the paginations (always mapped, even if automapping is disabled).

** Not mapped **
 - `gallery_bs_carousel` for a gallery using the carousel.
 - `gallery_bs_grid` for a grid based gallery.
 - `nav_default` as navigation templates.
 - `rss_bs_list_group` rss feed rendered as list group.


Changelog
---------

See [changelog](CHANGELOG.md)

Requirements
------------

 - PHP 7.1
 - Contao ~4.4

Install
-------

### Managed edition

When using the managed edition it's pretty simple to install the package. Just search for the package in the
Contao Manager and install it. Alternatively you can use the CLI.

```bash
# Using the contao manager
$ php contao-manager.phar.php composer require contao-bootstrap/templates~2.0

# Using composer directly
$ php composer.phar require contao-bootstrap/templates~2.0
```
