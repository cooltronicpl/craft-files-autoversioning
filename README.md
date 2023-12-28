# Static Files Autoversioning Plugin for Craft CMS

This plugin is a Twig extension that helps you cache-bust your static assets, such as CSS, JS, images, videos, or PDFs. It appends a version number to the asset URL, based on either a build number or the file’s last modified time. This ensures that your users always receive the most recent version of your files, without having to clear their browser cache.

<picture>
  <source srcset="resources/black.png" media="(prefers-color-scheme: light)">
  <source srcset="resources/white.png" media="(prefers-color-scheme: dark)">
  <img alt="Static Files Autoversioning Plugin for Craft CMS" src="resources/white.png" width="60">
</picture>

## Table of Contents

1. [Features](#features)
2. [Installation](#installation)
3. [Usage](#usage)
4. [Advanced Usage](#advanced-usage)
   - [Versioning from a String](#versioning-from-a-string)
   - [Versioning from a Timestamp](#versioning-from-a-timestamp)
   - [Versioning from a Custom Text File](#versioning-from-a-custom-text-file)
   - [Versioning with PDF Generator or Varnish Cache](#versioning-with-pdf-generator-or-varnish-cache)
   - [Note about paths](#note-about-paths)
5. [License](#license)
6. [Credits](#credits)

## Features

- Compatible with Craft CMS 3.x, 4.x and 5.0.0.alpha
- Supports multiple file types and caching policies
- Allows custom versioning from strings or text files
- Integrates with PDF Generator and Varnish Cache plugins

## Installation

You can install this plugin from the [Craft Plugin Store](https://plugins.craftcms.com/craft3-files-autoversioning) or with Composer.

### From the Plugin Store

Go to the Plugin Store section of your Craft control panel and search for “Static Files Autoversioning”. Then click on the “Install” button in its modal window.

### Project Setup

To install the plugin, navigate to your Craft project in your terminal:

```shell
# go to the project directory
cd /path/to/my-project

# tell Composer to load the plugin
composer require cooltronicpl/craft-files-autoversioning

# tell Craft to install the plugin
./craft install/plugin craft3-files-autoversioning
```

## Usage

To use this plugin, you need to call the `version()` function in your template, passing the asset path as an argument. For example:

```twig
<link rel="stylesheet" href="{{ version('/css/styles.css') }}">
```

This will output something like:

```html
<link rel="stylesheet" href="/css/styles.css?v=12345678" />
```

The version number (`v=12345678`) is determined by reading a file named `build.txt` in your root project folder (alongside `config`, `templates`, etc.). You can create and update this file using your deployment script. For instance, if you’re using CodeShip, you can use the following command:

```shell
echo -n "${CI_BUILD_NUMBER}" > build.txt
```

## Advanced Usage

### Versioning from a String
 
If you want to use a custom string as the version number, you can use the `versionString()` function, passing the asset path and the string as arguments. For example:

```twig
<link rel="stylesheet" href="{{ versionString('/css/styles.css', 'customstring') }}">
```

This will output something like:

```
<link rel="stylesheet" href="/css/styles.css?v=customstring">
```

### Versioning from a Timestamp

If you want to use the file’s last modified time as the version number, regardless of the existence of the build.txt file, you can use the `versionTimestamp()` function, passing the asset path as an argument. For example:

```twig
<link rel="stylesheet" href="{{ versionTimestamp('/css/styles.css') }}">
```

This will output something like:

```html
<link rel="stylesheet" href="/css/styles.css?v=1667385206">
```

### Versioning from a Custom Text File

If you want to use the content of a custom text file as the version number, you can use the `versionCustom()` function, passing the asset path and the text file name as arguments. The text file should be located in your root project folder. For example:

```twig
<link rel="stylesheet" href="{{ versionCustom('/css/styles.css', 'mods.txt') }}">
```

This will output something like:

```html
<link rel="stylesheet" href="/css/styles.css?v=modded">

```

Assuming that the `mods.txt` file contains the word “modded”.

### Versioning with PDF Generator or Varnish Cache

You can also use this plugin with [PDF Generator](https://github.com/cooltronicpl/Craft-document-helpers/) when your hosting or server is caching PDF files. Or your files are cached by caching plugins like [Varnish Cache](https://github.com/cooltronicpl/varnishcache/).

```twig
<a href="{{alias('@web')}}{{version("/" ~ craft.documentHelper.pdf('_pdf/document.twig', 'file', 'pdf/book'  ~ '.pdf'  ,entry, pdfOptions))}}">LINK</a>
```

This will output something like:

```html
<a href="http://some-domain.com/pdf/book.pdf?v=1668157143">LINK</a>
```

This generates a PDF with a version number, solving any caching policy issues with your hosting.

### Note about paths

By default, the plugin searches for files to version in the `@webroot` directory, and for the `build.txt` or custom text file in the `@root` path.

**Note:** You can learn more about the `@webroot` and `@root` aliases and how to configure them in the Craft CMS documentation.

## License

This plugin is licensed under the [GPLv3 license](LICENSE.md).

## Credits

This plugin is brought to you with love by  [CoolTRONIC.pl sp. z o.o. (LLC) Interactive Agency](https://cooltronic.pl/) and [Pawel Potacki](https://potacki.com/).

