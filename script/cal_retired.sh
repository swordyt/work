#!/bin/bash
#Program:
#	You input your demobilization date,I calculate how many days before you demobilize.
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
#1.告知使用者这支程序的用途，并且告知应该如何输入日期格式
echo "This program will try to calculate:";
echo "How many days before your demobilization date...";
read -p "Please input your demobilization date (YYYYMMDD) ex>20151127: " date2;
#2.测试一下，这个输入的内容是否正确？利用正则表达式~
date_d=$(echo "${date2}" | grep "[0-9]\{8\}");
if [ "${date_d}" == "" ];then
	echo "You input the wrong date format....";
	exit 1;
fi
#3.开始计算日期
declare -i date_dem=
exit 0
