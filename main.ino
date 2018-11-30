#include <Wire.h>
#include <Adafruit_PWMServoDriver.h>

#define SERVOMIN 500// 150 // this is the 'minimum' pulse length count (out of 4096)
#define SERVOMAX 2500// 600 // this is the 'maximum' pulse length count (out of 4096)

Adafruit_PWMServoDriver pwm = Adafruit_PWMServoDriver();

uint8_t servonum = 0;

void setup() {
  Serial.begin(9600);
  Serial.println("u-Servo ready !");
  pwm.begin();
  pwm.setPWMFreq(60);  // Analog servos run at ~60 Hz updates
  delay(10);
}

void loop() {
  
 if(Serial.available()>0)
       {
            String  cmd = "";
                 while (Serial.available() > 0) 
                              {
                                    char inChar = Serial.read();
                                    cmd += inChar;
                               }
/*START MAIN Section*/
   
              if(cmd.substring(0, 4)=="send")
              {
                  String  code = cmd.substring(4);
                  Serial.println("U-servo send:" + code);
                  char data[30];
                  code.toCharArray(data,30);
                  int i = 0;
                  String command[10] = {};
                  char *p = data;
                  char *str;
                      while ((str = strtok_r(p, ",", &p)) != NULL) {
                          command[i] = str;
                          i++;
                      }
                Serial.print("Ch: ");
                Serial.print(command[0].toInt());
                Serial.print(" take position ");
                Serial.println(command[1].toInt());
                pwm.setPWM(command[0].toInt(),0,command[1].toInt());
                Serial.println("OK");
                Serial.println();
                delay(700);
              }

/*END MAIN Section*/
   
   
/*START Calibrate section*/
   
else if(cmd.substring(0, 4)=="cntr")
              {
                Serial.print("Calibrate function\nMove all se to center position\n\n");
                int i = 0;
                for(i=0;i<=15;i++){
                          pwm.setPWM(i,0,300);
                          Serial.print("CH: ");
                          Serial.print(i);
                          Serial.println(" - position 300 ok");
                          delay(700);
                              }
                Serial.println("Calibration complete.");
              
              }
   
/*END Calibrate section*/                              
                else
                {
                    Serial.println("incorrect Command!\n\nUse: send ch,position - for send command\nor\ncntr - for calibrate");
                    Serial.println();
                 }
    } 
delay(300);
}
