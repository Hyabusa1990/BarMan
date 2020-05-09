#!/usr/bin/python3
#################################################
#               Project BarMan                  #
#-----------------------------------------------#
# Pyton Script to control GPIO Pins             #
#===============================================#
# Autor: Gero Gras                              #
# License: GPL                                  #
#################################################
import RPi.GPIO as GPIO
import sys;

PUMP1 = 5
PUMP2 = 6
PUMP3 = 13
PUMP4 = 19
PUMP5 = 26
PUMP6 = 21
PUMP7 = 20
PUMP8 = 16

def init_GPIO():
    #init GPIO
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BCM)

    #Port 1
    GPIO.setup(PUMP1, GPIO.OUT)
    #Port 2
    GPIO.setup(PUMP2, GPIO.OUT)
    #Port 3
    GPIO.setup(PUMP3, GPIO.OUT)
    #Port 4
    GPIO.setup(PUMP4, GPIO.OUT)
    #Port 5
    GPIO.setup(PUMP5, GPIO.OUT)
    #Port 6
    GPIO.setup(PUMP6, GPIO.OUT)
    #Port 7
    GPIO.setup(PUMP7, GPIO.OUT)
    #Port 8
    GPIO.setup(PUMP8, GPIO.OUT)
    
def set_GPIO_OFF():
    GPIO.output(PUMP1, GPIO.LOW)
    GPIO.output(PUMP2, GPIO.LOW)
    GPIO.output(PUMP3, GPIO.LOW)
    GPIO.output(PUMP4, GPIO.LOW)
    GPIO.output(PUMP5, GPIO.LOW)
    GPIO.output(PUMP6, GPIO.LOW)
    GPIO.output(PUMP7, GPIO.LOW)
    GPIO.output(PUMP8, GPIO.LOW)
    
if len(sys.argv) > 1:
    port = int(float(sys.argv[1]))
else:
    port = 0

init_GPIO()
set_GPIO_OFF()

if port == 1:
    set_GPIO_OFF()
    GPIO.output(PUMP1, GPIO.HIGH)
    print("PORT 1 - ON")
elif port == 2:
    set_GPIO_OFF()
    GPIO.output(PUMP2, GPIO.HIGH)
    print("PORT 2 - ON")
elif port == 3:
    set_GPIO_OFF()
    GPIO.output(PUMP3, GPIO.HIGH)
    print("PORT 3 - ON")
elif port == 4:
    set_GPIO_OFF()
    GPIO.output(PUMP4, GPIO.HIGH)
    print("PORT 4 - ON")
elif port == 5:
    set_GPIO_OFF()
    GPIO.output(PUMP5, GPIO.HIGH)
    print("PORT 5 - ON")
elif port == 6:
    set_GPIO_OFF()
    GPIO.output(PUMP6, GPIO.HIGH)
    print("PORT 6 - ON")
elif port == 7:
    set_GPIO_OFF()
    GPIO.output(PUMP7, GPIO.HIGH)
    print("PORT 7 - ON")
elif port == 8:
    set_GPIO_OFF()
    GPIO.output(PUMP8, GPIO.HIGH)
    print("PORT 8 - ON")
else:
    set_GPIO_OFF()
    print("ALL PORTS LOW")