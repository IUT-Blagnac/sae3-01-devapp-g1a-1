
DROP SEQUENCE "SAEBD01"."SEQ_Clients";
CREATE SEQUENCE "SAEBD01"."SEQ_Clients" MINVALUE 1 MAXVALUE 999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER NOCYCLE;
DROP SEQUENCE "SAEBD01"."SEQ_Avis";
CREATE SEQUENCE "SAEBD01"."SEQ_Avis" MINVALUE 1 MAXVALUE 999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER NOCYCLE;
DROP SEQUENCE "SAEBD01"."SEQ_CB";
CREATE SEQUENCE "SAEBD01"."SEQ_CB" MINVALUE 1 MAXVALUE 999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER NOCYCLE;

INSERT INTO Clients
VALUES ("SEQ_Clients".NEXTVAL, 'Bophare', 'Marin', '0648951742', 'marin.bophare@gmail.com', '3', 'route des lucioles', '31000', 'Toulouse', 'Marin', 'hash', 'O');
INSERT INTO Clients
VALUES ("SEQ_Clients".NEXTVAL, 'Narva', 'Lo', '0648512974', 'narva.lo@gmail.com', '45', 'rue Fleurette', '31000', 'Toulouse', 'Lo', 'hash', 'O');
INSERT INTO Clients
VALUES ("SEQ_Clients".NEXTVAL, 'Walter', 'Seb', '0781469582', 'seb.walter@gmail.com', '78', 'avenue Victor Hugo', '31000', 'Toulouse', 'Seb', 'hash', 'O');
INSERT INTO Clients
VALUES ("SEQ_Clients".NEXTVAL, 'Tavares', 'Raymond', '0174568219', 'tavares.raymond@gmail.com', '1', 'impasse des absents', '31293', 'Lespinasse', 'Raymond', 'hash', 'O');
INSERT INTO Clients
VALUES ("SEQ_Clients".NEXTVAL, 'Lutin', 'Jacques', '0715286493', 'jl.annonce@gmail.com', '5', 'route des lucioles', '31000', 'Toulouse', 'Jacques', 'hash', 'N');
INSERT INTO Clients
VALUES ("SEQ_Clients".NEXTVAL, 'Lagrande', 'Aufélie', '0947856418', 'aufe.lg@gmail.com', '74', 'route de grasse', '06600', 'Antibes', 'Aufélie', 'hash', 'N');
