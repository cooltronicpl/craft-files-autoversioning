# Static Files Autoversioning plugin for Craft CMS 3.x

![Icon](resources/refresh.png)

A really basic Twig extension for CraftCMS that helps you cache-bust your assets.

## Background

To force the browser to download the new asset file after a update, the plugin allows you to add a Twig function, which adds the build number or the filemtime to the filename.

## Requirements

 * Craft CMS >= 3.0.0

## Installation
### Project

Open your terminal and go to your Craft project:

``` shell
cd /path/to/project
composer require cooltronicpl/craft-files-autoversioning
```

In the control panel, go to Settings → Plugins and click the “install” button for *Static Files Autoversioning*.

### Assign number via input file
The build number which gets added to the asset URL is read from a file called `build.txt` which must exist in your root project folder )with config, templates etc.).
Use for example something like this in your deployment script (Example is for CodeShip):

``` shell
echo -n "${CI_BUILD_NUMBER}" > build.txt
```

If the file doesn't exists, the filemtime of the asset is used.

## Usage

Use the new Twig function ```version()``` in your template. For example in pug:

``` twig
<link rel="stylesheet" href="{{ version('/css/styles.css')}}">
``` 

will result this:

``` html
<link rel="stylesheet" href="/css/styles.css?v=12345678">
```

## Advanced usage
If you want have a link path use the function:
  <link rel="stylesheet" href="{{alias('@web')}}{{version('/css/styles.css')}}">
will result this:
<link rel="stylesheet" href="http/s://server/@web/plugins/splide/css/splide.min.css">

## Information about paths

The plugin serch files to version in @web directory by default, and build.txt in root path.

With ❤ by [CoolTRONIC.pl sp. z o.o.](https://cooltronic.pl) by [Pawel Potacki](https://potacki.com)

## License

The MIT License (MIT)

Copyright (c) 2022 CoolTRONIC.pl sp. z o.o. by Pawel Potacki

More about CoolTRONIC.pl sp. z o.o. Interactive Agency https://cooltronic.pl/

More about main developer Pawel Potacki https://potacki.com/

CoolTRONIC.pl sp. z o.o., hereby disclaims all copyright interest in the program “Static Files Autoversioning plugin” written by Pawel Potacki.

LICENSE.md file contains full License notices.