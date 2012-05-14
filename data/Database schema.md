# Database Structure

## People

* **id (PK)**
* name UNIQUE
* _role (FK role id)_


## People-People Relationships

* **id (PK)**
* _person_a_id (FK people id)_
* _person_b_id (FK people id)_
* _film_id (FK film id)_
* comment
* weight
* flashback_only Boolean


## People Statuses 
e.g. Jigsaw victim/Jigsaw recruit/game participant/killed/police rank

* **id (PK)**
* name

	
## People-Status Relationships

* **id (PK)**
* _person_id (FK people id)_
* _film_id (FK film id)_


## Roles
e.g. police/hospital/civilian/law/health insurance

* **id (PK)**
* name  UNIQUE


## Films

* **id (PK)**
* name UNIQUE

	
## People-Films Relationships

* **id (PK)**
* _people (FK people id)_
* _film (FK film id)_
* flashback_only Boolean