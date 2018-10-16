USE pta
;

UPDATE clients SET nom_societe = 'KOUNI Global', note = 'TEST' WHERE idClient = 1;
UPDATE transports SET telephone = '01.02.03.04.05' WHERE idTransport = 3;

SELECT *
FROM clients
;

SELECT *
FROM transports
;