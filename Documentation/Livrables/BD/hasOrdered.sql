CREATE OR REPLACE FUNCTION hasOrdered (
p_client Clients.idClient%TYPE,
p_produit Produits.refProduit%TYPE
)
RETURN BOOLEAN
IS
v_quantite Constituer.quantite%TYPE;
BEGIN

SELECT DISTINCT quantite into v_quantite
FROM Constituer con, Commandes com, Produits pro
WHERE con.refcommande = com.refcommande
AND con.refproduit = p_produit
AND com.idclient = p_client;

IF (v_quantite IS NOT NULL) THEN
	RETURN TRUE;
ELSE 
	RETURN FALSE;
END IF;
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        RETURN FALSE;
END hasOrdered;
/