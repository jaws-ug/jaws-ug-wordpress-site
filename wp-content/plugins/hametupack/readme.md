# HametuPack
==================================

Contributors: Takahashi_Fumiki, hametuha  
Tags: jetpack,japan,line,hatena  
Requires at least: 4.7.0  
Tested up to: 4.8.2  
Stable tag: 1.2.0  
Requires PHP: 5.5  
License: GPLv3 or later  
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

This plugin add small functionality to Jetpack.

## Description

[Jetpack](https://jetpack.me) is very useful plugin,
but some functions are not well localized.
HametuPack localize below:

### Add extra share buttons

HametuPack adds buttons to __Sharing Setting__.

* Send to [LINE](https://line.me) button.
* Add entry to [Hatena Bookmark](https://b.hatena.ne.jp) button.

### Twitter Player Card

If your post's format is audio or video, this adds twitter player card meta tags.
Also ready for [Seriously Simple Podcasting](https://www.seriouslysimplepodcasting.com) and [Yoast](https://wordpress.org/plugins/wordpress-seo/).

To customize card layout, just copy `hametupack/template-parts/player-card-xxx.php` to your theme's `template-parts` direcotry and modify it.

### Further Request

If you need more buttons, please read [our wiki](https://github.com/hametuha/hametupack/wiki) and send PR!

## Installation

1. Upload the plugin files to the `/wp-content/plugins/hametupack` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress.
1. Now your Jetpack setting little bit familiar.

## Frequently Asked Questions

### How to make request?

Please make issue at [github](https://github.com/hametuha/hametupack/issues).

## Screenshots

1. Share buttons looks like this on admin screen.
2. Official buttons also supported.

## Changelog

### 1.2.0

* Add twitter player card meta tag.

### 1.1.0

* Now you can replace Facebook App ID from WordPress.com's to yours.

### 1.0.0

* Initial release. 
