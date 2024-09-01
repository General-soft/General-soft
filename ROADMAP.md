# Roadmap

Possible improvements in the future.

## Access coverage files from local web server

Currently, coverage html generates `./converate/index.html` and it is not accessible from local deployment environment.

## Automate tests

After commit all tests should run on ci/cd pipelines.

## Automate pint

After commit ci/cd pipelines should validate code style.

## Add phpstan and automate it

Currently, code is vulnerable to invalid type manipulations. Phpstan can help to discover possible bugs.

## Add validation of other types of files

Code support only validation of json files. It is a part of testing assignment. But validation of more types of files may be needed.

## Remove ForceJsonMiddleware

It should be up to consumer of an api to set `Accept: application/json` header.

## Make writing openapi documentation easier

Currently, full open api attribute information should be provided. It will be more convenient to extend default attributes in similar manner to `App\Extensions\OpenApi\Attributes\Responses\HttpCreatedResponse.php`;

## Improve dns lookup

Cache dns response in cache for better performance. Possibly add other implementations for dns validation `IdentityValidator` in case google dns lookup service is not accessible. 


## Add a way to add new users

Currently, there is no way to add a new user.

