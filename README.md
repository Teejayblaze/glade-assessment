# glade-assessment
Glade Assessment Challenge Solution.

## Task 1: 
The code assessment challenge is completed and below is the Github repository link.
https://github.com/Teejayblaze/glade-assessment

## Setting up:
—————-
- Change the database settings in the .env file
- Change the mail settings as well but you can leave the current default setting as this works.
- To track mails sent after “company” successful creation 
  - Mailtrap credentials:
  - Username: surfsamson@gmail.com
  - Password: Teejayblaze4kryst
  - To migrate the tables: php artisan migrate --seed
  - Superadmin will be assigned default permission throughout the application lifecycle.



## Task 2:
- The cloud server I would prefer will be DigitalOcean.

## Reason why:
 - DigitalOcean’s pricing structure is simple, easy to understand, and all inclusive. Transfer and SSD costs are already incorporated on the pricing and there is no additional cost for it.
 - Digital Ocean provides 99.99% uptime guarantee for the droplets.
 - Easy to use platform
 - Fast create and deploy Ubuntu virtual machines
 - Developer friendly 
 - Low and predictable costs

## Services Needed:
 - Droplets
 - Installation of Lemp stack on the droplet ubuntu server.
 - Lemp (Linux, Nginx, Mysql, PHP)

## Security of Service:
- Droplet services are certificate protected and these certificate are signed with public and private key.
- The public certificate resides on the server and every request to the server is checked against the private key.


## Deployment Strategy:
- First, I will set up the server by creating droplet and installing the necessary stack (Lemp) on the droplet
- Secondly, I will create a user for this droplet for management purposes.
- I will also ensure the project is hosted on a GitHub repository as private repo
- I will then establish a connection between the Github repo to my DigitalOcean’s droplet by using a DigitalOcean repo addons to enable me pull from the branch in question.
- After which, I will make all the necessary configuration for the application.


## Task 3:
 - When the branch is the default branch:
    - On staging:  DEPLOY_VARIABLE is staging-deploy-production.
    - On production: DEPLOY_VARIABLE is deploy-production.