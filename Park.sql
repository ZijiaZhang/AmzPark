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
	closeTime char(10), 
	openTime char(10),
	admID integer NOT NULL,
	FOREIGN KEY (admID) REFERENCES Administrator(admID)
);

CREATE TABLE Repair (
	maintenanceFacilityName char(64), 
	attName char(64), 
	Rdate date,
    FOREIGN KEY (maintenanceFacilityName) REFERENCES MaintenanceFacility(name),
    FOREIGN KEY (attName) REFERENCES Attractions_InsepectAndDeterminesStatus (attName) ON DELETE CASCADE,
	PRIMARY KEY(maintenanceFacilityName,attName)
);

CREATE TABLE Entertainments_DetermineStatusAndArrangeTimes(
	entName char(64), 
	location char(64), 
	Edate date, 
	beginTime char(10), 
	endTime char(10), 
	duration integer, 
	status char(64), 
	price integer,
	admID integer NOT NULL,
    FOREIGN KEY (admID) REFERENCES Administrator(admID),
	PRIMARY KEY(entName, Edate,beginTime)
);

CREATE TABLE Fireworks (
	entName char(64), 
	Edate date, 
	beginTime char(10), 
	theme char(64)，
	FOREIGN KEY (entName,Edate,beginTime) REFERENCES Entertainments_DetermineStatusAndArrangeTimes(entName, Edate,beginTime),
	PRIMARY KEY(entName, Edate,beginTime)
);

CREATE TABLE LiveShows(
	entName char(64), 
	Edate date, 
	beginTime char(10), 
	performers char(64),
	category char(64),
	FOREIGN KEY (entName,Edate,beginTime) REFERENCES Entertainments_DetermineStatusAndArrangeTimes(entName, Edate,beginTime),
	PRIMARY KEY(entName, Edate,beginTime)
);


CREATE TABLE Plan (
	planNumber integer PRIMARY KEY
);

CREATE TABLE ofVisiting (
	planNumber integer, 
	attName char(64),
    FOREIGN KEY (planNumber) REFERENCES Plan(planNumber) ON DELETE CASCADE,
    FOREIGN KEY (attName) REFERENCES Attractions_InsepectAndDeterminesStatus(attName) ON DELETE CASCADE,
	PRIMARY KEY(planNumber,attName)
);


CREATE TABLE VGroup (
	groupID integer PRIMARY KEY,
	Gsize integer,
	Password char(64)
);

CREATE TABLE Reservation_linkedTo_ManagedBy (
	confirmNumber integer PRIMARY KEY,
	entertainment_date date NOT NULL, 
	entertainment_BeginTime char(10) NOT NULL, 
	entetainment_Name char(64) NOT NULL,
	FOREIGN KEY (entetainment_Name,entertainment_date,entertainment_BeginTime) REFERENCES Entertainments_DetermineStatusAndArrangeTimes(entName, Edate,beginTime) ON DELETE CASCADE,
	groupID integer NOT NULL,
    FOREIGN KEY (groupID) REFERENCES VGroup(groupID) ON DELETE CASCADE
);

CREATE TABLE MakePlan (
	groupID integer,
	planNumber integer,
    FOREIGN KEY (groupID) REFERENCES VGroup(groupID) ON DELETE CASCADE,
    FOREIGN KEY (planNumber) REFERENCES Plan(planNumber)
);

CREATE TABLE YoungVisitor_include (
	visitorName char(64), 
	groupID integer NOT NULL,
    FOREIGN KEY (groupID) REFERENCES VGroup(groupID) ON DELETE CASCADE,
	PRIMARY KEY (visitorName,groupID)
);

CREATE TABLE AdultVisitor_include (
	visitorName char(64), 
	groupID integer NOT NULL, 
	contactInfo char(64),
	PRIMARY KEY (visitorName,groupID),
	FOREIGN KEY (groupID) REFERENCES VGroup(groupID) ON DELETE CASCADE
);

CREATE TABLE Guarde (
	youngVisitorName char(64) , 
	youngGroupID integer, 
	adultVisitorName char(64), 
	adultGroupID integer,
	FOREIGN KEY (youngVisitorName, youngGroupID) REFERENCES YoungVisitor_include(visitorName, groupID) ON DELETE CASCADE,
	FOREIGN KEY (adultVisitorName, adultGroupID) REFERENCES YoungVisitor_include(visitorName, groupID),
	PRIMARY KEY (youngVisitorName, youngGroupID, adultVisitorName, adultGroupID)
);



INSERT INTO Administrator Values (1,'Gary', 'abcd@gmail.com', 'Responsible for C Part');
INSERT INTO Attractions_InsepectAndDeterminesStatus Values ('Ferris Wheel','C99', 20, 50,'Open',NULL,'17:00:00','9:00:00',1);
INSERT INTO Attractions_InsepectAndDeterminesStatus Values ('Roller Coaster','C2', 30, 20,'Open',NULL,'17:00:00','9:00:00',1);



