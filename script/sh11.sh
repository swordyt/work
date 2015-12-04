#!/bin/bash
#Program:
#	You input your demobilization date,I calculate how many days
#	before you demobilize.
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
#1.告诉使用者这个程序的用途，并且告知aaaooooooss该如何输入日期格式？
echo "This program will try to calculate:"
echo "How many deys before your demobilization date..."
read -p "Please input your demobilization date (YYYYMMDD ex>20151204):" date2

#2.测试一下，这个输入的内容是否正确？利用正规表示法罗~
date_d=$(echo $date2 |grep '[0-9]\{8\}')	#看看是否有八个数字
if [ "$date_d" == "" ];then
	echo "You input the wrong date format......"
fi

#3.开始计算日期罗~
declare -i date_dem=`date --date="$date2" +%s`;	#退伍日期秒数
declare -i date_now=`date +%s`;			#现在日期秒数
declare -i date_total_s=$(($date_dem-$date_now)); #剩余秒数计
declare -i date_d=$(($date_total_s/60/60/24));	#转为日期
if [ "$date_total_s" -lt "0" ];then
	echo "You had been demobilization before:"$((-1*$date_d))"ago";
else
	declare -i date_h=$(($(($date_total_s-$date_d*24*60*60))/60/60));
	echo "You will demobilize after $date_d days and $date_h hours.";
fi
exit 0
