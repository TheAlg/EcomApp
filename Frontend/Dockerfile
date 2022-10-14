# Stage 1: Compile and Build angular codebase

# Use official node image as the base image
FROM node:latest as build
RUN mkdir /usr/src/app
WORKDIR /usr/src/app
# Set the working directory
COPY ./package.json ./
RUN npm install -g @angular/cli
RUN npm install 
EXPOSE 4200
CMD ["ng", "serve", "--host", "0.0.0.0"]



#FROM nginx:alpine
#COPY ./nginx.conf /etc/nginx/nginx.conf
#RUN rm -rf /usr/share/nginx/html/*
# Copy the build output to replace the default nginx contents.
#COPY --from=build /usr/src/app/dist/AngularEcomm /usr/share/nginx/html
#RUN chgrp -R root /var/cache/nginx /var/run /var/log/nginx && \
#    chmod -R 770 /var/cache/nginx /var/run /var/log/nginx#
#CMD ["nginx", "-g", "daemon off;"]
