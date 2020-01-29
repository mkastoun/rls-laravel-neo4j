# RLS

RLS it's web app, stands for row level security, it's responsible to manage item and folder that an employee can access based on the employee access level, employee's team access level , Folder access level and item access level.
## Build with:
  - Laravel
  - neo4j

### Prerequisite
On your machine you should have the following intsalled
* docker
* composer
* php 7+


# Installation

RLS requires composer and docker to be installed on your machine

 ```sh
$ git clone the project
$ cd to/the/project/folder
$ composer isntall
$ php artisan key:generate
$ cp .env.example .env
$ change DB_HOST to your localmachine ip
$ docker-compose up --build
```
### To check the database data
GO TO
```sh
http://localhost:7474/browser/
```
#### Neo4j credentials:
HOST
```sh
http://localhost:7474
```
USERNAME
```sh
neo4j
```
PASSWORD
```sh
123456
```

### RLS UI
RLS commes with a UI to facilitat the Item management To check the UI
GO TO
```sh
http://localhost:8014
```
## APIs
#### FOLDERS
- form parameter required
-- name
-- description

Get all folders
```sh
Method GET
/folder
```
store a folder
```sh
Method POST
/folder
```
show a folder
```sh
Method POST
/folder/{folderUuid}
```
Folder access level
```sh
Method GET
/folder/{folderUuid}/access
```

Folder items
```sh
Method GET
/folder/{folderUuid}/items
```
#### ITEMS
An item should always be in a folder

- form parameter required
-- name
-- description

Store Item
```sh
Method POST
/folder/{folderUuid}/item/
```

get Items of a folder
```sh
Method GET
/folder/{folderUuid}/item/
```

get Items details
```sh
Method GET
/folder/{folderUuid}/item/{itemUuid}
```

get Items access level
```sh
Method GET
/folder/{folderUuid}/item/{itemUuid}/access
```

### TEAM

- form parameter required
-- name

Store Team
```sh
Method POST
/team
```

get list of teams
```sh
Method GET
/team
```
get team details
```sh
Method GET
/team/{teamUuid}
```

Create employee and assign it to the team
```sh
Method POST
/team/{teamUuid}/employee
```

Assign an orphan employee to the team
```sh
Method POST
/team/{teamUuid}/employee/{employeeUuid}
```

Get Team list of employees
```sh
Method GET
/team/{teamUuid}/employee
```
Get Team list of accessible folders
```sh
Method GET
/team/{teamUuid}/folders
```

Get Team list of accessible items
```sh
Method GET
/team/{teamUuid}/items
```
Get Team Access level
```sh
Method GET
/team/{teamUuid}/access
```

DELETE employee from team
```sh
Method DELETE
/team/{teamUuid}/employee/{employeeUuid}
```
### ORPHAN EMPLOYEE
An employee without a team

- form parameter required
-- name
-- email

Create employee without a team
```sh
Method POST
employee/orphan
```
Get list of orphan Employees
```sh
Method GET
employee/orphan
```

### EMPLOYEE

- form parameter required
-- name
-- email

Get employee details
```sh
Method GET
employee/{employeeUuid}/details
```

Get employee accessible items, and team accessible items
```sh
Method GET
employee/{employeeUuid}
```

Get employee accessible folders
```sh
Method GET
employee/{employeeUuid}/folders
```
Get employee accessible items
```sh
Method GET
employee/{employeeUuid}/items
```

Get employee team
```sh
Method GET
employee/{employeeUuid}/team
```

Get employee's team accessible items 
```sh
Method GET
employee/{employeeUuid}/team/items
```
Get employee's team accessible folders 
```sh
Method GET
employee/{employeeUuid}/team/folder
```
### ACCESS LEVEL

- form parameter required
-- name
-- level

Store access level
```sh
Method POST
/access-level
```
Get list of access levels
```sh
Method GET
/access-level
```

Get details of access levels
```sh
Method GET
/access-level/{accessUuid}
```
### ACCESS TEAM
Assign Access level to team
```sh
Method POST
/access/{accessUuid}/team/{teamUuid}
```

Revoke team access
```sh
Method DELETE
/access/{accessUuid}/team/{teamUuid}
```

### ACCESS FOLDER
Assign Access level to folder
```sh
Method POST
/access/{accessUuid}/folder/{folderUuid}
```

Revoke folder access
```sh
Method DELETE
/access/{accessUuid}/folder/{folderUuid}
```

### ACCESS FOLDER
Assign Access level to item
```sh
Method POST
/access/{accessUuid}/item/{itemUuid}
```

Revoke item access
```sh
Method DELETE
/access/{accessUuid}/item/{itemUuid}
```

### ACCESS Employee
Assign Access level to employee
```sh
Method POST
/access/{accessUuid}/item/{employeeUuid}
```

Revoke employee access
```sh
Method DELETE
/access/{accessUuid}/item/{employeeUuid}
```

### PHP UNIT TEST
run the following command
```sh
vendor/bin/phpunit 
```
### Dependencies

RLS is currently using the following dependencies

| package | README |
| ------ | ------ |
| NeoEloquent | https://github.com/Vinelab/NeoEloquent/blob/1.4/README.md |
NeoEloquent its an OGM

