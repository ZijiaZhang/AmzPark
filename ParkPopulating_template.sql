insert into MaintenanceFacility
  values('Maintenance Facility 1','777-8888-9999');

insert into Administrator
  values('001','Shuwen Jiang','Big Wheel','a000000000');

insert into Administrator_Duty
  values('Big Wheel','111-2222-3333');

insert into Attractions_Insepect_And_Determines_Status
  values('testname1','2205 West Mall','40','CLOSED','09:00','17:00','001');

insert into Attractions_Capacity
  values('40','120');

insert into Repair
  values('Maintenance Facility 1','testname1',to_date('2019-05-23','YYYY-MM-DD'));

insert into Entertainments_Determin_Status
  values('Entertainment-1','6080 Iona Drive','Tuesday 19:00','CLOSED','80','001');

insert into Entertainments_Duration
  values('Entertainment-1', '120');

insert into Entertainments_Determin_Status
  values('Fireworks-1', 'Somewhere','Thursday 19:00','OPEN','20','001')
insert into Fireworks
  values('Fireworks-1','Thursday 19:00','Celebration');
insert into Entertainments_Duration
  values('Fireworks-1','100');

insert into Entertainments_Determin_Status
  values('LiveShows-1','idk','Friday 20:20','CLOSED','90','001');
insert into LiveShows
  values('LiveShows-1', 'Friday 20:20','xxxx,sss sssss,xx','Singing');
insert into Entertainments_Duration
    values('Liveshows-1','90');
