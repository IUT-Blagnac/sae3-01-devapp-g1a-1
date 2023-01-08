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

def generatePhone():
    if randint(0,1) == 0:
        phone = "06"
    else:
        phone = "07"
    for i in range(8):
        phone += str(randint(0, 9))

    return phone

def generateMail(name, surname):
    return name + "." + surname + "@gmail.com"

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

def generateHash():
    hash = ""
    for i in range(32):
        hash += str(randint(0,9))
    return hash

def generateInsertClients():
    nom = generateName(4, 8)
    prenom = generateName(3, 8)
    tel = generatePhone()
    mail = generateMail(prenom, nom)
    adr = generateAddress()
    hash = generateHash()
    v = "', '"
    return "INSERT INTO Clients\nVALUES (\"SEQ_Clients\".NEXTVAL, '" + nom +v+ prenom +v+ tel +v+ mail +v+ adr[0] +v+ adr[1] +v+ adr[2] +v+ adr[3] +v+ prenom +v+ hash + "', 'N');\n"

out = os.open(SORTIE, os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
for i in range(50):
    os.write(out, bytes(generateInsertClients(), 'utf-8'))
os.close(out)
print("done")