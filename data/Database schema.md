# Database Structure

## People

* **id**
* name
* _role (FK role id)_
	
## People-People Relationships

* **id**
* _person_a_id (FK people id)_
* _person_b_id (FK people id)_
* _film_id (FK film id)_
* comment
* weight
* flashback_only Boolean

## People Statuses 
e.g. Jigsaw victim/Jigsaw recruit/game participant/killed/police rank

* **id**
* name
	
## People-Status Relationships

* **id**
* _person_id (FK people id)_
* _film_id (FK film id)_

## Roles
e.g. police/hospital/civilian/law

* **id**
* name

## People-Roles Relationships

* **id**
* _people (FK people id)_
* _role (FK film id)_


## Films

* **id**
* name
	
## People-Films Relationships

* **id**
* _people (FK people id)_
* _film (FK film id)_
* flashback_only Boolean