FROM amazon/aws-cli

ENV AWS_DEFAULT_OUTPUT="text"

COPY create-buckets /usr/local/bin/create-buckets
COPY create-cache /usr/local/bin/create-cache
COPY create-resources /usr/local/bin/create-resources
COPY public-read.json /aws/public-read.json

RUN chmod +x /usr/local/bin/create-buckets \
    && chmod +x /usr/local/bin/create-cache \
    && chmod +x /usr/local/bin/create-resources \
    && chmod +r /aws/public-read.json
