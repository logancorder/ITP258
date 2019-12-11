/*
  SD card read/write

 This example shows how to read and write data to and from an SD card file
 The circuit:
 * SD card attached to SPI bus as follows:
 ** MOSI - pin 11
 ** MISO - pin 12
 ** CLK - pin 13
 ** CS - pin 4 (for MKRZero SD: SDCARD_SS_PIN)

 created   Nov 2010
 by David A. Mellis
 modified 9 Apr 2012
 by Tom Igoe

 This example code is in the public domain.

 */
#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_TSL2561_U.h>
#include "Adafruit_BME680.h"
#define SEALEVELPRESSURE_HPA (1013.25)
#include <SPI.h>
#include <SD.h>

int chipSelect = 4;
File mySensorData;



Adafruit_BME680 bme;   
Adafruit_TSL2561_Unified tsl = Adafruit_TSL2561_Unified(TSL2561_ADDR_FLOAT, 12345);


void configureSensor(void)
{
 
  tsl.enableAutoRange(true);           
  
  tsl.setIntegrationTime(TSL2561_INTEGRATIONTIME_13MS);      /* fast but low resolution */
  

}

File myFile;

void setup() {
  
  // Open serial communications and wait for port to open:
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }


if(!tsl.begin())
  {
    
    Serial.print("Ooops, no TSL2561 detected ... Check your wiring or I2C ADDR!");
    while(1);
  }

  Serial.begin(9600);
  

  if (!bme.begin()) 
  {
    Serial.println("Could not find a valid BME680 sensor, check wiring!");
    while (1);
  }

  // Set up oversampling and filter initialization
  bme.setTemperatureOversampling(BME680_OS_8X);
  bme.setHumidityOversampling(BME680_OS_2X);
  bme.setPressureOversampling(BME680_OS_4X);
  bme.setIIRFilterSize(BME680_FILTER_SIZE_3);
  bme.setGasHeater(320, 150); // 320*C for 150 ms

  
pinMode(10, OUTPUT);
pinMode(4, OUTPUT);
SD.begin(chipSelect);






  
}

void loop() {
  // nothing happens after setup


  mySensorData = SD.open("Class.txt", FILE_WRITE);

  if (mySensorData){
    
  int a = bme.temperature;
  
  Serial.print(bme.temperature);

  Serial.print(bme.pressure / 100.0);

  Serial.print(bme.humidity);

  Serial.print(bme.readAltitude(SEALEVELPRESSURE_HPA));
 

 

 sensors_event_t event;
 tsl.getEvent(&event);
 
 
  delay(250);

  mySensorData.print("Humidity: ");
  mySensorData.print(bme.humidity);
  mySensorData.print("\n");

  mySensorData.print("Temperature: ");
  mySensorData.print(bme.temperature);
  mySensorData.print("\n");

  mySensorData.print("Pressure: ");
  mySensorData.print(bme.pressure / 100);
  mySensorData.print("\n");

  mySensorData.print("Altitude: ");
  mySensorData.println(bme.readAltitude(SEALEVELPRESSURE_HPA));
  mySensorData.close();
 
  }

  


  
  

}
