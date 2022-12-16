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

def generateNumCB():
    num = ""
    for i in range(16):
        num += str(randint(0,9))
    return num

def generateCB(idC):
    nom = generateName(4, 8)
    prenom = generateName(4, 8)
    num = generateNumCB()
    return "INSERT INTO CB\nVALUES (\"SEQ_CB\".NEXTVAL, " + num +", '" + nom + "', '" + prenom + "', " + idC + ");\n"

out = os.open(SORTIE, os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
for i in range(56):
    os.write(out, bytes(generateCB(str(i+1)), 'utf-8'))
os.close(out)
print("done")