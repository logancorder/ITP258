import requests as req

url = "http://52.14.40.223/SHBP/Web/post.php"



readMe = open('E:\Class.txt','r').readlines()
for x, line in enumerate(readMe):
        if x == 0:
            humidity = line[10: ]
        if x == 1:
            temperature = line[13: ]
        if x == 2:
            pressure = line[10: ]
        if x == 3:
            altitude = line[10: ]

apikey = "abc123"
data = {
    "temperature": temperature,
    "pressure": pressure,
    "humidity": humidity,
    "altitude": altitude,
    "apikey" : apikey}

response = req.post(url, data)

print(response.text)





print(humidity)
print(temperature)
print(pressure)
print(altitude)
