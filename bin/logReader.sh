#! /bin/sh
#每分钟执行 获取上一分钟的log纪录
#
#
appid=123
appkey=456
tailRows=300

report(){
	log_mark=$(date "+%d/%b/%Y:%H:%M:%S" -d last-second)
	logs=`tail -n $tailRows $1 |grep $log_mark`
    timestamp=`date +%s`
    logs_md5=`echo -n "$1|${logs}|${timestamp}|${appkey}"|md5sum|cut -d ' ' -f 1`
	curl $2 -H "REPORT-FILE:$1" -H "REPORT-MD5:$logs_md5" -H "REPORT-APPID:${appid}" -H "REPORT-TIME:${timestamp}" -d  "$logs"
}

# 检查test实例是否已经存在
while [ 1 ] ; do
        report $1 $2
        sleep 1
done

