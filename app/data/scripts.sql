DROP TABLE IF EXISTS client;

CREATE TABLE client (
  clientId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  clientName VARCHAR(50),
  clientDescription VARCHAR(500),
  gicsSector VARCHAR(30),
  gicsSubIndustry VARCHAR(30),
  headquarters VARCHAR(30)
);

DROP TABLE IF EXISTS site;

CREATE TABLE site (
  siteId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  clientId INT REFERENCES client(clientId),
  siteName VARCHAR(50),
  siteDescription VARCHAR(500),
  primaryContact VARCHAR(30),
  capacity INT,
  commercialDate DATETIME,
  addrLine1 VARCHAR(50),
  addrLine2 VARCHAR(50),
  addrCity VARCHAR(30),
  addrState VARCHAR(2),
  addrZip VARCHAR(5),
  addrCountry VARCHAR(3)
);

DROP TABLE IF EXISTS turbine;

CREATE TABLE turbine (
  turbineId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  turbineName VARCHAR(10),
  turbineDescription VARCHAR(500),
  primaryContact VARCHAR(30),
  capacity INT,
  rampUpTime INT,
  maintenanceInterval INT
);

DROP TABLE IF EXISTS turbineDeployed;

CREATE TABLE turbineDeployed (
  turbineDeployedId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  turbineId INT REFERENCES turbine(turbineId),
  siteId INT REFERENCES site(siteId),
  serialNumber VARCHAR(15),
  deployedDate DATETIME,
  totalFiredHours INT,
  totalStarts INT,
  lastPlannedOutageDate DATETIME,
  lastUnplannedOutageDate DATETIME
);


DROP TABLE IF EXISTS sensor;

CREATE TABLE sensor (
  sensorId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  sensorName VARCHAR(15),
  sensorDescription VARCHAR(300),
  primaryContact VARCHAR(30),
  manufacturer VARCHAR(40),
  totalLifeExpentancyHours INT
);


DROP TABLE IF EXISTS sensorDeployed;

CREATE TABLE sensorDeployed (
  sensorDeployedId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  sensorId INT REFERENCES sensor(sensorId),
  turbineDeployedId INT REFERENCES turbineDeployed(turbineDeployedId),
  serialNumber VARCHAR(30),
  deployedDate DATETIME
);

DROP TABLE IF EXISTS sensorTimeSeries;

CREATE TABLE sensorTimeSeries (
  sensorDeployedId INT REFERENCES sensorDeployed(sensorDeployedId),
  dataCollectedDate DATETIME,
  output DEC(15,7),
  output DEC(30,11),
  compressorEfficiency DEC(15,8),
  availability DEC(15,8),
  reliability DEC(15,8),
  firedHours DEC(15,8),
  trips INT,
  starts INT
);
