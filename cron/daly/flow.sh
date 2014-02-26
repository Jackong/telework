#!/bin/bash
date=$(date -d '0 days' +"%Y-%m-%d")
result="/home/bae/log/flow.log.$date"
echo $date >>$result
grep "router\\\light\\\Jobs:jobs" /home/bae/log/user.log.$date | awk -F '|' '{if(length($2)==32){print $3"|"$2}}' | sort | uniq >/tmp/flow.log
awk -F '|' '{
        categories[$1]+=1;
    }END{
            for(category in categories){
                print category":"categories[category]
            }
    }' /tmp/flow.log >>$result

echo "The number of the users:" >>$result
awk -F '|' '{print $2}' /tmp/flow.log | sort | uniq | wc -l >>$result