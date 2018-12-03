# u-servo
arduino uart Servo server )

This project is used:

- Adafruit Servo Library: https://github.com/adafruit/Adafruit-PWM-Servo-Driver-Library

- This 3D Models: https://www.thingiverse.com/thing:1694918

and 

- This HW 16-ch i2c servo driver PCA9685:

![image](https://github.com/sw3nlab/u-servo/blob/master/img.png)


**How to**
1) Download the sketch `main.ino` to arduino controller.
2) Connect the controller to the `PCA9685` servo module. (as in the picture above)
3) use an external 5 volt power supply to power the PCA9685 !!!


To interact with the controller can be used:

**Linux**:

`sudo apt-get install screen` 

than

`screen /dev/ttyUSB@ 9600` <-- replace `@` sign with your USB device number `ls /dev/ttyUSB*` !

than press `CTRL+a+k` and `y` to return to the console

send command like this:

`echo "send 0,250">/dev/ttyUSB@` <-- servo on channel 0 take position 250

for calibrate all servo ch use this command:

`echo "cntr">/dev/ttyUSB@|cat /dev/ttyUSB@` <-- all servos will take position 300

**Android app**:

https://play.google.com/store/apps/details?id=de.kai_morich.serial_usb_terminal

Video demonstration (OpenWRT + u-servo):

https://www.youtube.com/watch?v=p_3rx9Ga9Vs




