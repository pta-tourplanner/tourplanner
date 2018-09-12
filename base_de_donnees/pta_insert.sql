USE pta
;

DELETE
FROM clients
where idClient <> 0
;

DELETE
FROM lieux
where idLieu <> 0
;

DELETE
FROM transports
where idTransport <> 0
;

INSERT INTO clients VALUES(1, 'Kouni Global', '27 rue de Tolbiac', 75013, 'Paris', 'Ile-de-France', '', 'http://www.gta-travel.com', '01.53.94.76.09', '', '');
INSERT INTO clients VALUES(2, 'Miki Travel Agency', '22 rue Caumartin', 75009, 'Paris', 'Ile-de-France', '', 'http://www.gta-travel.com', '01.44.50.31.31', '01.44.50.31.40', '');
INSERT INTO clients VALUES(3, 'MYU Service', '22 rue Caumartin', 75009, 'Paris', 'Ile-de-France', '', '', '01.44.50.30.05', '01.44.50.55.40', '');

INSERT INTO lieux VALUES(1, 'LE GRAND PARIS', '2, rue Scribe', '75009', 'Paris', 'France', '');
INSERT INTO lieux VALUES(2, 'MERCURE MONTMARTRE', '3 rue Caulaincourt', '75018', 'Paris', 'France', '');
INSERT INTO lieux VALUES(3, 'SCRIBE', '9, rue Scribe', '75001', 'Paris', 'France', '');

INSERT INTO transports VALUES(2, 'CLAMART', '01.55.59.04.50');
INSERT INTO transports VALUES(3, 'PRESTIGE LIMOUSINE', '01.40.43.92.92');
INSERT INTO transports VALUES(10, 'TAXI BY PAX', '');

INSERT INTO saisons VALUES(1, '2018/2019', '2018-03-31', '2018-04-01');

INSERT INTO prestations VALUES('100M', 1, 'AMSS', '03:30:00', 285.3, 150, 'test');
INSERT INTO prestations VALUES('600G', 2, 'MONT ST.MICHEL', '14:00:00', 630.00, 280.00, 'test1');
INSERT INTO prestations VALUES('50TF', 1,  'test', '06:00:00', 65.00, 25.00, '');

INSERT INTO missions VALUES('MIS00001', 1, '100M', '2018-09-10', '6:00:00', 'Miki Travel Agency', 'CONCORDE LOUVRE', 'TRANSCOACH', 'JIL 8213', 'OSA NTA B.YUME', '26+1', 'CONCORDE LE FAYETTE', 'DAE', '01:00:00', '01:00:00', 38, 13.5, 0, 'TEST' );

INSERT INTO tours VALUES('AN4', 'ANA');

INSERT INTO personnes VALUES(1, 'HIGA', 'Tsunehito', 'Mr', 'Administrateur', '', '75002', '', '', 'test@gmail.com', '', '', '');

INSERT INTO comptes VALUES(1, 'test', '', 1);