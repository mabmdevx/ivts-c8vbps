Programming Exercise

This exercise should be completed in 4 hours or less. The solution must be runnable, and can be written in any programming language.


The challenge is to build a HTTP-based RESTful API for managing Customers and their Certificates. Be thoughtful about the fact that the system must eventually support millions of certificates.


A Customer:

    Has a name

    Has an email address

    May have zero to many Certificates


A Certificate:

    Belongs to one and only one Customer

    Can be either active or inactive

    Has a private key

    Has a certificate body


Your solution must support:

    Creating/Deleting Customers

    Creating Certificates

    Listing all of a Customer’s Active Certificates

    Activating/Deactivating Certificates. If a certificate is either activated or de-activated, add the ability to notify an external system (via an HTTP post) about that fact.

    Persistence (data must survive computer restarts)


Shortcuts

    No authentication is required - any unauthenticated client can call it

    Transport/Serialization format is your choice, but the solution should be testable via curl

    Anything left unspecified is left to your discretion.

============================================================================

1. Creating/Deleting Customers : Done using REST endpoint

2. Creating Certificates : Done using REST endpoint

3. Listing all of a Customer’s Active Certificates : Done using REST endpoint

4. Activating/Deactivating Certificates. If a certificate is either activated or de-activated, add the ability to notify an external system (via an HTTP post) about that fact. : Done using REST endpoint + CURL POST

5. Persistence (data must survive computer restarts) : All data is stored in a MySQL database.

- The endpoints return paginated data where it is supposed to return a list of records to be thoughtful of the fact that it may return millions of records.

More details available in documentation/ directory.