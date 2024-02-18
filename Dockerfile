FROM ubuntu:latest
LABEL authors="modou"

ENTRYPOINT ["top", "-b"]