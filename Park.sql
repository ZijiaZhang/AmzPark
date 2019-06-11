CREATE TABLE MaintenanceFacility (
  name varchar(30) PRIMARY KEY,
  contact_Info varchar(13)
);

CREATE TABLE Administrator (
  adm_ID varchar(6) PRIMARY KEY,
  name varchar(15),
  duty_area varchar(15),
  password varchar(10)
);

CREATE TABLE Administrator_Duty (
  duty_area varchar(15) PRIMARY KEY,
  contact_Info varchar(13)
);

CREATE TABLE Attractions_Insepect_And_Determines_Status (
  att_name varchar(15) PRIMARY KEY,
  location varchar(20),
  capacity varchar(3),
  status varchar(6),
  open_time varchar(5),
  close_time varchar(5),
  adm_ID varchar(6) NOT NULL,
  FOREIGN KEY (adm_ID)
  REFERENCES Administrator(adm_ID)
);

CREATE TABLE Attractions_Capacity (
  capacity varchar(3) PRIMARY KEY,
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
  REFERENCES Attractions_Insepect_And_Determines_Status(att_name)
);

CREATE TABLE Entertainments_Determin_Status (
  name varchar(15),
  location varchar(20),
  perform_time varchar(20),
  status varchar(6),
  price varchar(3),
  adm_ID varchar(3) NOT NULL,
  PRIMARY KEY (name,perform_time),
  FOREIGN KEY (adm_ID)
  REFERENCES Administrator(adm_ID)
);

CREATE TABLE Entertainments_Duration (
  name varchar(15) PRIMARY KEY,
  duration varchar(3)
);

CREATE TABLE Fireworks (
  name varchar(15),
  perform_time varchar(16),
  theme varchar(15),
  PRIMARY KEY (name, perform_time),
  FOREIGN KEY (name, perform_time)
  REFERENCES Entertainments_Determin_Status (name, perform_time)
);

CREATE TABLE LiveShows (
  name varchar(15),
  perform_time varchar(16),
  performers varchar(30),
  category varchar (10),
  PRIMARY KEY(name, perform_time),
  FOREIGN KEY(name, perform_time)
  REFERENCES Entertainments_Determin_Status(name, perform_time)
);

CREATE TABLE Plan (
  plan_Number varchar(2) PRIMARY KEY
);

CREATE TABLE ofVisiting (
  plan_Number varchar(2),
  att_Name varchar(15),
  PRIMARY KEY(plan_Number, att_Name),
  FOREIGN KEY(plan_Number)
  REFERENCES Plan (plan_Number),
  FOREIGN KEY(att_Name)
  REFERENCES Attractions_Insepect_And_Determines_Status(att_name)
);

CREATE TABLE Groups (
  group_ID varchar(3) PRIMARY KEY,
  group_Size varchar(2),
  password varchar(12)
);

CREATE TABLE Reservation_linkedTo_ManagedBy (
  confirm_Number varchar(8) PRIMARY KEY,
  perform_time varchar(16) NOT NULL,
  entertainment_Name varchar(15) NOT NULL,
  group_ID varchar(3) NOT NULL,
  FOREIGN KEY(entertainment_Name, perform_time)
  REFERENCES Entertainments_Determin_Status(name, perform_time)
  ON DELETE CASCADE,
  FOREIGN KEY(group_ID)
  REFERENCES Groups (group_ID)
);

CREATE TABLE Madeby (
  group_ID varchar(3),
  plan_Number varchar(2),
  PRIMARY KEY(group_ID, plan_Number),
  FOREIGN KEY(group_ID)
  REFERENCES Groups(group_ID),
  FOREIGN KEY(plan_Number)
  REFERENCES Plan
);

CREATE TABLE Young_Visitor_Include_Is_Guarded_By (
  young_visitor_name varchar(15),
  young_group_id varchar(3),
  adult_visitor_name varchar(15) NOT NULL,
  adult_group_id varchar(3) NOT NULL,
  FOREIGN KEY (young_group_id)
  REFERENCES Groups (group_ID)
  ON DELETE CASCADE,
  FOREIGN KEY (adult_group_id)
  REFERENCES Groups (group_ID)
  ON DELETE CASCADE
);

CREATE TABLE Adult_Visitor_include (
  visitor_name varchar(15),
  group_id varchar(3),
  contact_Info varchar(13),
  PRIMARY KEY(visitor_name, group_id),
  FOREIGN KEY (group_id)
  REFERENCES Groups
  ON DELETE CASCADE
);
