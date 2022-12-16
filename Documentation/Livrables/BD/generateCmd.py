import os
from random import *

SORTIE = "out.sql"

voy = ['a', 'e', 'i', 'o', 'u', 'y']
cons = [ 'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'z']

def generateName(min, max):
    size = randint(min, max)
    start = randrange(1,2)
    name = ""
    for i in range (size):
        if (start+i)%2 == 0:
            name += voy[randint(0,5)]
        else:
            name += cons[randint(0,19)]

    return name

def generateAddress():
    num = str(randint(1, 100))
    rand = randint(0,2)
    if rand == 0:
        nom = "Route de "
    elif rand == 1:
        nom = "Avenue "
    elif rand == 2:
        nom = "Rue "
    nom += generateName(4,6) + " " + generateName(4,6)
    cdp = str(randint(10000, 99999))
    ville = generateName(5, 10)
    add = [num, nom, cdp, ville]
    return add

def generateRefCMD():
    return "CMD-" + str(randint(111,999))

def generateIdProd():
    refs = ["Tapis-0", "Balai-0"]
    return refs[randint(0, 1)] + str(randint(1, 5)) + str(randint(1,6))

def generateCMD(idc):
    ref = generateRefCMD()
    adr = generateAddress()
    res = "INSERT INTO Commandes\nVALUES ('" + ref + "', " + adr[0] + ", '" + adr[1] + "', '" + adr[2] + "', '" + adr[3] + "', " + str(idc) + ", " + str(idc) + ");\n"
    prod = generateIdProd()
    res += "INSERT INTO Constituer\nVALUES ('" + ref + "', '" + prod + "', " + str(randint(1, 10)) + ");\n"
    return res

out = os.open(SORTIE, os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
for i in range(5,57):
    os.write(out, bytes(generateCMD(i), 'utf-8'))
os.close(out)
print("done")
