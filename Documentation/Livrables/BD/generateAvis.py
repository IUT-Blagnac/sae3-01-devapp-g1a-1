import os
from random import *

SORTIE = "out.sql"

voy = ['a', 'e', 'i', 'o', 'u', 'y']
cons = [ 'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'z']
lettre = voy+cons
lettre.append(' ')

def generateNote():
    return str(randint(0,5))

def generateText():
    text = ""
    for i in range(50):
        text += lettre[randint(0,len(lettre)-1)]
    return text

def generateDate():
    j = str(randint(1,28))
    m = str(randint(1,12))
    a = str(randint(1970, 2022))
    return j+"/"+m+"/"+a

def generateIdProd():
    refs = ["Tapis-0", "Balai-0"]
    return refs[randint(0, 1)] + str(randint(1, 5)) + str(randint(1,6))

def generateAvis():
    text = generateText()
    note = generateNote()
    dte = generateDate()
    idc = str(randint(1,56))
    idprod = generateIdProd()
    return "INSERT INTO Commenter\nVALUES (\"SEQ_Avis\".NEXTVAL, '" + text +"', "+ note +", '"+ dte +"', "+ idc +", '"+ idprod + "');\n"

out = os.open(SORTIE, os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
for i in range(56):
    os.write(out, bytes(generateAvis(), 'utf-8'))
os.close(out)
print("done")