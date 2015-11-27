#!/bin/bash
#Program:
#	Program shows the script name,parameters ...
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
echo "The script name is 		==>${0}"
echo "Total parameter number is		==>$#"
[ "$#" -lt 2 ] && echo "The number of parameter is less than 2,Stop here," && exit 0
echo "Your whole parameter is 		==>'$@'"
echo "The 1st parameter			==>${1}"
echo "The 2nd parameter			==>${2}"
exit 0
