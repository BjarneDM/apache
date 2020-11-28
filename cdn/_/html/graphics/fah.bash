#!/opt/local/bin/bash

cd $( dirname ${0} )

for type in 'wus' 'score'
do
    curl -s -L \
        -o "FoldingAtHome-${type}-certificate-107558123.jpg" \
        --url "https://apps.foldingathome.org/awards?user=107558123&type=${type}"
done
