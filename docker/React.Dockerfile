FROM node:13.12.0-alpine

# set working directory
WORKDIR /app

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

# install app dependencies
COPY ./client/package.json ./package.json
RUN npm cache clean --force
RUN npm install --no-package-lock

# add app
COPY ./client/public ./public
COPY ./client/src ./src
COPY ./client/package.json ./package.json

# start app
CMD ["npm", "start"]