# Makefile for Sphinx documentation
#

# You can set these variables from the command line.
BUILDDIR 	  = ./build

.PHONY: help clean build-phar

build-phar: clean composer
	@echo "Building Phar archive."
	php phar-creator.php 
	@echo "Moving Phar archive to build directory."
	php phar-creator.php && mv converter.phar build 
	@echo
	@echo "Finished building Phar archive."
	@echo

composer: 
	@echo "Installing required packages via Composer."
	cd source && composer install && cd -
	@echo
	@echo "Finished installing required packages."
	@echo

help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  build-phar    to rebuild the Phar file"
	@echo "  clean         to clean the build directory, removing an old artifacts and previous Phar files"
	@echo "  help          to display this help message"

clean:
	@echo "Cleaning out old build artifacts."
	-rm -rf $(BUILDDIR)/*
	@echo
	@echo "Finished cleaning out old build artifacts."
	@echo
