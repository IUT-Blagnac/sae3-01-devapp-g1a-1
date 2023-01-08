CREATE OR REPLACE PROCEDURE addToOrder (
p_order Commandes.refcommande%TYPE,
p_prod Produits.refproduit%TYPE,
p_quantite Constituer.quantite%TYPE
)
IS
fk_erreur EXCEPTION;
PRAGMA EXCEPTION_INIT(fk_erreur, -2291);
ck_erreur EXCEPTION;
PRAGMA EXCEPTION_INIT(ck_erreur, -2290);
BEGIN
	INSERT INTO Constituer
	VALUES (p_order, p_prod, p_quantite);
	COMMIT;
EXCEPTION
	WHEN ck_erreur THEN
		DBMS_OUTPUT.PUT_LINE('erreur de contrainte check');
	WHEN fk_erreur THEN
		DBMS_OUTPUT.PUT_LINE('erreur de clé étrangère');
	WHEN DUP_VAL_ON_INDEX THEN
		DBMS_OUTPUT.PUT_LINE('erreur de clé primaire');
END;
/