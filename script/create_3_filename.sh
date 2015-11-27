#!/bin/bash
#Program:
#	Program create three files,which named by user`s input and date command.
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
#1.让使用者输入文件名称，并取得fileuser这个变量；
echo -e "I will use 'touch' Command to create 3 files." #纯粹显示提示
read -p "Please input your filename:" fileuser	#提示使用者输入
#2.为了避免使用者随意按Enter，利用判断功能分析变量是否有设值？
filename=${fileuser:-"filename"} 	#开始判断是否有设定变量

#3.开始利用 date指令来取的所需要的变量；
date1=$(date --date '2 days ago' +%Y%m%d)	#前两天的日期
date2=$(date --date '1 days ago' +%Y%m%d)	#前一天的日期
date3=$(date  +%Y%m%d)				#今天的日期
file1=${filename}${date1}
file2=${filename}${date2}
file3=${filename}${date3}

#4.将文件名建立
touch "${file1}"	#底下三行在建立文件
touch "${file2}"	#底下三行在建立文件
touch "${file3}"	#底下三行在建立文件
exit 0

