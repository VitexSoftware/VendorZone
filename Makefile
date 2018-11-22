all: fresh build install

fresh:
	echo fresh

install: 
	echo install
	
build:
	echo build

clean:
	rm -rf debian/vendorzone 
	rm -rf debian/*.substvars debian/*.log debian/*.debhelper debian/files debian/debhelper-build-stamp *.deb

phinx:
	vendor/bin/phinx migrate -c ./phinx-adapter.php

newphinx:
	read -p "Enter CamelCase migration name : " migname ; phinx create $$migname -c ./phinx-adapter.php

db:
	phinx migrate

deb:
	dpkg-buildpackage -A -us -uc

dimage: deb
	mv ../vendorzone_*_all.deb .
	docker build -t vitexsoftware/vendorzone .

dtest:
	docker run -d -p 9001:9000 --name vendorzone  vitexsoftware/vendorzone:latest
        
drun: dimage
	docker run  -dit --name vendorZone -p 2323:9000 vitexsoftware/vendorzone
	nightly http://localhost:2323/vendorzone

dclean:
	docker rmi $(docker images |grep 'vendorzone')

vagrant: clean
	vagrant destroy
	vagrant up

.PHONY : install
	
