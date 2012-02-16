BOOTSTRAP = ./bootstrap/docs/assets/css/bootstrap.css
BOOTSTRAP_LESS = ./style.less
BOOTSTRAP_RESPONSIVE = ./bootstrap/docs/assets/css/bootstrap-responsive.css
BOOTSTRAP_RESPONSIVE_LESS = ./bootstrap/less/responsive.less
LESS_COMPRESSOR ?= `which lessc`
WATCHR ?= `which watchr`

#
# BUILD SIMPLE BOOTSTRAP DIRECTORY
# lessc & uglifyjs are required
#

build:
	lessc ${BOOTSTRAP_LESS} > style.css
	lessc --compress ${BOOTSTRAP_LESS} > style.min.css
	lessc ${BOOTSTRAP_RESPONSIVE_LESS} > bootstrap-responsive.css
	lessc --compress ${BOOTSTRAP_RESPONSIVE_LESS} > bootstrap-responsive.min.css

#
# WATCH LESS FILES
#

watch:
	echo "Watching less files..."; \
	watchr -e "watch('less/.*\.less') { system 'make' }"


.PHONY: build watch