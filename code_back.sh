#!/usr/bin/bash
date=$(date '+%Y-%m-%d_%Hh-%M_cns.tar.gz')
echo -e "Le nom du fichier à créer est le suivant: " 
echo -e "\033[31m$date\033[0m"
echo -e "\n\033[31mCela convient-t-il ? [ O / * ]\033[0m"
read confirm
echo -e "\n"
if [ $confirm = "O" ]
then
	cd /opt/lampp/htdocs/
	tar -czvf /home/antoine/Documents/informatique/html/cns/backups/prog/$date *
else
	echo "\033[31mPas de création d'archive\033[0m"
fi

echo -e "\n\033[31mFaire une backup pour github ? [ O / * ]\033[0m"
read confirm1
if [ $confirm1 = "O" ]
then
	rm -r /home/antoine/Documents/informatique/html/cns/foo/*
	cp -r /opt/lampp/htdocs/* /home/antoine/Documents/informatique/html/cns/foo/
	rm -r /home/antoine/Documents/informatique/html/cns/foo/img/
	cd /home/antoine/Documents/informatique/html/cns/foo/
else
	echo ""
fi
echo -e "\033[31mOk, fermeture du programme\033[0m"
exit