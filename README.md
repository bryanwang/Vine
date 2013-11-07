Vine
====

Single purpose proof of concept Vine client using their private API.

Relied on https://github.com/starlock/vino/wiki/API-Reference for identifying endpoints.

Server side calls simply tunnel the request through to the relevant Vine API endpoints, adding in the session ID for authenticated calls.
