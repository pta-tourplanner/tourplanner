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