FROM node:boron-alpine

# Add essential build tools
RUN apk add --no-cache --virtual build-base automake autoconf libpng-dev nasm

# Create app directory and set as working directory
RUN mkdir -p /opt/ppl
WORKDIR /opt/ppl
RUN chown -R node:node /opt/ppl

# Install app dependencies (done before copying app source to optimize caching)
COPY package.json /opt/ppl/
COPY package-lock.json /opt/ppl/
COPY yarn.lock /opt/ppl/

RUN npm install --quiet

# Copy build definition file
COPY webpack.mix.js /opt/ppl/

# Build asset every time this container is run
CMD ["npm", "run", "dev"]