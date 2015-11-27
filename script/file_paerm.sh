#!/bin/bash
#Program:
#	User input a filename,program will check the flowing:
#	1.)exist? 2.)file/directory? 3.)file permissions
#Remark:
#script 的功能；
#script 的版本資訊；
#script 的作者與聯絡方式；
#script 的版權宣告方式；
#script 的 History (歷史紀錄)；
#script 內較特殊的指令，使用『絕對路徑』的方式來下達；
#script 運作時需要的環境變數預先宣告與設定。
#History:
#2015/07/16	Sword	First release
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH
echo -e "Please input a file name?\n"
read -p "File name:" filename
test ! -e ${filename} && echo "Filename does not exist" && exit 1
test -f ${filename} && echo "Filename is regular file" || echo "Filename is directory"
test -r ${filename} && echo "Filename read:yes" || echo "Filename read:no"
test -w ${filename} && echo "Filename write:yes" || echo "Filename write:no"
test -x ${filename} && echo "Filename exe:yes" || echo "Filename exe:no"
test -u ${filename} && echo "Filename SUID:yes" || echo "Filename SUID:no"
test -g ${filename} && echo "Filename SGID:yes" || echo "Filename SGID:no"
test -k ${filename} && echo "Filename Sticky bit:yes" || echo "Filename Sticky bit:no"
test -s ${filename} && echo "Filename empty:yes" || echo "Filename empty:no"
exit 0
