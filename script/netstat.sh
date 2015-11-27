#!/bin/bash
#Program:
#	Using netstat and grep to detect WWW,SSH,FTP and Mail services.
#Remark:
#script 的功能；
#script 的版本資訊；
#script 的作者與聯絡方式；
#script 的版權宣告方式；
#script 的 History (歷史紀錄)；
#script 內較特殊的指令，使用『絕對路徑』的方式來下達；
#script 運作時需要的環境變數預先宣告與設定。
#History:
#2015/11/27	Sword	First release
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH
#1.先作一些提示的动作而已~
echo "Now,I will detect your Linux server's services!"
echo -e "The www,ftp,ssh,and,mail(smtp) will be detect!\n"

#2.开始进行一些测试的工作，并且也输出一些提示信息！
testfile=/dev/shm/netstat_checking.txt;
netstat -tulnp > ${testfile};			#先保存数据到内存体中，不用一直执行netstat
testing=$(grep ":80" ${testfile});		#先侦测 port 80 在否！
if [ "${testing}" != "" ];then
	echo "WWW is running in your system.";
fi
testing=$(grep ":22" ${testfile});
if [ "${testing}" != "" ];then 
	echo "SSH is running in your system." 	#侦测 port 22 在否！
fi
testing=$(grep ":21" ${testfile});
if [ "${testing}" != "" ];then
	echo "FTP is running in your system.";	#侦测 port 21 在否！
fi
testing=$(grep ":25" ${testfile});
if [ "${testing}" != "" ];then
	echo "Mail in running in your system.";
fi
exit 0
