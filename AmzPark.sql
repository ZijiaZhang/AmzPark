
drop table
PLAN
cascade constraints;

drop table
GROUPS
cascade constraints;

drop table
ADULTVISITOR_INCLUDE
cascade constraints;

drop table
YOUNGVISITOR_INCLUDE_ISGURADEDBY
cascade constraints;

drop table
ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS2
cascade constraints;

drop table
REPAIR
cascade constraints;

drop table
MAINTENANCEFACILITY
cascade constraints;

drop table
ADMINISTRATOR1
cascade constraints;

drop table
ADMINISTRATOR2
cascade constraints;

drop table
ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1
cascade constraints;

drop table
MADEBY
cascade constraints;

drop table
OFVISITING
cascade constraints;

drop table
ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES1
cascade constraints;

drop table
ENTERTAINMENTS_DETERMIN_STATUS_AND_ARRANGE_TIMES2
cascade constraints;

drop table
RESERVATION_LINKEDTO_MANAGEDBY
cascade constraints;

CREATE TABLE MaintenanceFacility (
  name varchar(30) PRIMARY KEY,
  contact_Info varchar(13) UNIQUE
);

CREATE TABLE Administrator1 (
  adm_ID varchar(6) PRIMARY KEY,
  name varchar(15),
  dutyArea varchar(15),
  password varchar(32),
  UNIQUE(name, dutyArea)
);

CREATE TABLE Administrator2(
  dutyArea varchar(15) PRIMARY KEY,
  contact_Info varchar(13)
);


CREATE TABLE Attractions_Insepect_And_Determines_Status1 (
  att_name varchar(15) PRIMARY KEY,
  location varchar(20) UNIQUE,
  capacity integer,
  status varchar(6),
  open_time varchar(5),
  close_time varchar(5),
  adm_ID varchar(6) NOT NULL,
  FOREIGN KEY (adm_ID)
  REFERENCES Administrator1(adm_ID)
);

CREATE TABLE Attractions_Insepect_And_Determines_Status2 (
  capacity integer PRIMARY KEY,
  expected_Waiting_Time varchar(3)
);




CREATE TABLE Repair (
  mf_name varchar(30),
  att_name varchar(15),
  repaire_date date,
  PRIMARY KEY (mf_name, att_name),
  FOREIGN KEY (mf_name)
  REFERENCES MaintenanceFacility(name),
  FOREIGN KEY (att_name)
  REFERENCES Attractions_Insepect_And_Determines_Status1(att_name)
);


CREATE TABLE Entertainments_Determin_Status_And_Arrange_Times1 (
  name varchar(15),
  perform_time varchar(20),
  status varchar(6),
  PRIMARY KEY (name,perform_time)
 );

CREATE TABLE Entertainments_Determin_Status_And_Arrange_Times2 (
  name varchar(15) PRIMARY KEY,
  location varchar(20),
  duration varchar(3),
  price varchar(3),
  category varchar(10),
  adm_ID varchar(3) NOT NULL,
 FOREIGN KEY (adm_ID)
  REFERENCES Administrator1(adm_ID)
);

CREATE TABLE Plan(
  planNumber varchar(20) PRIMARY KEY
);

CREATE TABLE ofVisiting(
  planNumber varchar(20),
  attName varchar(15),
  PRIMARY KEY(planNumber, attName),
  FOREIGN KEY(planNumber) REFERENCES Plan(planNumber),
  FOREIGN KEY(attName) REFERENCES  
  Attractions_Insepect_And_Determines_Status1(att_name)
);

CREATE TABLE Groups(
  groupID varchar(8) PRIMARY KEY,
  groupSize integer,
  password varchar(32)
);


CREATE TABLE Reservation_linkedTo_ManagedBy(
  confirmNumber varchar(8) PRIMARY KEY,
  groupID varchar(8) NOT NULL,
  entertainmentName varchar(15) NOT NULL,
  perform_time varchar(20) NOT NULL,
  FOREIGN KEY(entertainmentName, perform_time) 
  REFERENCES Entertainments_Determin_Status_And_Arrange_Times1(name,     perform_time)
  ON DELETE CASCADE,
  UNIQUE(groupID,entertainmentName,perform_time),
  FOREIGN KEY(groupID) REFERENCES Groups(groupID)
);


CREATE TABLE Madeby(
  groupID varchar(8),
  planNumber varchar(20),
  PRIMARY KEY(groupID, planNumber),
  FOREIGN KEY(groupID) REFERENCES Groups(groupID),
  FOREIGN KEY(planNumber) REFERENCES Plan(planNumber)
);


CREATE TABLE AdultVisitor_include(
  visitorName varchar(15),
  groupID varchar(8),
  contact_Info varchar(13),
  PRIMARY KEY (visitorName, groupID),
  FOREIGN KEY(groupID) REFERENCES Groups(groupID)
  ON DELETE CASCADE
);


CREATE TABLE YoungVisitor_include_isGuradedBy(
  youngVisitorName varchar(15),
  youngGroupID varchar(8),
  adultVisitorName varchar(15) NOT NULL,
  adultGroupID varchar(8) NOT NULL,
  PRIMARY KEY(youngVisitorName,youngGroupID),
  FOREIGN KEY(youngGroupID) REFERENCES Groups(groupID)
  ON DELETE CASCADE,
  FOREIGN KEY(adultGroupID) REFERENCES Groups(groupID)
  ON DELETE CASCADE,
  FOREIGN KEY(adultVisitorName, adultGroupID) REFERENCES AdultVisitor_include(visitorName, groupID)
  ON DELETE CASCADE
);



CREATE view openAtt as SELECT * from ATTRACTIONS_INSEPECT_AND_DETERMINES_STATUS1 a where a.status='OPEN';

CREATE view goodPlan as 
SELECT * from plan a 
where NOT EXISTS (select * from openAtt b where NOT EXISTS (select * from ofvisiting c where a.plannumber = c.plannumber and b.att_name = c.attname));



DROP SEQUENCE conf_seq;

CREATE SEQUENCE conf_seq START WITH 1;    


CREATE OR REPLACE TRIGGER conf_bir
BEFORE INSERT ON Reservation_linkedTo_ManagedBy        
FOR EACH ROW
BEGIN
SELECT conf_seq.NEXTVAL
INTO :new.confirmNumber
FROM dual;
END;
/


insert into MaintenanceFacility
  values('1st Service Handyman','777-8888-9999');
insert into MaintenanceFacility
  values('All Pro Fix It','666-7777-9999');
insert into MaintenanceFacility
  values('Big Crew Maintenance','555-6666-8888');
insert into MaintenanceFacility
  values('Call me Handyman','777-6666-9999');
insert into MaintenanceFacility
  values('Credible repair','666-8888-9999');


insert into Administrator1
  values('001','Ace Jane', 'Tomorrow Land','123456abcd');
insert into Administrator1
  values('002','Adam Johns', 'Fantasy Town','abcd24680');
insert into Administrator1
  values('003','Baker Jake', 'Paradise Park','13579abcd');
insert into Administrator1
  values('004','Amy Lee', 'Paradise Park','24680abcd');
insert into Administrator1
  values('005','Charles Julia', 'Adventure Land' ,'abcd13579');
insert into Administrator1
  values('006','Susan Su', 'Adventure Land','24680abcd');
insert into Administrator1
  values('007','Mike Ma', 'Adventure Land','24680abcd');
insert into Administrator1
  values('008','Cohen Brian', 'Pacific Wharf','24680abcd');


insert into Administrator2
  values( 'Tomorrow Land','778-9999-0000');
insert into Administrator2
  values( 'Fantasy Town','888-2233-5566');
insert into Administrator2
  values('Paradise Park','777-9900-0099');
insert into Administrator2
  values('Adventure Land','666-9988-3300');
insert into Administrator2
  values('Pacific Wharf','555-7788-0099');


insert into Attractions_Insepect_And_Determines_Status1
  values('Ferris Wheel','Tomorrowland, No.1',120,'OPEN','09:00','21:00','001');
insert into Attractions_Insepect_And_Determines_Status1
  values('Sky Diver','Tomorrowland, No.2',30,'OPEN','09:00','19:00','001');
insert into Attractions_Insepect_And_Determines_Status1
  values('Free Fall','Fantasy Town, No.1',20,'OPEN','12:00','19:00','002');
insert into Attractions_Insepect_And_Determines_Status1
  values('Frisbee','Fantasy Town, No.2',50,'Repair','12:00','19:00','002');
insert into Attractions_Insepect_And_Determines_Status1
  values('Carousel','Paradise Park,No.1',30,'OPEN','09:00','21:00','003');
insert into Attractions_Insepect_And_Determines_Status1
  values('Bumper Cars','Paradise Park, No.2',30,'OPEN','09:00','21:00','003');
insert into Attractions_Insepect_And_Determines_Status1
  values('DiskO','Paradise Park, No.3',30,'OPEN','09:00','21:00','004');
insert into Attractions_Insepect_And_Determines_Status1
  values('Booster','Paradise Park, No.4',50,'OPEN','09:00','19:00','004');
insert into Attractions_Insepect_And_Determines_Status1
  values('Screamin Swing','Adventure Land, No.1',30,'Repair','09:00','15:00','005');
insert into Attractions_Insepect_And_Determines_Status1
  values('Enterprise','Adventure Land,No.2',30,'Repair','09:00','17:00','005');
insert into Attractions_Insepect_And_Determines_Status1
  values('Roller Coaster','Adventure Land, No.3',20,'OPEN','12:00','19:00','006');
insert into Attractions_Insepect_And_Determines_Status1
  values('Space Shot','Adventure Land, No.4',12,'OPEN','09:00','17:00','006');
insert into Attractions_Insepect_And_Determines_Status1
  values('Condor','Adventure Land, No.5',50,'OPEN','09:00','19:00','007');
insert into Attractions_Insepect_And_Determines_Status1
  values('Pirate Ship','Adventure Land, No.6',30,'OPEN','09:00','21:00','007');
insert into Attractions_Insepect_And_Determines_Status1
  values('Shoot the Chute','Pacific Wharf, No.1',12,'Repair','12:00','15:00','008');


insert into Attractions_Insepect_And_Determines_Status2
  values(120,'10');
insert into Attractions_Insepect_And_Determines_Status2
  values(50,'20');
insert into Attractions_Insepect_And_Determines_Status2
  values(30,'30');
insert into Attractions_Insepect_And_Determines_Status2
  values(20,'40');
insert into Attractions_Insepect_And_Determines_Status2
  values(12,'60');





Insert into Repair 
  values('1st Service Handyman', 'Condor', to_date('2019-05-23','YYYY-MM-DD'));
Insert into Repair 
  values('1st Service Handyman', 'Pirate Ship', to_date('2018-06-06','YYYY-MM-DD'));
Insert into Repair 
  values('Big Crew Maintenance', 'Bumper Cars', to_date('2018-05-05','YYYY-MM-DD'));
Insert into Repair 
  values('Credible repair', 'Ferris Wheel', to_date('2017-12-01','YYYY-MM-DD'));
Insert into Repair 
  values('Credible repair', 'Bumper Cars', to_date('2017-05-23','YYYY-MM-DD'));



Insert into Entertainments_Determin_Status_And_Arrange_Times1 
  values('FW Fantasmic','20190626 20:30','CLOSED');
Insert into Entertainments_Determin_Status_And_Arrange_Times1 
  values('FW Fantasmic','20190630 20:30','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('FW Fantasmic','20190708 20:30','CLOSED');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('FW Fantasmic','20190710 20:30','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('FW Fantasmic','20190715 20:30','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1 
  values('FW Wonderland','20190626 20:30','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('FW Wonderland','20190628 20:30','CLOSED');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('FW Wonderland','20190707 20:30','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('FW Wonderland','20190715 20:30','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('FW Wonderland','20190717 20:30','CLOSED');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Five Dime','20190701 14:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Five Dime','20190701 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Five Dime','20190707 14:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Five Dime','20190707 19:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Five Dime','20190711 14:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Five Dime','20190711 19:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Five Dime','20190715 14:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Five Dime','20190715 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Five Dime','20190718 14:00','CLOSED');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Five Dime','20190718 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Five Dime','20190723 14:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Five Dime','20190723 19:00','CLOSED');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Jazzy','20190629 14:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Jazzy','20190701 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Jazzy','20190705 14:00','CLOSED');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Jazzy','20190707 19:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Jazzy','20190711 14:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Jazzy','20190714 19:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Jazzy','20190718 14:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Jazzy','20190723 19:00','CLOSED');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Legend','20190702 14:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Legend','20190707 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Legend','20190711 14:00','CLOSED');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Legend','20190714 19:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Legend','20190716 14:00','OPEN');
-- Insert into Entertainments_Determin_Status_And_Arrange_Times1  
--   values('Legend','20190718 19:00','CLOSED');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Mariachi Divas', '20190701 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Mariachi Divas','20190705 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Mariachi Divas','20190716 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1 
  values('Mariachi Divas','20190719 19:00','OPEN');
Insert into Entertainments_Determin_Status_And_Arrange_Times1  
  values('Mariachi Divas','20190721 19:00','OPEN');





Insert into Entertainments_Determin_Status_And_Arrange_Times2
  Values ('FW Fantasmic', 'Tomorrowland, No.3', '20', '15', 'firework','001');
Insert into Entertainments_Determin_Status_And_Arrange_Times2
  Values ('FW Wonderland', 'Fantasy Land, NO.3','30', '20', 'firework', '002');
Insert into Entertainments_Determin_Status_And_Arrange_Times2
  Values ('Five Dime','Paradise Park, No.5', '30', '20', 'Dancing', '003');
Insert into Entertainments_Determin_Status_And_Arrange_Times2
  Values ('Jazzy', 'Paradise Park, No.6', '35', '20', 'Singing', '004');
Insert into Entertainments_Determin_Status_And_Arrange_Times2
  Values ('Legend', 'Adventure Land, No.7', '50', '50', 'Singing', '005');
Insert into Entertainments_Determin_Status_And_Arrange_Times2
  Values ('Mariachi Divas', 'Adventure Land, No.8', '30', '15', 'Stage Show', '006');






Insert into Plan
  Values ('Happy Summer');
Insert into Plan
  Values ('Really Exciting');
Insert into Plan
  Values ('A Mild Trip');
Insert into Plan
  Values ('Family Tour');
Insert into Plan
  Values ('G2 Customized');
Insert into Plan
  Values ('G6 Customized');


Insert into ofVisiting
  Values ('Happy Summer', 'Sky Diver');
Insert into ofVisiting
  Values ('Happy Summer', 'Frisbee');
Insert into ofVisiting
  Values ('Happy Summer', 'DiskO');
Insert into ofVisiting
  Values ('Happy Summer', 'Screamin Swing');
Insert into ofVisiting
  Values ('Happy Summer', 'Shoot the Chute');
Insert into ofVisiting
  Values ('Really Exciting', 'Screamin Swing');
Insert into ofVisiting
  Values ('Really Exciting', 'Roller Coaster');
Insert into ofVisiting
  Values ('Really Exciting', 'Free Fall');
Insert into ofVisiting
  Values ('Really Exciting', 'Space Shot');
Insert into ofVisiting
  Values ('Really Exciting', 'Booster');
Insert into ofVisiting
  Values ('Really Exciting', 'Enterprise');
Insert into ofVisiting
  Values ('A Mild Trip', 'Ferris Wheel');
Insert into ofVisiting
  Values ('A Mild Trip', 'Carousel');
Insert into ofVisiting
  Values ('A Mild Trip', 'DiskO');
Insert into ofVisiting
  Values ('Family Tour', 'Ferris Wheel');
Insert into ofVisiting
  Values ('Family Tour', 'Carousel');
Insert into ofVisiting
  Values ('Family Tour', 'Bumper Cars');
Insert into ofVisiting
  Values ('Family Tour', 'Pirate Ship');
Insert into ofVisiting
  Values ('Family Tour', 'DiskO');
Insert into ofVisiting
  Values ('G2 Customized', 'Sky Diver');
Insert into ofVisiting
  Values ('G2 Customized', 'Booster');
Insert into ofVisiting
  Values ('G2 Customized', 'Ferris Wheel');
Insert into ofVisiting
  Values ('G2 Customized', 'Roller Coaster');
Insert into ofVisiting
  Values ('G2 Customized', 'DiskO');
Insert into ofVisiting
  Values ('G6 Customized', 'Frisbee');
Insert into ofVisiting
  Values ('G6 Customized', 'Roller Coaster');
Insert into ofVisiting
  Values ('G6 Customized', 'Bumper Cars');
Insert into ofVisiting
  Values ('G6 Customized', 'Shoot the Chute');




-- Insert into Groups
--   Values ('00000001', 3,'abcd11111');
-- Insert into Groups
--   Values ('00000002',5,'abcd22222');
-- Insert into Groups
--   Values ('00000003', 1,'abcd33333');
-- Insert into Groups
--   Values ('00000004', 1,'abcd44444');
-- Insert into Groups
--   Values ('00000005', 2,'abcd55555');
-- Insert into Groups
--   Values ('00000006', 2,'abcd66666');




-- Insert into Reservation_linkedTo_ManagedBy
--   Values ('00000001', '00000001','Five Dime','20190701 14:00');
-- Insert into Reservation_linkedTo_ManagedBy
--   Values ('00000002', '00000001','Mariachi Divas','20190701 19:00');
-- Insert into Reservation_linkedTo_ManagedBy
--   Values ('00000003', '00000003','FW Fantasmic','20190630 20:30');
-- Insert into Reservation_linkedTo_ManagedBy
--   Values ('00000004', '00000005','Five Dime','20190707 14:00');
-- Insert into Reservation_linkedTo_ManagedBy
--   Values ('00000005', '00000005','Jazzy','20190707 19:00');
-- Insert into Reservation_linkedTo_ManagedBy
--   Values ('00000006', '00000005','FW Wonderland','20190707 20:30');
-- Insert into Reservation_linkedTo_ManagedBy
--   Values ('00000007', '00000006','FW Fantasmic','20190715 20:30');

-- Insert into Madeby
--   Values ('00000001', 'A Mild Trip');
-- Insert into Madeby
--   Values ('00000002', 'G2 Customized');
-- Insert into Madeby
--   Values ('00000003', 'Happy Summer');
-- Insert into Madeby
--   Values ('00000004', 'Really Exciting');
-- Insert into Madeby
--   Values ('00000005', 'A Mild Trip');
-- Insert into Madeby
--   Values ('00000006', 'G6 Customized');



-- Insert into AdultVisitor_include
--   Values ('Stacy Salter', '00000001','666-1111-0011');
-- Insert into AdultVisitor_include
--   Values ('Eileen Fan', '00000002','666-1111-1100');
-- Insert into AdultVisitor_include
--   Values ('Jose Li', '00000002','666-1111-2200');
-- Insert into AdultVisitor_include
--   Values ('Crystal May', '00000002','666-1111-4400');
-- Insert into AdultVisitor_include
--   Values ('Angle Chen', '00000003','666-3333-7788');
-- Insert into AdultVisitor_include
--   Values ('Crystal May', '00000004','666-3333-9999');
-- Insert into AdultVisitor_include
--   Values ('Tom White', '00000005','666-5555-0011');
-- Insert into AdultVisitor_include
--   Values ('Sean Chen', '00000006','666-9988-0066');
-- Insert into AdultVisitor_include
--   Values ('Angle Chen', '00000006','666-9988-0099');

 


-- Insert into YoungVisitor_include_isGuradedBy
--   Values ('Angeline Salter', '00000001','Stacy Salter','00000001');
-- Insert into YoungVisitor_include_isGuradedBy
--   Values ('Sean Salter', '00000001','Stacy Salter','00000001');
-- Insert into YoungVisitor_include_isGuradedBy
--   Values ('John Li', '00000002','Eileen Fan','00000002');
-- Insert into YoungVisitor_include_isGuradedBy
--   Values ('Fred Li', '00000002','Jose Li','00000002');
-- Insert into YoungVisitor_include_isGuradedBy
--   Values ('Stacy White', '00000005','Tom White','00000005');


commit;
