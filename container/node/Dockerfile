FROM node:12.18.3 AS build

RUN mkdir -p /usr/src
WORKDIR /usr/src

COPY package.json /usr/src
RUN npm install
COPY . /usr/src

RUN npm run build -- --prod --outputPath=./dist/out

FROM nginx:1.19.3
RUN rm -rf /usr/share/nginx/html/*
COPY --from=build /usr/src/dist/out/ /usr/share/nginx/html
