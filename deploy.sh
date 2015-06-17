#!/bin/bash
srcd="./web"
srvd="/srv/http"



if ! ( [ -d $srcd/application ] && [ -d $srcd/system ] && [ -d $srcd/kml ] )
then
	echo "please start deployment in root- folder of oeffi-track [having web as a subdir]"
	exit 1
fi

if ! ( [ -d $srvd/application ] && [ -d $srvd/system ] && [ -d $srvd/kml ] )
then
	echo "'" $srvd "' seems not to be a valid target, forcing not yet possible"
	exit 1
fi

if ! rm -rf $srvd/*
then
	echo "'" $srvd "' cannot be cleaned. Are you not using sudo or root?"
	exit 1
fi

cp -r $srcd/* $srvd
chown http:http $srvd/* -R

echo aha..



