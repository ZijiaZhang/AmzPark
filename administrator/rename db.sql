alter table AdultVisitor_include rename to adult;
alter table YoungVisitor_include_isGuradedBy rename to young;
alter table adult rename column visitorname to aname;
alter table young rename column youngvisitorname to yname;
alter table adult rename column groupid to gid;
alter table maintenancefacility rename to facility;
alter table young rename column youngGroupID to yGID;
alter table young rename column adultVisitorName to aName;
alter table young rename column adultGroupID to aGID;
alter table ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1 rename to attraction;
alter table ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS2 rename to aCapacity;
alter table ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1 rename to entertainment;
alter table ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES2 rename to eCategory;
alter table RESERVATION_LINKEDTO_MANAGEDBY rename to reservation;
alter table repair rename column repaire_date to rdate;



SELECT * FROM R
WHERE x not in ( SELECT x FROM (
(SELECT x , y FROM (select y from S ) as p cross join
(select distinct x from R) as sp)
EXCEPT
(SELECT x , y FROM R) ) AS r );


select att_name from repair
where att_name not in (
  select att_name from (
    select att_name, mf_name from (
      select name from facility
    )
    cross join (
      select att_name from repair
    )
    except (
      select att_name, mf_name from repair
    )
  )
)

SELECT s.SName
FROM student s
WHERE NOT EXISTS
(SELECT * from course c
WHERE NOT EXISTS
(SELECT E.SID
FROM enrolled E
WHERE S.SID=E.SID AND
C.CID=E.CID));

SELECT s.SName
FROM student s
WHERE NOT EXISTS
((SELECT c.cid from course c) EXCEPT
(select E.cid
from Enrolled E
where E.sid = S.sid));

/* the name of the students who are enrolled in ALL the courses */
select r.att_name
from repair r
where not EXISTS ((select f.name as mf_name from facility f)
except
(select r2.mf_name
from repair.r2))
;

SELECT s.SName
FROM student s
WHERE NOT EXISTS
(SELECT * from course c
WHERE NOT EXISTS
(SELECT E.SID
FROM enrolled E
WHERE S.SID=E.SID AND
C.CID=E.CID));

-- work properly division
select distinct r.att_name
from repair r
where not exists
(select * from facility f
where not exists
(select r2.mf_name from repair r2
where r.att_name = r2.att_name and f.name = r2.mf_name));
