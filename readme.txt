=== About ===
name: WMS Layer
website: http://wpkenya.com
description: Modify the deafult map to WMS base layer.
version: 0.1
requires: 2.0
tested up to: 2.2
author: Seth kigen
author website: http://twitter.com/kigen

== Description ==
A simple plugin for Ushahidi platform that allows adding OGC WMS Layers as {Base or Overlay} 

== Installation ==
1. Copy the entire /wms/ directory into your /plugins/ directory.
2. Edit Map helper application/helper/map.php line 100 just above  return $js add this line of code  Event::run('ushahidi_filter.map_base_layers_code', $js); 
3. Edit plugin config to define WMS (base layers & Overlays) you would like to show up on the map.
4. Activate the plugin.
== Changelog ==