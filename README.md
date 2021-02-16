# FSQR
Feedback system utilizing a ESP8266 and connected website to show live data.

I used HTML, PHP and JS for the front-end with SQL back-end to store the given answers, comments and likes.

The ESP8266 was programmed within the Arduino environment using C. It is located inside the box with the QR code and is connected to several led-strips. it uses red, green, blue and yellow to indiciate how popular a specific choice is. It does this by dividing the whole space between the given answers so you can see which answer is the most dominant one very easily. It uses WiFi to connect to the database, and checks whether or not there has been a change. If there has been, it retrieves the data.

The website is located at http://omega.dss.cloud/

We used a QR code and NFC chips so people could use the installation more easily.

![End results](https://i.imgur.com/t5PKrRX.jpg)
