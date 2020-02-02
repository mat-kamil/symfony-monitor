create database "skyMonitor";
use "skyMonitor";

CREATE TABLE ingestData
(
    id INTEGER AUTO_INCREMENT,
    timestamp timestamp,
    cpuLoad tinyint(3) not null,
    concurrency double not null,
    PRIMARY KEY (id),
    INDEX (timestamp),
    INDEX (cpuLoad, concurrency)
) COMMENT='created table ingestData';

