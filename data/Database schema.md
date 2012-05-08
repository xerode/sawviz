# Database Structure

## People

	id
	name
	role (FK role id)
	
## People-People Relationships

	id
	person_a_id (FK people id)
	person_b_id (FK people id)
	film_id (FK film id)
	comment
	weight

## People Statuses 
e.g. Jigsaw victim/Jigsaw recruit/game participant/killed/police rank

	id
	name
	
## People-Status Relationships

	id
	person_id (FK people id)
	film_id (FK film id)

## Roles
e.g. police/hospital/civilian/law

	id
	name

## People-Roles Relationships

	id
	people (FK people id)
	role (FK film id)


## Films

	id
	name
	
## People-Films Relationships

	id
	people (FK people id)
	film (FK film id)
	flashback_only Boolean
	