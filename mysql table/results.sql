update 
fight, event 
set 
fight.result = if(rand() = 0,fight.chick1,fight.chick2)
where 
event.id = fight.eventID 
and
year(event.endDate)< year(curdate());
