#!/bin/bash
VERSTR=`dpkg-parsechangelog --show-field Version`
echo sed -i "/\"version\":/c \"version\": \"${VERSTR}\"," debian/vendorzone/usr/share/vendorzone/composer.json
