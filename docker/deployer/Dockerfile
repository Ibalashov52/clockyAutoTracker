FROM phpdockerio/php:8.1-cli

RUN apt-get update \
    && apt-get install -y rsync openssh-client git \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR /tmp

RUN composer require --dev --ignore-platform-reqs deployer/deployer

CMD ["bash"]
