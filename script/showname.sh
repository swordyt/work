#!/bin/bash
#Program:
#	User input his first name and last name,Program shows his full name,
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
read -p "Please input your first name:" firstname	#提示使用者输入
read -p "Please input your last name:" lastname	#提示使用者输入
echo -e "\nYour full name is:"${firstname} ${lastname} #结果 由屏幕输出
exit 0
