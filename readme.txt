=== About ===

name: WMS Layers

website: http://twitter.com/kigen

description: A simple plugin for Ushahidi platform that allows adding OGC WMS Layers as {Base or Overlay} 

version: 0.4

requires: 2.5

tested up to: 2.5

author: Seth kigen

author website: http://twitter.com/kigen

== Description ==

A simple plugin for Ushahidi platform that allows adding OGC WMS Layers as {Base or Overlay} 

== Installation ==

1. Copy the entire /wms/ directory into your /plugins/ directory.
2. Activate the plugin.
3. Click on plugin settings to add layers.

== Configuration ==

1. Select the [LAYERS] tab 
2. Add all wms based layers that you will need to show on the map
    - Add each layer to it's respective section (base/overlay)
3. Once done with adding the layers navigate back to the [GENERAL] tab
4. Select the type of map setup you will need your maps to appear
    - There are 3 choices
    1. FULL WMS -> Allows for full wms support (Both base & overlays will be WMS based)
    2. OVERLAY ONLY -> Allows you to add wms based overlays only. The base layer 
                       remains to be the default map as configured Ushahidi map settings
    3. OFF -> Turns off the plugin, allows you to turn off the plugin without having to un-install it. 

== Changelog ==

0.4 
- Added mixed layer support e.g (Google Maps and WMS Layers)
- Added configuration interface
- Moved layer configuration to database
- Fixed minor bugs
- Support for Ushahidi 2.4, 2.3 dropped.

0.3
- Added 2.5 support

0.2
- Added 2.3 and 2.4 support. 
- Fixed projection issues

