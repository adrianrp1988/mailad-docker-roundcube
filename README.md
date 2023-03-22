# Roundcube webmail for mailad-docker.

# Keypoints

- Intended to work behind a reverse proxy.

- Let's Encript certs will be automated by a complementary container in the reverse proxy service.

- If just basic http roundcube webmail is needed check "basic" branch

# Setup

1- Create dedicated network for services to run
    - Just for organization not really a must, same network should be used in mailad service definition in the corresponding docker compose file.
    - Create a network named proxy:
    
    
    docker network create proxy
    

2- Setup nging-proxy.
    - Example configuration available in ./examples/nginx-proxy directory

3- Fill .env with values according to your needs

    - IMAP_SERVER and SMTP_SERVER vars will have same value most of the time.
    - VHOST_FQDN is the public fully qualified domain name of your service
    - DOMAIN .... self explanatory
    - address book autocompletion functionality is optional, but if needed, ALL OF THE VARS MUST BE FILLED:
        - ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_HOST -> the ldap server
        - ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BASE_DN -> base organizational unit for user searching
        - ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BIND_DN -> user for ldap binding with ldap server, only read access is needed
        - ROUNDCUBE_AUTOCOMPLETE_ADDRESS_BOOK_BIND_PASS -> password for the user for ldap binding 

4-Remember this is a WIP feel free to contribute or make suggestions

5- Enjoy

