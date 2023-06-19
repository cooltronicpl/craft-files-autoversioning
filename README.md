# Static Files Autoversioning Plugin for Craft CMS 3.x or 4.x

Brought to you with love by [CoolTRONIC.pl sp. z o.o. (LLC)](https://cooltronic.pl) and [Pawel Potacki](https://potacki.com)

![Icon](resources/black.png#gh-light-mode-only)
![Icon](resources/white.png#gh-dark-mode-only)

A really basic Twig extension development plugin for CraftCMS that helps you cache-bust your assets.

The Static Files Autoversioning plugin is a fundamental Twig extension development tool for CraftCMS. It assists you in cache-busting your assets, ensuring that your users always receive the most recent version of your files.

## Overview

The plugin provides a Twig function that appends a build number or the file's last modified time to the filename. This forces the browser to download the updated asset file, effectively busting the cache.

## Prerequisites

Craft CMS >= 3.0.0 for the 1.x branch
Craft CMS >= 4.0.0 for the 2.x branch

## Installation

### Project Setup

To install the plugin, navigate to your Craft project in your terminal:

```shell
cd /path/to/craftcms-project
composer require cooltronicpl/craft-files-autoversioning
```
Then, in the control panel, navigate to Settings → Plugins and click the “install” button for **Static Files Autoversioning**. Also you can make easy install from Craft CMS Plugin Store.

## Version Number Assignment

The build number appended to the asset URL is read from a file named build.txt located in your root project folder (alongside config, templates, etc.). You can add the build number to this file using your deployment script. For instance, if you're using CodeShip, you can use the following command:

```shell
echo -n "${CI_BUILD_NUMBER}" > build.txt
```

If the `build.txt` file doesn't exist, the plugin will use the file's last modified time as the version number.

## Usage

You can use the new Twig function `version()` in your template. For instance:

```twig
<link rel="stylesheet" href="{{ version('/css/styles.css')}}">
```

will result this:

```html
<link rel="stylesheet" href="/css/styles.css?v=12345678" />
```

### Advanced Usage

If you have a caching policy for multiple files, such as videos or PDFs, you can use this plugin to pass the actual file after updating the link. For example:

```
<a href="{{alias('@web')}}{{version('/uploads/main-video.mp4')}}">LINK </a>
```

This will generate a file with a timestamp. When the file changes, the timestamp changes and a new version is downloaded:

```
<a href="http://some-domain.com/uploads/main-video.mp4?v=1667385206">LINK </a>
```

## Versioning from Provided String

This can be useful when you have a build.txt file and want to version a file from an input string. For example:

```twig
<link rel="stylesheet" href="{{ versionString('/css/styles.css', 'customstring')}}">
```

This function returns a text value in the versioning v parameter, i.e., `customstring`. In this example, it results in the following file path:

```html
<link rel="stylesheet" href="/css/styles.css?v=customstring" />
```

## Versioning Only from Timestamp

This can be useful when you have a `build.txt` file and want to version a file from a timestamp. For example:

```twig
<link rel="stylesheet" href="{{ versionTimestamp('/css/styles.css')}}">
```


## Versioning from Custom Text Files

This can be useful when you have a build.txt file and want to version a file from a specific text file, like mods.txt, which should be located in your root Craft CMS project folder. For example:

```twig
<link rel="stylesheet" href="{{ versionCustom('/css/styles.css', 'mods.txt')}}">
```

This function returns the text value inside `@root` in the `mods.txt` file.

### How to Use with PDF Generator or Varnish Cache and Other Caching Solutions?

You can also use this plugin with [PDF Generator](https://github.com/cooltronicpl/Craft-document-helpers/) when your hosting or server is caching PDF files. Or your files is cached by caching plugins like [Varnish Cache](https://github.com/cooltronicpl/varnishcache/).

```
<a href="{{alias('@web')}}{{version("/" ~ craft.documentHelper.pdf('_pdf/document.twig', 'file', 'pdf/book'  ~ '.pdf'  ,entry, pdfOptions))}}">LINK </a>
```

This generates a PDF with a timestamp, solving any caching policy issues with your hosting.

```
<a href="http://some-domain.com/pdf/book.pdf?v=1668157143">LINK </a>
```

## Information about Paths

By default, the plugin searches for files to version in the @web directory, and for the `build.txt` or custom text file in the `@root` path.

## License

The MIT License (MIT)

Copyright (c) 2022 CoolTRONIC.pl sp. z o.o. by Pawel Potacki

More about [CoolTRONIC.pl sp. z o.o. (LLC) Interactive Agency](https://cooltronic.pl/)

More about [main developer Pawel Potacki](https://potacki.com/)

CoolTRONIC.pl sp. z o.o., hereby holds all copyright interest in the program “Static Files Autoversioning plugin” written by Pawel Potacki.

LICENSE.md file contains full License notices.
