#include <Adafruit_NeoPixel.h>
#include <ESP8266WiFi.h>
#define PIN            5
#define NUMPIXELS      284

Adafruit_NeoPixel pixels = Adafruit_NeoPixel(NUMPIXELS, PIN, NEO_GRB + NEO_KHZ800);
WiFiClient client;

const char* ssid     = yourWifiName; 
const char* password = yourWifiPassword;
char server[] = "omega.dss.cloud";    // name address for Google (using DNS)

long totalVotes; //total amount of votes
long oldVotes; //stores total amount of votes before updating the total amount of votes from the database

String currentLine = "";            // string for incoming serial data
String currRates = "";              // string for reading the wanted data
boolean readingRates = false;       // is client reading data?

//Endpoint on LED-strip per color
long amount1;
long amount2;
long amount3;
long amount4;
int getDelay = 250; //delay between get requests

long amountRGB[] = {0, 0, 0}; //array for storing the RGB values

void setup() {
  Serial.begin(9600);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) { //waits until WiFi is connected
    delay(500);
  }
  pixels.begin();
  for (int i = 0; i < NUMPIXELS; i++) {
    pixels.setPixelColor(i, pixels.Color(255, 0, 0)); //sets the LED's to a color in the setup to see if the LED strip is working and WiFi is connected.
  }
  pixels.show(); // This sends the updated pixel color to the hardware.
}

void loop() {
  oldVotes = totalVotes; //stores the totalVotes of last loop to compare to new totalVotes value
  connectToServer("/returnTotalQRcolor.php"); //get request for total amount of votes
  delay(getDelay);
  readVoteData(); //reads totalVotes data
  delay(5); //small delay to empty buffer
  if (oldVotes < totalVotes || oldVotes > totalVotes) {
    connectToServer("/returnQRcolor.php?color=A%20library"); //first color get request
    delay(getDelay);
    readData(0);
    connectToServer("/returnQRcolor.php?color=An%20office"); //second color get request
    delay(getDelay);
    readData(1);
    delay(5);
    connectToServer("/returnQRcolor.php?color=At%20home"); //third color get request
    delay(getDelay);
    readData(2);
    delay(5);
    Serial.print("Red = ");
    Serial.print(amountRGB[0]);
    Serial.print("\t blue = ");
    Serial.print(amountRGB[1]);
    Serial.print("\t green = ");
    Serial.println(amountRGB[2]);
    amount1 = amountRGB[0];   // amountB;
    amount2 = (amountRGB[1] + amountRGB[0]);  // amountB + amountG;
    amount3 = (amountRGB[2] + amountRGB[1] + amountRGB[0]);   // amountB + amountG + amountR;
    amount4 = NUMPIXELS;
    delay(5);

    for (int i = 0; i < 252; i += 4) {
      for (int j = 0; j < NUMPIXELS; j++) {
        pixels.setPixelColor(j, pixels.Color(i, i, i));
      }
      pixels.show();
      yield();
    }

    for (int i = 252; i > 0; i -= 4) {
      for (int j = 0; j < NUMPIXELS; j++) {
        pixels.setPixelColor(j, pixels.Color(i, i, i));
      }
      pixels.show();
      yield();
    }
    showColors(0, amount1, 255, 0, 0);
    showColors(amount1, amount2, 0, 0, 100);
    showColors(amount2, amount3, 0, 255, 0);
    showColors(amount3, amount4, 255, 233, 16);
    pixels.show(); // This sends the updated pixel color to the hardware.

  }
}

void connectToServer(String getRequest) {
  if (client.connect(server, 80)) {
    //constructs the http request. Done in a single line as client sometimes hangs by using multiple client.print. Unsure if it's software or wifi related, doesn't happen systematically
    client.println(String("GET ") + getRequest + " HTTP/1.1\r\nHost: omega.dss.cloud\r\nConnection: close\r\n\r\n");
  }
}
void readVoteData() {
  while (client.available()) { //while client has received information from server
    // read incoming bytes:
    char inChar = client.read(); //client.read reads information per char

    // add incoming byte to end of line:
    currentLine += inChar; //constructs a line so it can check if it begins/ends with given argument

    // if you get a newline, clear the line:
    if (inChar == '\n') { //if line doesn't contain, in our case, <rates> or </rates> and next char starts a new line, empty currentline
      currentLine = "";
    }

    if (currentLine.endsWith("<rates>")) { //if it the line ends with <rates>, which can be anything depending on what you echo back, 
      readingRates = true; //sets readingRates to true so we know when to read the information we want to get back
    }
    else if (readingRates) {
      if (!currentLine.endsWith("</rates>")) { //'>' is our ending character
        currRates += inChar; //adds the read character to currRates, currRates is the information we want to get back
      }
      else {
        readingRates = false; //when line ends with </rates>, stop reading

        String justRates = currRates.substring(0, currRates.length() - 8); //cuts off </rates> from the justRates string so it's not included
        int justRatesInt = justRates.toInt(); //converts the string to an int
        totalVotes = justRatesInt; //save the int to totalVotes
        currRates = ""; //empty the string
        client.stop(); //stop client here
      }
    }
  }
  client.stop(); //stop client
}
void readData(int color) {

  while (client.available()) {
    char inChar = client.read();
    currentLine += inChar;
    if (inChar == '\n') {
      currentLine = "";
    }

    if (currentLine.endsWith("<rates>")) {
      readingRates = true;
    }
    else if (readingRates) {
      if (!currentLine.endsWith("</rates>")) { //'>' is our ending character
        currRates += inChar;
      }
      else {
        readingRates = false;
        String justRates = currRates.substring(0, currRates.length() - 8);
        int justRatesInt = justRates.toInt();
        amountRGB[color] = (justRatesInt * NUMPIXELS) / totalVotes; //this is the only different line from reading vote data. Could also make it one function and add parameters to be given to function.
        currRates = "";
        client.stop();
      }
    }
  }
}
void showColors(int x, int y, int R, int G, int B) {

  for (int i = x; i < y; i++) {

    pixels.setPixelColor(i, pixels.Color(R, G, B)); //sets RGB value for i until y, where i is the starting point on the led strip and y the endpoint.
  }

}
