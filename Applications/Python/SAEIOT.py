import paho.mqtt.client as mqtt
import os
import signal
import time
import json
import xmltodict
import datetime
import threading

with open("config.xml") as fd:
    config = xmltodict.parse(fd.read())
    
config = config["config"]

toDraw = config["toDraw"]
max = config["max"]
min = config["min"]
timeSleep = int(config["timeSleep"])

dataTable = {}

for v in toDraw:
    dataTable[v] = 0

client = mqtt.Client("SAE_G1A-1")

def on_message(client, userdata, message):
    
    print("message")
    
    out = os.open(str(config["outFolder"]) + "/" + "LastMessageTime.dce", os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
    os.write(out, bytes(str(datetime.datetime.now()), 'utf-8'))
    os.close(out)
    
    data = json.loads(message.payload.decode("utf-8"))
    data = data["object"]

    for v in toDraw:
        dataTable[v] = data[v]

    # print("message topic=",message.topic)
    # print("message qos=",message.qos)
    # print("message retain flag=",message.retain)


def saveData() :
    print("saving data")
    for test in toDraw:
        if toDraw[test] == "True":
            out = os.open(str(config["outFolder"]) + "/" + str(test)+".dce", os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
            os.write(out, bytes(str(dataTable[test]), 'utf-8'))
            os.close(out)

            if dataTable[test] >= int(max[test]) or dataTable[test] <= int(min[test]):
                out = os.open(str(config["outFolder"]) + "/alerte" + str(test) + ".dce", os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
                os.write(out, bytes(str(dataTable[test]) + ":" + str(datetime.datetime.now()), 'utf-8'))
                os.close(out)

def set_interval(fonction, temps):
    def func_wrapper():
        set_interval(fonction, temps)
        fonction()
    t = threading.Timer(temps, func_wrapper)
    t.start()
    return t

set_interval(saveData, int(config["frec"]))

client.connect(config["server"])
client.subscribe("application/" + config["app"] + "/device/" + config["device"] + "/event/up")
client.on_message=on_message
client.loop_start()

time.sleep(timeSleep)

client.loop_stop()