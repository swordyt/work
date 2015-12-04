#!/bin/bash
#Program:
#	Show "Hell" from $1... by using case .... esac.
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
case $1 in
	"hello")
		echo "Hello,how are you ?";
	;;
	"")
	echo "You MUST input parameters,ex>{$0 someword}";
	;;
	*)
	echo "Usage $0 {hello}";
	;;
esac
exit 0
