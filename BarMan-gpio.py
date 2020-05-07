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

def init_GPIO():
    #init GPIO
    GPIO.setmode(GPIO.BCM)

    #Port 1
    GPIO.setup(17, GPIO.OUT)
    #Port 2
    GPIO.setup(22, GPIO.OUT)
    #Port 3
    GPIO.setup(5, GPIO.OUT)
    #Port 4
    GPIO.setup(6, GPIO.OUT)
    #Port 5
    GPIO.setup(13, GPIO.OUT)
    #Port 6
    GPIO.setup(26, GPIO.OUT)
    #Port 7
    GPIO.setup(23, GPIO.OUT)
    #Port 8
    GPIO.setup(24, GPIO.OUT)
    
def set_GPIO_OFF():
    GPIO.output(17, GPIO.LOW)
    GPIO.output(22, GPIO.LOW)
    GPIO.output(5, GPIO.LOW)
    GPIO.output(6, GPIO.LOW)
    GPIO.output(13, GPIO.LOW)
    GPIO.output(26, GPIO.LOW)
    GPIO.output(23, GPIO.LOW)
    GPIO.output(24, GPIO.LOW)
    

port = int(sys.argv[1])
init_GPIO()
set_GPIO_OFF()

if port == 1:
    set_GPIO_OFF()
	GPIO.output(17, GPIO.HIGH)
    print("PORT 1 - ON")
elif port == 2:
    set_GPIO_OFF()
	GPIO.output(22, GPIO.HIGH)
    print("PORT 2 - ON")
elif port == 3:
    set_GPIO_OFF()
	GPIO.output(5, GPIO.HIGH)
    print("PORT 3 - ON")
elif port == 4:
    set_GPIO_OFF()
	GPIO.output(6, GPIO.HIGH)
    print("PORT 4 - ON")
elif port == 5:
    set_GPIO_OFF()
	GPIO.output(13, GPIO.HIGH)
    print("PORT 5 - ON")
elif port == 6:
    set_GPIO_OFF()
	GPIO.output(26, GPIO.HIGH)
    print("PORT 6 - ON")
elif port == 7:
    set_GPIO_OFF()
	GPIO.output(23, GPIO.HIGH)
    print("PORT 7 - ON")
elif port == 8:
	set_GPIO_OFF()
	GPIO.output(24, GPIO.HIGH)
    print("PORT 8 - ON")
else:
	set_GPIO_OFF()
    print("ALL PORTS LOW")