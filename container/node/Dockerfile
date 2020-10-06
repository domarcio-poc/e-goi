FROM node:12.18.3

RUN mkdir -p /usr/src
WORKDIR /usr/src

ENV PATH /usr/src/node_modules/.bin:$PATH

COPY package.json /usr/src

RUN npm install -g

COPY . /usr/src

EXPOSE 4200

CMD ["ng", "serve", "--host", "0.0.0.0"]
