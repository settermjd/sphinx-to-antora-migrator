# Sphinx-Doc to Antora Migration Tool

This is a small repository that provides tools for migrating a [Sphinx-Doc](http://www.sphinx-doc.org/en/master/) installation to [Antora](https://antora.org). It’s written in PHP, as the tool was written while working at ownCloud (the vast majority of ownCloud’s code is written in PHP).
Given that, it makes sense to keep using PHP. If you want to port it to another language, please feel free.

## What is it?

The tool is a command-line utility,provided as a PHP Phar archive, that provides a range of commands for exporting a Sphinx-Doc installation to Antora. Currently, there is only one supported command; this is `navigation:build-from-files`, which builds an Antora (AsciiDoc) navigation file, from a list of AsciiDoc files.

## Installation

The tool is provided both as code, and as a pre-packaged Phar file. So to install it, all you need is PHP, at least version 7.1 or higher. If you want to re-build the Phar archive, then you have two choices:

### 1. Via GNU Make

To use GNU Make to rebuild the Phar archive, run `make rebuild-phar`. When built, the Phar archive will be located in the build directory and named `converter.phar`.

### 2. Manually

To manually rebuild the Phar archive, run the following commands:

```
cd source
composer install
php create-phar.php
```

When completed, the Phar archive will be located in the root of the repository, and named `converter.phar`.

## Usage Instructions

### Creating an AsciiDoc navigation menu

To creating an AsciiDoc navigation menu, you have to pass a list of AsciiDoc files that you want to create an AsciiDoc navigation menu for to the `navigation:build-from-files` command.

The following example shows how to find all AsciiDoc files, and to pipe that file list to the`navigation:build-from-files` command.

```
find ./path/to/my/manual/modules/ROOT/pages \
	-type f -name "*.adoc" | \
	php converter.phar navigation:build-from-files
```

### List Available Commands

To list the available commands, supported by the Phar archive, just run it without any additional arguments, as in the example command below:

```
php converter.phar
```

Currently, this will output the following to the console:

```
#!/usr/bin/env php

Console Tool

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  help                         Displays help for a command
  list                         Lists commands
 navigation
  navigation:build-from-files  Creates a navigation AsciiDoc file from the source files
```
