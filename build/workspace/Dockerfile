FROM phusion/baseimage:0.10.0

RUN DEBIAN_FRONTEND=noninteractive
RUN locale-gen en_US.UTF-8

ENV LANGUAGE=en_US.UTF-8
ENV LC_ALL=en_US.UTF-8
ENV LC_CTYPE=UTF-8
ENV LANG=en_US.UTF-8
ENV TERM xterm

# Install "software-properties-common" (for the "add-apt-repository")
RUN apt-get update && apt-get install -y \
    software-properties-common \
    libpq-dev \
    git

# Clean up, to free some space
RUN apt-get clean

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD init.sh /sbin/init.sh
RUN chmod +x /sbin/init.sh
CMD ["/sbin/init.sh"]

WORKDIR /var/www
