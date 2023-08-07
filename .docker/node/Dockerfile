ARG NODE_VERSION=18.15

FROM node:${NODE_VERSION}-alpine AS base

WORKDIR /var/www/app

FROM base AS local-node

ENTRYPOINT ["tail", "-f", "/dev/null"]
