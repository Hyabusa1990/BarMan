#!/usr/bin/python3
#################################################
#               Project BarMan                  #
#-----------------------------------------------#
# Pyton Scrip fro controling GPIO Pins          #
#===============================================#
# Autor: Gero Gras                              #
# License: GPL                                  #
#################################################
import RPi.GPIO as GPIO
import time
import sys;

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
#Port 8 (Clean)
GPIO.setup(24, GPIO.OUT)

port = int(sys.argv[1]);
time = float(sys.argv[2]);

if port == 1:
	GPIO.output(17, GPIO.HIGH)
	time.sleep(time)
	GPIO.output(17, GPIO.LOW)
    print("PORT 1 - Time",time) 
elif port == 2:
	GPIO.output(22, GPIO.HIGH)
	time.sleep(time)
	GPIO.output(22, GPIO.LOW)
    print("PORT 2 - Time",time)
elif port == 3:
	GPIO.output(5, GPIO.HIGH)
	time.sleep(time)
	GPIO.output(5, GPIO.LOW)
    print("PORT 3 - Time",time)
elif port == 4:
	GPIO.output(6, GPIO.HIGH)
	time.sleep(time)
	GPIO.output(6, GPIO.LOW)
    print("PORT 4 - Time",time)
elif port == 5:
	GPIO.output(13, GPIO.HIGH)
	time.sleep(time)
	GPIO.output(13, GPIO.LOW)
    print("PORT 5 - Time",time)
elif port == 6:
	GPIO.output(26, GPIO.HIGH)
	time.sleep(time)
	GPIO.output(26, GPIO.LOW)
    print("PORT 6 - Time",time)
elif port == 7:
	GPIO.output(23, GPIO.HIGH)
	time.sleep(time)
	GPIO.output(23, GPIO.LOW)
    print("PORT 7 - Time",time)
elif port == 8:
	GPIO.output(17, GPIO.LOW)
	GPIO.output(22, GPIO.LOW)
	GPIO.output(5, GPIO.LOW)
	GPIO.output(6, GPIO.LOW)
	GPIO.output(13, GPIO.LOW)
	GPIO.output(26, GPIO.LOW)
	GPIO.output(23, GPIO.LOW)
	GPIO.output(24, GPIO.HIGH)
	time.sleep(time)
	GPIO.output(24, GPIO.LOW)
    print("PORT 8 (Cleaning) - Time",time)
else:
	GPIO.output(17, GPIO.LOW)
	GPIO.output(22, GPIO.LOW)
	GPIO.output(5, GPIO.LOW)
	GPIO.output(6, GPIO.LOW)
	GPIO.output(13, GPIO.LOW)
	GPIO.output(26, GPIO.LOW)
	GPIO.output(23, GPIO.LOW)
	GPIO.output(24, GPIO.LOW)
    print("ALL PORTS LOW")