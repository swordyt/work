#!/bin/bash
#Program:
#	This program shows user's choice.
#Remark:
#script 的功能；
#script 的版本資訊；
#script 的作者與聯絡方式；
#script 的版權宣告方式；
#script 的 History (歷史紀錄)；
#script 內較特殊的指令，使用『絕對路徑』的方式來下達；
#script 運作時需要的環境變數預先宣告與設定。
#History:
#2015/07/16	Sword	Scond release
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH
read -p "Please input (Y/N):" yn
if [ "${yn}" == "Y" ] || [ "${yn}" == "y" ];then
	echo "Ok,Continue";
	exit 0
fi
if [ "${yn}" == "N" ] || [ "${yn}" == "n" ];then
	echo "Oh,interrupt!";
	exit 0;
fi
echo "I don't know what your choice is" 
exit 0
