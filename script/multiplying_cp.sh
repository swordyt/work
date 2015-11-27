#!/bin/bash
#Program:
#	User input 2 intger numbers;program will cross these two numbers.
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
echo -e "Program will output your result:\n"
read -p "Please input first number:" firstnu
read -p "Please input second number:" secnu
echo -e "Your result is :${firstnu} x ${secnu} = $((${firstnu}*${secnu}))"
exit 0


