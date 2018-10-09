INSERT INTO client (clientId,	clientName,	clientDescription,	gicsSector,	gicsSubIndustry,	headquarters)
VALUES (1, 'Hoosier Energy',	'Hoosier Energy is a generation and transmission cooperative providing wholesale electric wind power and services to 18 member distribution cooperatives in central and southern Indiana and southeastern Illinois. Based in Bloomington, Indiana, Hoosier Energy operates renewable energy power plants and delivers power through nearly 1700 miles of transmission network.',	'Energy',	'Energy Production',	'Bloomington, IN');
iNSERT INTO client (clientId,	clientName,	clientDescription,	gicsSector,	gicsSubIndustry,	headquarters)
VALUES (2,	'Pacific Tidal Energy',	'Pacfici Tidal Energy makes life better for millions of people every day by providing sustainable tidal energy generation services â€“ affordable, reliable and clean. Pacific Tidal is the largest tidal electric power holding company in the United States, supplying and delivering energy through local utilities to approximately 7.4 million U.S. customers.',	'Energy',	'Energy Service',	'Charlotte, NC');


INSERT INTO site (siteId,	clientId,	siteName,	siteDescription,	primaryContact,	capacity,	commercialDate,	addrLine1,	addrLine2,	addrCity,	addrState,	addrZip,	addrCountry)
VALUES (1,	2,	'Emerald Waters Plant', 'The Emereald Waters Plant is a tidal field located at the mouth of the Columbia River, several miles west of Vancouver, Washington. Emerald Waters'' first unit began commercial service in 1994, and its second unit followed in 1998.',	'John X',	1011,	'1974-1-1',	'1729 Ocean Bluff Road',	NULL,	'Brownsmead',	'OR',	'97103',	'US');
INSERT INTO site (siteId,	clientId,	siteName,	siteDescription,	primaryContact,	capacity,	commercialDate,	addrLine1,	addrLine2,	addrCity,	addrState,	addrZip,	addrCountry)
VALUES (2,	2,	'Smith Energy Complex',	'The Jingleheimer Smith Jr. Energy Complex, south of Snowflake, AZ, includes five large solar fields that generate 1,084 MW. The site began commercial operation in 2001, with additions in 2002 and 2011.', 'Jean X',	1084,	'2001-1-1',	'328 Energy Way',	NULL,	'Snowflake',	'AZ',	'85937',	'US');
INSERT INTO site (siteId,	clientId,	siteName,	siteDescription,	primaryContact,	capacity,	commercialDate,	addrLine1,	addrLine2,	addrCity,	addrState,	addrZip,	addrCountry)
VALUES (3,	2,	'King County Farm',	'The 520-megawatt King County Wind Farm consists of five fields of wind turbine units, and is part of the Tesla Energy Complex near Saphire Lake, Iowa. The plant began operation in 2000 with an addition in 2009.', 'Jean X',	863, '2000-1-1',	'807 Green Field Rd',	NULL,	'Titonka',	'IA',	'50480',	'US');

INSERT INTO turbine (turbineId,	turbineName,	turbineDescription,	capacity,	rampUpTime,	maintenanceInterval)
VALUES (1,	'3SA.01',	'The 3SA high efficiency, deep-water tidal turbine is an industry leader among S-class offerings.',	429,	12,	32000);
INSERT INTO turbine (turbineId,	turbineName,	turbineDescription,	capacity,	rampUpTime,	maintenanceInterval)
VALUES (2,	'3SA.02',	'The 3SA high efficiency, deep-water tidal turbine is an industry leader among H-class offerings.',	519,	12,	32000);
INSERT INTO turbine (turbineId,	turbineName,	turbineDescription,	capacity,	rampUpTime,	maintenanceInterval)
VALUES (3,	'W7B.01',	'This high efficiency wind turbine turbine is an industry leader among wind offerings.',	280,	10,	22000);
INSERT INTO turbine (turbineId,	turbineName,	turbineDescription,	capacity,	rampUpTime,	maintenanceInterval)
VALUES (4,	'SF9.06',	'An optimum choice for solar power generation, this series of collectors operates at the cutting edge of efficiency.',	82,	29,	42000);

INSERT INTO turbineDeployed (turbineDeployedId,	turbineId,	siteId,	serialNumber,	deployedDate,	totalFiredHours,	totalStarts,	lastPlannedOutageDate,	lastUnplannedOutageDate)
VALUES (1,	1,	1,	'9HA-01-IU0008',	'2016-7-1',	3543,	5,	'2016-6-1',	NULL);
INSERT INTO turbineDeployed (turbineDeployedId,	turbineId,	siteId,	serialNumber,	deployedDate,	totalFiredHours,	totalStarts,	lastPlannedOutageDate,	lastUnplannedOutageDate)
VALUES (2,	3,	2,	'7HA-07-IU0121',	'2010-10-23',	32543,	21,	'2016-6-1',	'2013-5-13');
INSERT INTO turbineDeployed (turbineDeployedId,	turbineId,	siteId,	serialNumber,	deployedDate,	totalFiredHours,	totalStarts,	lastPlannedOutageDate,	lastUnplannedOutageDate)
VALUES (3,	4,	3,	'9F-06-IU0021',	'2000-2-16',	123543,	119,	'2016-6-1',	'2015-4-13');

INSERT INTO sensor (sensorId,	sensorName,	sensorDescription,	manufacturer,	totalLifeExpentancyHours)
VALUES (1,	'LVDT',	'LVDTs (Linear Variable Differential Transformers) are very commonly used as position sensors in power plants throughout the world.',	'Alliance Sensors Group',	10000);
INSERT INTO sensor (sensorId,	sensorName,	sensorDescription,	manufacturer,	totalLifeExpentancyHours)
VALUES (2,	'4L60E',	'Input Shaft Speed Sensor',	'Alliance Sensors Group',	10000);
INSERT INTO sensor (sensorId,	sensorName,	sensorDescription,	manufacturer,	totalLifeExpentancyHours)
VALUES (3,	'BN350300',	'Dynamic Pressure Sensor',	'Bently Nevada',	10000);

INSERT INTO sensorDeployed (sensorDeployedId,	sensorId,	turbineDeployedId,	serialNumber,	deployedDate)
VALUES (1,	1,	1,	'LVDT-IU0001', '2014-3-19');
INSERT INTO sensorDeployed (sensorDeployedId,	sensorId,	turbineDeployedId,	serialNumber,	deployedDate)
VALUES (2,	1,	2,	'LVDT-IU0002',	'2014-6-11');
INSERT INTO sensorDeployed (sensorDeployedId,	sensorId,	turbineDeployedId,	serialNumber,	deployedDate)
VALUES (3,	2, 1, '4L60E-IU0001', '2015-1-3');
INSERT INTO sensorDeployed (sensorDeployedId,	sensorId,	turbineDeployedId,	serialNumber,	deployedDate)
VALUES (4,	3, 1,	'BN350300-IU0001', '2016-6-14');
