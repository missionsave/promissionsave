# ! /bin/sh
git config --global core.excludesfile /desk/promissionsave/.gitignore
git add . 
git commit -a -m "update"
git push original master

pause