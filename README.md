># u-servo 

>Роботизированая рука на сервоприводах `MG996R` с возможностью удалённого управления через интернет и формированием своих списков команд через вэб-интерфейс :(о.О):

В проекте используется:

- Wi-Fi роутер с прошивкой OpenWRT/LEDE: https://openwrt.org 

- Библиотека Adafruit Servo Library: https://github.com/adafruit/Adafruit-PWM-Servo-Driver-Library

- 3D модели: https://www.thingiverse.com/thing:1694918

а так же: 

- Arduino NANO v3 (китайский клон от robotdyn на чипе ch340)

- 16 канальный драйвер сервоприводов PCA9685

![image](https://github.com/sw3nlab/u-servo/blob/master/img.png)


>**Для тех кто вдруг захочет повторить =)**
1) Загрузите скетч `main.ino` в свой arduino контроллер.
2) Подключите Arduino контроллер к драйверу сервоприводов `PCA9685` . (как показано на рисунке выше)
3) Для питания драйвера сервоприводов необходимо использовать внешний источник питания на 5 вольт , например Powerbank.
4) Распакуйте вэб-интерфейс в директорию на вашем сервере. (для его работы необходим php)


Для взаимодействия с контроллером можно использовать:

>**Linux**:

Утилита `screen`:

`sudo apt-get install screen` 

после её установки можно подключится к контроллеру

`screen /dev/ttyUSB@ 9600` <-- заменить `@` на свой номер девайса (его можно уточнить командой `ls /dev/ttyUSB*`)

Если всё сделано правильно вы увидите приветствие контроллера: **u-Servo ready !** 

можно отключатся от девайса командой `CTRL+a+d` и `y` чтобы вернутся в консоль.

Для отправки комманд контроллеру используйте :

`echo "send 0,250">/dev/ttyUSB@` <-- означает следующее (сервопривод на канале 0, принять положение 250)

для выравнивания всех сервоприводов в одно положение (калибровки) существует команда `cntr`:

`echo "cntr">/dev/ttyUSB@|cat /dev/ttyUSB@` <-- сервоприводы на всех каналах по очереди будут принимать положение 300

>**Android app**:

Android Serial Терминал для взаимодействия с контроллером:

https://play.google.com/store/apps/details?id=de.kai_morich.serial_usb_terminal

>**Video demonstration (OpenWRT + u-servo):**

https://www.youtube.com/watch?v=p_3rx9Ga9Vs


==============BUGS===============ИЗВЕСТНЫЕ ОШИБКИ==============BUGS===============
1) Зависание контроллера (это связано с криво написаной прошивкой контроллера, косяки в преобразовании типов данных, примитивном ветвлении else if'ом или задержкой) 

иногда можно вылечить программно передёрнув usb девайс так:

```cpp
echo 2-2:1.0>/sys/bus/usb/drivers/ch341/unbind
echo 2-2:1.0>/sys/bus/usb/drivers/ch341/bind
```
[2-2:1.0] - необходимо заменить на свои идентификаторы usb устройств

Если не помогло, отключить питание от серводрайвера и контроллера и повторить подключение заново.
