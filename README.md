# Static Files Autoversioning plugin for Craft CMS 3.x or 4.x

![Icon](resources/black.png#gh-light-mode-only)
![Icon](resources/white.png#gh-dark-mode-only)

A really basic Twig extension development plugin for CraftCMS that helps you cache-bust your assets.

## Background

To force the browser to download the new asset file after a update, the plugin allows you to add a Twig function, which adds the build number or the filemtime to the filename.

## Requirements

 * Craft CMS >= 3.0.0 in 1.x branch
 * Craft CMS >= 4.0.0 in 2.x branch

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

## Advanced example
When you have caching policy for many files, like videos, PDFs any other you can use this plugin to pass the actual file, after update link of shortand in example:
```
<a href="{{alias('@web')}}{{version('/uploads/main-video.mp4')}}">LINK </a>
```

This plugin generate file with timestamp, when file is changed the timestamp is changing and new version is downloaded:

```
<a href="http://some-domain.com/uploads/main-video.mp4?v=1667385206">LINK </a>
```

Also you can use this plugin with [PDF Generator](https://github.com/cooltronicpl/Craft-document-helpers/) when your hosting or server is caching PDF files.

```
<a href="{{alias('@web')}}{{version("/" ~ craft.documentHelper.pdf('_pdf/document.twig', 'file', 'pdf/book'  ~ '.pdf'  ,entry, pdfOptions))}}">LINK </a>
```

This generate PDF with timestamp and caching policy problems of your hosting is gone.

```
<a href="http://some-domain.com/pdf/book.pdf?v=1668157143">LINK </a>
```

## Information about paths

The plugin serch files to version in @web directory by default, and build.txt in root path.

With ❤ by [CoolTRONIC.pl sp. z o.o.](https://cooltronic.pl) by [Pawel Potacki](https://potacki.com)

## License

The MIT License (MIT)

Copyright (c) 2022 CoolTRONIC.pl sp. z o.o. by Pawel Potacki

More about CoolTRONIC.pl sp. z o.o. Interactive Agency https://cooltronic.pl/

More about main developer Pawel Potacki https://potacki.com/

CoolTRONIC.pl sp. z o.o., hereby holds all copyright interest in the program “Static Files Autoversioning plugin” written by Pawel Potacki.

LICENSE.md file contains full License notices.
