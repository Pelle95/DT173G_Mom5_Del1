# DT173G - Moment 5 - Del 1

Detta är en webbtjänst som tillåter en genom att göra olika requests mot en adress läsa, lägga till, ta bort och redigera data från en databas. I detta fall är det information om kurser jag tidigare genomförts som lagras i databasen.

De olika metoder som används och hur man använder dom är följande:
* GET - För att läsa ut informationen som finns i databasen används metoden GET. Man kan antingen läsa ut alla kurser samtidigt, eller läsa ut en specifik kurs information. För att läsa ut alla kurser är det enbart att anropa adressen LÄNK med metoden GET. För att se detaljer kring en specifik kurs anropas "LÄNK?code=" följt av kurskoden för den kurs som skall visas. Exempelvis "LÄNK?code=dt176g".

* POST - För att lägga till ny data i databasen används metoden POST. Man kan bara lägga till en kurs åt gången, och för detta krävs att man anroper LÄNK med metoden POST och samt skickar med en body i JSON-format med de olika attributen som kurser har i databasen. Exempelvis "{ "coursecode": "dt800g", "coursename": "Webbutveckling 4", "courseprog": "A", "courseplan": "http://www.bing.se" }".

* DELETE - För att ta bort data från databasen används metoden DELETE. För att göra detta anropar man LÄNK med metoden DELETE följt av den kurskod som ska tas bort. Exempelvis "LÄNK?code=dt176g".

* PUT - För att redigera data från databasen används metoden PUT. Genom att anropa LÄNK följt av kurskoden för den kurs som ska redigeras med metoden PUT har man då möjlighet att ändra alla olika attribut för den kursen. Man anropar då exempelvis till adressen "LÄNK?code=dt176g" med metoden PUT, och har precis som i POST en body i JSON-format som håller de nya attributen. Exempel: "{ "coursecode": "dt276g", "coursename": "Webbutveckling 5", "courseprog": "A", "courseplan": "http://www.google.se" }".