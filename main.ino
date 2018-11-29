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
  pwm.setPWMFreq(60);
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

else if(cmd.substring(0, 4)=="help")
              {
                Serial.print("u-servo help:\n\n[send command to servo]\nsend 0,300\n^cmd ^ch,^position\n\n");
                Serial.println("[u-servo source code]\nhttps://github.com/sw3nlab/u-servo");
                Serial.println();
              }
                                
                else
                {
                    Serial.println("incorrect Command!\nuse help");
                    Serial.println();
                 }
    } 
delay(300);
}
