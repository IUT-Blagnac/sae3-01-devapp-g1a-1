import paho.mqtt.client as mqtt
import os
import signal
import time
import json
import xmltodict
import datetime

with open("config.xml") as fd:
    config = xmltodict.parse(fd.read())
    
config = config["config"]

toDraw = config["toDraw"]
max = config["max"]
min = config["min"]
timeSleep = int(config["timeSleep"])

client = mqtt.Client("SAE_G1A-1")

def on_message(client, userdata, message):
    
    print("message")
    
    out = os.open(str(config["outFolder"]) + "/" + "LastMessageTime.dce", os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
    os.write(out, bytes(str(datetime.datetime.now()), 'utf-8'))
    os.close(out)
    
    data = json.loads(message.payload.decode("utf-8"))
    data = data["object"]

    for test in toDraw:
        if toDraw[test] == "True":
            out = os.open(str(config["outFolder"]) + "/" + str(test)+".dce", os.O_CREAT | os.O_TRUNC | os.O_WRONLY)
            
            os.write(out, bytes(str(data[test]), 'utf-8'))
            if data[test] >= int(max[test]) :
                os.write(out, bytes("\nmax", 'utf-8'))
            if data[test] <= int(min[test]) :
                os.write(out, bytes("\nmin", 'utf-8'))
            os.close(out)

    # print("message topic=",message.topic)
    # print("message qos=",message.qos)
    # print("message retain flag=",message.retain)


client.connect(config["server"])
client.subscribe("application/" + config["app"] + "/device/" + config["device"] + "/event/up")
client.on_message=on_message
client.loop_start()

time.sleep(timeSleep)

client.loop_stop()