#!/bin/bash
date=$(date -d '-1 days' +"%Y-%m-%d")
result="/home/bae/log/flow.log.$date"
grep "router\\\light\\\Jobs:jobs" /home/bae/log/user.log.$date | awk -F '|' '{
    print $3"|"$2
}' | sort | uniq >/tmp/flow.log
awk -v date=$date -F '|' '{
        categories[$1]+=1;
    }END{
            for(category in categories){
                print date","category","categories[category]
            }
    }' /tmp/flow.log >>$result

users=$(awk -F '|' '{print $2}' /tmp/flow.log | sort | uniq | wc -l)
echo "$date,total,$users" >>$result
rm /tmp/flow.log