#!/bin/bash
#Program:
#	User input a scale number to calculate pi number.
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
echo -e "This program will calculate pi value.\n"
echo -e "You should input a float number to calculate pi value.\n"
read -p "The scale number (10~100000)? " checking
num=${checking:-"10"}
echo -e "Starting calcuate pi value,Be patient."
time echo "scale=${num}; 4*a(1)" | bc -lq
exit 0
