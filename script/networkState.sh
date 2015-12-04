#!/bin/bash
#Program:
#	Use ping command to check the network's PC state.
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
network="10.59.80";			#先定义一个网域的前面部分！
for sitenu in $(seq 1 100)		#seq 为sequence(连续)的缩写之意
do
	#底下的程序在取得ping的回传值是正确的还是失败的！
	ping -c 1 -w ${network}.${sitenu} &> /dev/null && result=0 || result=1;
	#开始显示结果是正确的启动（UP）还是错误的没有联通（DOWN）
	echo "$result"
	if [ "$result" == 0 ];then
		echo "Server ${network}.${sitenu} is UP.";
	elif [ "$result" == 1 ];then
		echo "Server ${network}.${sitenu} is DOWN.";
	else
		echo "Program is Error!";
	fi
done
exit 0
