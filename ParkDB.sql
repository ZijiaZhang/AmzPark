CREATE TABLE MaintenanceFacility( 
	name char(64) PRIMARY KEY,
	contactInfo char(64)
);

CREATE TABLE Administrator(
	admID integer PRIMARY KEY,
	name char(64),
	contactInfo char(64),
	duty char(64)

);

CREATE TABLE Attractions_InsepectAndDeterminesStatus(
	attName char(64) PRIMARY KEY,
	location char(64), 
	expectedWaitingTime integer, 
	capacity integer, 
	status char(64), 
	restriction char(64), 
	closeTime time, 
	openTime time,
	admID integer FOREIGN KEY REFERENCES Administrator ON DELETE NO ACTION
);

CREATE TABLE Repair (
	maintenanceFacilityName char(64) FOREIGN KEY REFERENCES MaintenanceFacility ON DELETE NO ACTION, 
	attName char(64) FOREIGN KEY REFERENCES Attractions_InsepectAndDeterminesStatus, 
	date date,
	PRIMARY KEY(maintenanceFacilityName,attName)
);

CREATE TABLE Entertainments_DetermineStatusAndArrangeTimes(
	entName char(64), 
	location char(64), 
	date date, 
	beginTime time, 
	endTime time, 
	duration integer, 
	status char(64), 
	price integer,
	admID integer FOREIGN KEY REFERENCES Administrator ON DELETE NO ACTION,
	PRIMARY KEY(entName, date,beginTime)
);

CREATE TABLE Fireworks (
	name char(64) PRIMARY KEY,
	theme char(64)
);

CREATE TABLE LiveShows(
	name char(64) PRIMARY KEY,
	performers char(64),
	category char(64)
);


CREATE TABLE Plan (
	planNumbr integer PRIMARY KEY
);

CREATE TABLE ofVisiting (
	planNumbr integer FOREIGN KEY REFERENCES Plan, 
	attName char(64) FOREIGN KEY REFERENCES Attractions_InsepectAndDeterminesStatus,
	PRIMARY KEY(planNumbr,attName)
);


CREATE TABLE VGroup (
	groupID integer,
	size integer,
	Password char(64)
);

CREATE TABLE Reservation_linkedTo_ManagedBy (
	confirmNumber integer PRIMARY KEY,
	entertainment_date date, 
	entertainment_BeginTime time, 
	entetainment_Name char(64),
	FOREIGN KEY (entertainment_date,entertainment_BeginTime,entetainment_Name) REFERENCES Entertainments_DetermineStatusAndArrangeTimes(date, beginTime, entName) 
	groupID integer FOREIGN KEY REFERENCES VGroup
);

CREATE TABLE MakePlan (
	groupID integer FOREIGN KEY REFERENCES VGroup,
	planNumbr integer FOREIGN KEY REFERENCES Plan
);

CREATE TABLE YoungVisitor_include (
	visitorName char(64), 
	groupID: integer FOREIGN KEY REFERENCES VGroup,
	PRIMARY KEY (visitorName,groupID)
);

CREATE TABLE AdultVisitor_include (
	visitorName char(64), 
	groupID integer, 
	contactInfo char(64),
	PRIMARY KEY (visitorName,groupID)
);

CREATE TABLE Guarde (
	youngVisitorName char(64) , 
	youngGroupID integer, 
	adultVisitorName char(64), 
	adultGroupID integer,
	FOREIGN KEY (youngVisitorName char(64), youngGroupID integer) REFERENCES YoungVisitor_include(visitorName, groupID),
	FOREIGN KEY (adultVisitorName char(64), adultGroupID integer) REFERENCES YoungVisitor_include(visitorName, groupID),
	PRIMARY KEY (youngVisitorName, youngGroupID, adultVisitorName, adultGroupID)
);






