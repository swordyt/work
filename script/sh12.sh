#!/bin/bash
#Program:

#	This script only accept the flowing parameter:one,two or three.
#Remark:
#script 的功能；
#script 的版本資訊；
#script 的作者與聯絡方式；
#script 的版權宣告方式；
#script 的 History (歷史紀錄)；
#script 內較特殊的指令，使用『絕對路徑』的方式來下達；
#script 運作時需要的環境變數預先宣告與設定。
#History:
#2015/12/04	Sword	First release
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH
echo "This program will print your selection !";
#read -p "Input your choice:" choice #暂时取消，可以替换！
#case $choice in			#暂时取消，可以替换！
case $1 in
	"one")
		echo "Your choice is ONE";
	;;
	"two")
		echo "Your choice is TWO";
	;;
	"three")
		echo "Your choice is THREE";
	;;
	*)
		echo "Usage $0 {one|two|three}";
	;;
esac
exit 0
